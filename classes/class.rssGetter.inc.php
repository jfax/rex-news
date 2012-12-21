<?php
/*
 * Addon News fuer REDAXO
 * Classe, um RSS-Feeds von extern einzubinden
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 15.11.2012
 */

class rssGetter {
    
    
    public static $url; // URL des Feeds
    public static $anzahl; // Anzahl Listeitems bis zum Blaettern
    public static $blaettern; // Blaettern an | aus
    

    function execute() {
		print self::getRSS();
    }
    

	private function file_get_contents_curl($url) {
		$ch = curl_init();
	 
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_URL, $url);
	 
		$data = curl_exec($ch);
		curl_close($ch);
	 
		return $data;
	}

    /*
     * function getRSS
     * RSS-Feed von extern einbinden
     * @author Jens Fuchs, fuchs@d-mind.de, 09.05.2012
     * @return string
    */    
    public function getRSS()
    {
		$anzahl = $this->anzahl;
        $queryurl = rex_getUrl('', $REX['CUR_CLANG'], array('page' => ''), "&"); // URL fuers Blaettern
		$string = file_get_contents($this->url);
		if (empty($string)) $string = self::file_get_contents_curl($this->url);

        $xml = new SimpleXMLElement($string);

        // define the namespaces that we are interested in
        $ns = array(
            'content' => 'http://purl.org/rss/1.0/modules/content/',
            'wfw' => 'http://wellformedweb.org/CommentAPI/',
            'dc' => 'http://purl.org/dc/elements/1.1/'
        );

        (isset($_GET['page'])) ? $page=(int)$_GET['page'] : $page=1;
        $startwert_seite = $anzahl*($page-1)+1;
        $endwert_seite = $page*$anzahl;
        if ($endwert_seite>sizeof($xml->channel->item)) $endwert_seite = sizeof($xml->channel->item);
        $anzahl_seiten = ceil(sizeof($xml->channel->item)/$anzahl);

        $itemh1 = $xml->channel->title;
        $itemDesc = $xml->channel->description;
        
        if ((sizeof($xml->channel->item)/$anzahl>1) and ($this->blaettern==1))
        {
            $pager['start'] = $startwert_seite;
            $pager['end'] = $endwert_seite;
            $pager['gesamt'] = sizeof($xml->channel->item);
            $pager['jumplist'] = self::drawJumplist ( $queryurl . "[PAGE]", "&laquo;", "", "&raquo;", $page, $anzahl_seiten );
        }

        if (!class_exists('Smarty')) include('redaxo/include/addons/news/libs/Smarty.class.php');
        $t = new Smarty;
        //$t->force_compile = true;
        $t->debugging = false;
        $t->caching = false;
        $t->cache_lifetime = 120;
        $t->config_dir  = 'redaxo/include/addons/news/view/configs/';
        $t->compile_dir = 'redaxo/include/addons/news/view/templates_c/';
        $t->cache_dir   = 'redaxo/include/addons/news/view/cache/';
        $t->template_dir = 'redaxo/include/addons/news/view/templates/';        
        
        $k=0;
        foreach ($xml->channel->item as $article) 
        {		
            if ((($k+1)>=$startwert_seite) AND (($k+1)<=$endwert_seite))
            {
                $item[$k]['url'] = $article->link;
                $item[$k]['enclosure'] = $article->enclosure['url'];
                $item[$k]['title'] = $article->title;
                $item[$k]['pubDate'] = date("d.m.Y", self::rsstotime($article->pubDate));
                $item[$k]['description'] = $article->description;
            }
            $k++;
        }
        $t->assign("data", $item);
        $t->assign("pager", $pager);
        $t->assign("itemDesc", $itemDesc);
        $t->assign("itemh1", $itemh1);
        
        $t->display('rss.tpl');
      
        return;
    }


    private function rsstotime($rss_time) 
    {
        $day = substr($rss_time, 5, 2);
        $month = substr($rss_time, 8, 3);
        $month = date('m', strtotime("$month 1 2011"));
        $year = substr($rss_time, 12, 4);
        $hour = substr($rss_time, 17, 2);
        $min = substr($rss_time, 20, 2);
        $second = substr($rss_time, 23, 2);
        $timezone = substr($rss_time, 26);

        $timestamp = mktime($hour, $min, $second, $month, $day, $year);

        date_default_timezone_set('UTC');

        if(is_numeric($timezone)) {
            $hours_mod = $mins_mod = 0;
            $modifier = substr($timezone, 0, 1);
            $hours_mod = (int) substr($timezone, 1, 2);
            $mins_mod = (int) substr($timezone, 3, 2);
            $hour_label = $hours_mod>1 ? 'hours' : 'hour';
            $strtotimearg = $modifier.$hours_mod.' '.$hour_label;
            if($mins_mod) {
                $mins_label = $mins_mod>1 ? 'minutes' : 'minute';
                $strtotimearg .= ' '.$mins_mod.' '.$mins_label;
            }
            $timestamp = strtotime($strtotimearg, $timestamp);
        }

        return $timestamp;
    }


    // Blaettern
    private function drawJumplist( $url, $prevHtml, $separatorHtml, $nextHtml, $page, $pages ) 
    {

        $firstpage = 1;
        $lastpage  = min( $pages, 10 );

        if( $pages > 10 ) {
            $firstpage = max( $page - 5, 1 );

            if( $page > 1 )
                $lastpage = $firstpage + 10;

            if( $lastpage > $pages ) {
                $lastpage  = $pages;
                $firstpage = max( $lastpage - 10, 1 );
            }
        }

        if( $page > 1 ) {
            $mypage = $page - 1;
            $myurl  = str_replace( array( '[PAGE]' ), array( $mypage ), $url );
            $return .= "<a href=\"" . $myurl . "\">" . $prevHtml . "</a> ";
        }

        for( $mypage = $firstpage; $mypage <= $lastpage; $mypage++ ) {
            $myurl = str_replace( array( '[PAGE]' ), array( $mypage ), $url );

            $active = "";
            if( $mypage == $page )
                $active .= " class=\"active\"";

            $return .= "<a".$active." href=\"" . $myurl . "\">" . $mypage . "</a>";

            if( $mypage < $lastpage )
                $return .= $separatorHtml;
        }

        if( $page < $pages ) {
            $mypage = $page + 1;
            $myurl  = str_replace( array( '[PAGE]' ), array( $mypage ), $url );
            $return .= " <a href=\"" . $myurl . "\">" . $nextHtml . "</a>";
        }

        return $return;
    }
    
}
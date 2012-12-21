<?php
/**
 * Addon News
 * @author fuchs@d-mind.de Jens Fuchs
 * @package redaxo4
 * 2008/06/02 
 * 2012/11/12 ausgemistet
 */

class rex_336_news {

	var $num; // Anzahl der Eintraege pro Seite
	var $pagination; // Blaettern aktivieren?
	var $archive; // 0=Aktuell, 1=Archiv, 2=beides
	var $active; // 0=inaktive, 1=aktive, 2=beide
	var $language = 0; // Language-Id
	var $detailArticle; // article_id fuer die Detailansicht
	var $category; // Filter auf cats
	var $right; // rechte spalte anders
	var $fromHome;
	var $id;
	var $images = true;
    var $sort = "DESC"; // sortierung
    var $template; // Smarty-Template für die Ausgabe
    var $view; // Flag Startseite


    /*
     * @author Jens Fuchs <fuchs at d-mind.de>
     * @project Redaxo-News-Addon
     * @date ???
     * @param int
     * @return string // Datum formatieren
     */
    public function rex_news_format_date($date)
    {
        $d = explode("-",$date);
        return sprintf("%02d.%02d.%04d", $d[2], $d[1], $d[0]);
    }
	
	
    /*
     * @author Jens Fuchs <fuchs at d-mind.de>
     * @project Redaxo-News-Addon
     * @date ???
     * @return string // Gibt den Newstitel/Description zurück
     */
    public static function returnName($return="name")
	{
		$qry = 'SELECT name, teaser, keywords, thumb FROM '.TBL_NEWS.' WHERE id = "'.$_REQUEST['newsid'].'"';
		$sql = new rex_sql();
		$data = $sql->getArray($qry);
		if (is_array($data) and sizeof($data) > 0) 
		{
			print $data[0][$return];
		}
	}


    /*
     * @author Jens Fuchs <fuchs at d-mind.de>
     * @project Redaxo-News-Addon
     * @date 2008
     * @return string // Gibt den Newsdetailartikel zurück
     */
    function showDetail() 
    {

        ($this->language==1) ? $I18_prefix = 'en_en_utf8' : $I18_prefix = 'de_de_utf8';
		$I18N_NEWS_DB = new i18n($I18_prefix, REX_INCLUDE_PATH.'/addons/'.MY_PAGE.'/lang');
		if ($this->active == 0) $addSQL = 'AND status = "0"';
		if ($this->active == 1) $addSQL = 'AND status = "1"';
		if ($this->language != "") $addSQL .= 'AND clang = '.$this->language;
		$qry = 'SELECT *
				FROM '.TBL_NEWS.' 
				WHERE id = "'.$_REQUEST['newsid'].'"
				'.$addSQL.'
				';
		$sql = new rex_sql();
		if ($this->debug == 1) $sql->debugsql = true;
		$data = $sql->getArray($qry);
		
		if (is_array($data) and sizeof($data) > 0) 
		{
            include('redaxo/include/addons/news/libs/Smarty.class.php');
            $t = new Smarty;
            $t->debugging = false;
            $t->caching = false;
            $t->cache_lifetime = 120;
            $t->config_dir  = 'redaxo/include/addons/news/view/configs/';
            $t->compile_dir = 'redaxo/include/addons/news/view/templates_c/';
            $t->cache_dir   = 'redaxo/include/addons/news/view/cache/';
            $t->template_dir = 'redaxo/include/addons/news/view/templates/';
            
            /* Fuer spaeter - Bilderslider Header oder so
            if ($data[0]["image_header"] != "") // Bildausgabe Header
			{
				$images_header = explode(",", $data[0]["image_header"]);
				foreach ($images_header as $i)
				{
					$s = getimagesize("files/".$i);
					($s[0]<=620) ? $b[] = $i : $b[] = "index.php?rex_img_type=rex_rbw_620&rex_img_file=".$i;
				}
				if (is_array($images_header) and sizeof($images_header)>0) $headerBilder = headerBilder($b, $REX['CUR_CLANG']);
				print '<div id="newsSlider" class="slideshow flexslider">'.$headerBilder."</div>\n";
			}*/

			if ($data[0]["image"] != "") 
			{	
			 	$_images = explode (",", $data[0]["image"]);
				foreach ($_images as $k=>$file)
				{
					if (file_exists($REX['HTDOCS_PATH']."files/".$file)) 
					{
						$fileobj = OOMedia::getMediaByName($file, $REX['CUR_CLANG']);
                        $images[$k]['file'] = $fileobj->_name;
                        $images[$k]['item'] = (!empty($fileobj->_title)) ? $fileobj->_title : $fileobj->_name;
						$_filesizeis = filesize($REX['HTDOCS_PATH']."files/".$fileobj->_name);
                        $images[$k]['size'] = $this->getfilesize($_filesizeis);
                        $images[$k]['description'] = $fileobj->_med_description;
                        $images[$k]['copyright'] = $fileobj->_med_copyright;
                        $images[$k]['date'] = date("d.m.Y",$fileobj->_updatedate);
                        $images[$k]['time'] = date("H:i",$fileobj->_updatedate);
                        $images[$k]['typ'] = substr (strrchr ($fileobj->_name, "."), 1);
					}
				}
			} 

            $item[$i]['name'] = $data[0]["name"];
            $item[$i]['source'] = $data[0]["source"];
            $item[$i]['keywords'] = $data[0]["keywords"];
            $item[$i]['teaser'] = $data[0]["teaser"];
            $item[$i]['date'] = $this->rex_news_format_date($data[0]["online_date"], $this->language);
			if(OOAddon::isAvailable("textile"))
			{
			  if($data[0]["article"] != "")
			  {
				$output = $data[0]["article"];
				$text = $output;
				if($text != "")
				{
					$text = str_replace("\t", "", $text);
					$text = htmlspecialchars_decode($text);
					$text = str_replace("<br />","",$text);
					$item[$i]['text'] = rex_a79_textile($text);
				}
			  }
			}	          
			// Download
			if ($data[0]["filelist"] != "") 
			{	
			 	$filelist = explode (",", $data[0]["filelist"]);
				foreach ($filelist as $k=>$file)
				{
					if (file_exists($REX['HTDOCS_PATH']."files/".$file)) 
					{
						$fileobj = OOMedia::getMediaByName($file, $REX['CUR_CLANG']);
                        $files[$k]['file'] = $fileobj->_name;
                        $files[$k]['item'] = (!empty($fileobj->_title)) ? $fileobj->_title : $fileobj->_name;
						$_filesizeis = filesize($REX['HTDOCS_PATH']."files/".$fileobj->_name);
                        $files[$k]['size'] = $this->getfilesize($_filesizeis);
                        $files[$k]['description'] = $fileobj->_med_description;
                        $files[$k]['copyright'] = $fileobj->_med_copyright;
                        $files[$k]['date'] = date("d.m.Y",$fileobj->_updatedate);
                        $files[$k]['time'] = date("H:i",$fileobj->_updatedate);
                        $files[$k]['typ'] = substr (strrchr ($fileobj->_name, "."), 1);
					}
				}
			}
			$item[$i]['back'] = $I18N_NEWS_DB->msg('back');
            
            $t->assign("files", $files);
            $t->assign("images", $images);
            $t->assign("data", $item);
            $t->display('news_detail.tpl');           
			
		} else { // Fehlermeldung, falls URL-Manipulation
			print "<h1>Fehler</h1> Es ist ein Fehler aufgetreten. <br />Diesen Artikel gibt es nicht oder nicht mehr oder Sie haben nicht die notwendige Berechtigung. <br /><br />Bitte gehen Sie <a href=\"javascript:history.back()\">hier zur&uml;ck</a>. ";
		}
	}
	
	

    /*
     * @author Jens Fuchs <fuchs at d-mind.de>
     * @project Redaxo-News-Addon
     * @date 2008
     * @modified 11/2012
     * @return string // Listenausgabe News
     */
    function showList($eingeloggt = FALSE, $msg = "", $returnUrl=false) 
	{

		$I18N_NEWS_DB = new i18n(REX_LANG, REX_INCLUDE_PATH.'/addons/'.MY_PAGE.'/lang');

		if (!empty($msg)) print "<div class=\"msg\">$msg</div>\n";

		$conf['max'] = ($this->num == "") ? $conf['max'] = 10 : $this->num; 
		$conf['page'] = $_GET['page'] ? $_GET['page'] : 1;
		if ($this->pagination == 0) {
			$conf['page'] = 1;
		}
		$conf['page'] = (int) $conf['page'];

		if ($this->archive == ""  OR $this->archive == "0") {
			$addWhere = 'WHERE (
                    ((offline_date = "0000-00-00") OR (REPLACE(offline_date, "-", "") > CURDATE() + 0))
                    AND
                    ((archive_date = "0000-00-00") OR REPLACE(archive_date, "-", "") > CURDATE() + 0)
                    AND 
                    ((online_date = "0000-00-00") OR REPLACE(online_date, "-", "") <= CURDATE() + 0)
            )';
		} elseif ($this->archive == "1") {
			$addWhere = 'WHERE (
                    (
                        (offline_date != "0000-00-00") AND (REPLACE(offline_date, "-", "") > CURDATE() + 0)
                        OR (offline_date = "0000-00-00")
                    )
                    AND
                    ((archive_date != "0000-00-00") AND REPLACE(archive_date, "-", "") <= CURDATE() + 0)
                    AND 
                    ((online_date = "0000-00-00") OR REPLACE(online_date, "-", "") <= CURDATE() + 0)
             )';
		} else {
			$addWhere = 'WHERE (
                    ((offline_date = "0000-00-00") OR (REPLACE(offline_date, "-", "") > CURDATE() + 0))
                    AND
                    ((online_date = "0000-00-00") OR REPLACE(online_date, "-", "") <= CURDATE() + 0)
            )';
		}

		$_cat = $_GET['cat'];
		if (isset($_cat)) $addSQL = 'AND category LIKE "%|'.$_cat.'|%" ';
		if (($this->category>0) and ($this->category<>999)) $addSQL = 'AND category LIKE "%|'.$this->category.'|%" ';
		if ($this->active == 0) $addSQL .= 'AND status = "0" ';
		if ($this->active == 1) $addSQL .= 'AND status = "1" ';
		if ($this->language != "") $addSQL .= 'AND clang = '.$this->language;
		if ($this->view==1) $addSQL .= ' AND flag = 1';
        else if ($this->view==2) $addSQL .= ' AND flag = 0';

		$qry = 'SELECT *
				FROM '.TBL_NEWS.' 
				'.$addWhere.'
				'.$addSQL.'
				ORDER BY online_date '.$this->sort
                ;
		if ( $result = mysql_query($qry) ) 
			$total = mysql_num_rows($result);

		$pnum = round ( ceil ( $total / $conf['max'] ), $conf['max'] );
		$limitStart = ( $conf['page'] - 1 ) * ($conf['max']);
		$limitEnd = $conf['max'];
		$qry .= ' LIMIT ' . $limitStart . ',' . $limitEnd;

		$sql = new rex_sql();
		if ($this->debug == 1) $sql->debugsql = true;
		$data = $sql->getArray($qry);

		if ($this->pagination == 1 and $total > $conf['max'])
		{
            $pager['jumplist'] = self::drawJumplist ( rex_getUrl('','', array("page" => 'SEITENZAHL'),'&amp;'), "&lt;", " ", "&gt;", $conf['page'], $pnum  );
		}
        
        if (!class_exists('Smarty')) include('redaxo/include/addons/news/libs/Smarty.class.php');
        $t = new Smarty;
        $t->debugging = false;
        $t->caching = false;
        $t->cache_lifetime = 120;
        $t->config_dir  = 'redaxo/include/addons/news/view/configs/';
        $t->compile_dir = 'redaxo/include/addons/news/view/templates_c/';
        $t->cache_dir   = 'redaxo/include/addons/news/view/cache/';
        $t->template_dir = 'redaxo/include/addons/news/view/templates/';

        if (is_array($data) && sizeof($data) > 0) 
		{
            $i=1;
			foreach ($data as $row) 
			{
				// Selbe News ausschliessen, falls in rechter Spalte Liste
				if ($row['id']==rex_request('newsid')) continue;
				
                $url = rex_getUrl($this->detailArticle, $this->language, array('newsid' => $row['id']), '&amp;');
				
                $item[$i]['id'] = $row['id'];
                $item[$i]['name'] = $row['name'];
                $item[$i]['url'] = $url;
                $item[$i]['date'] = $this->rex_news_format_date($row['online_date'], $this->language);
                $item[$i]['source'] = $row["source"];

				$teaser = "";
                if($row['teaser']!="")
				{
					$teaser =  $row['teaser'];
                    $item[$i]['teaser'] = $teaser;
				}
				else 
				{
					$teaser2 = htmlspecialchars_decode($row["article"]);
					$teaser2 = str_replace("<br />","",$teaser);
					$teaser2 = rex_a79_textile($teaser);
					$teaser2 = str_replace("###","&#x20;",$teaser);
					$teaser2 = strip_tags($teaser);
                    $item[$i]['teaser'] = substr($teaser2, 0, strpos($teaser2, ".", 80 )+1 );
				}

                $text = htmlspecialchars_decode($row["article"]);
                $text = str_replace("<br />","",$text);
                $text = rex_a79_textile($text);
                $text = str_replace("###","&#x20;",$text);
                $text = strip_tags($text);
                $item[$i]['text'] = $text;
                    
				if (($row["thumb"] != "") AND ($this->images==true)) 
				{ 
					// Bildausgabe
					$images = explode(",", $row["thumb"]);
					if (file_exists($REX['HTDOCS_PATH'].'files/'.$images[0]))
                    {
                        $media = OOMedia::getMediaByName($images[0]); 
                        if (is_array($media) and sizeof($media)>0) {
                            $mediaTitle = $media->getValue('title');
                            $MediaDesc = $media->getValue('med_description');
                        }
                    }
                    include "redaxo/include/addons/".MY_PAGE."/conf/conf.php";
                    $item[$i]['image'] = '<a href="' . $url . '" title="' . $row['name'] . '"><img src="index.php?rex_img_type='.$REX_NEWS_CONF['image_list_type'].'&amp;rex_img_file='.$images[0].'" title="'.$mediaTitle.'" alt="'.$MediaDesc.'" /></a>';
				}
				$i++;
			}
		}
        $t->assign("pager", $pager);
        $t->assign("data", $item);
        $t->display($this->template);        
	}


    /*
    * @author Jens Fuchs <fuchs at d-mind.de>
    * @project Redaxo-News-Addon
    * @date 12.11.2012
    * @param ...
    * @return string
    * @ Blättern-Funktion
    */
    private function drawJumplist( $url, $prevHtml, $separatorHtml, $nextHtml, $page, $pages ) {

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
			$myurl  = str_replace( array( 'SEITENZAHL' ), array( $mypage ), $url ); 
			$o .= "<span class=\"pager_more\"><a href=\"" . $myurl . "\">" . $prevHtml . "</a></span> "; 
		} 

		for( $mypage = $firstpage; $mypage <= $lastpage; $mypage++ ) { 
			$myurl = str_replace( array( 'SEITENZAHL' ), array( $mypage ), $url ); 
			if( $mypage == $page ) 
				$o .= "<span class=\"highlight\">"; 
			else
				$o .= "<span>";
			$o .= "<a href=\"" . $myurl . "\">" . $mypage . "</a>"; 
				$o .= "</span>"; 
			if( $mypage < $lastpage ) 
				$o .= $separatorHtml; 
		} 

		if( $page < $pages ) { 
			$mypage = $page + 1; 
			$myurl  = str_replace( array( 'SEITENZAHL' ), array( $mypage ), $url ); 
			$o .= " <span class=\"pager_more\"><a href=\"" . $myurl . "\">" . $nextHtml . "</a></span>"; 
		}
        return $o;
	}


    /*
    * @author ?
    * @project Redaxo-News-Addon
    * @date ?
    * @param float
    * @return string
    */
    public function getfilesize($size) {
	   // Setup some common file size measurements.
	   $kb = 1024;         // Kilobyte
	   $mb = 1024 * $kb;   // Megabyte
	   $gb = 1024 * $mb;   // Gigabyte
	   $tb = 1024 * $gb;   // Terabyte
	   // Get the file size in bytes.
	
	   // If it's less than a kb we just return the size, otherwise we keep going until
	   // the size is in the appropriate measurement range.
	   if($size < $kb) {
	       return $size." Bytes";
	   }
	   else if($size < $mb) {
	       return round($size/$kb,2)." KBytes";
	   }
	   else if($size < $gb) {
	       return round($size/$mb,2)." MBbytes";
	   }
	   else if($size < $tb) {
	       return round($size/$gb,2)." GBytes";
	   }
	   else {
	       return round($size/$tb,2)." TBbytes";
	   }
	}

} // end class
<?php
/*
 * Addon News fuer REDAXO
 * 
 * Gibt Metaangaben im Header des HTML-Dokumentes aus
 * <title>-Tag, <meta>-Description und Opengraph-Elemente
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 15.11.2012
 * 
 * Im Template wie folgt einzubinden: siehe 
 * redaxo/index.php?page=news&subpage=conf
 * 
 */

if (!class_exists('rex_336_news')) include $REX['INCLUDE_PATH']."/addons/news/classes/class.336news.inc.php";
 
class news_header extends rex_336_news {

    /*
     * function getTitle
     * Gibt Titel fuer <title>-Tag zurueck
     * @author Jens Fuchs, fuchs@d-mind.de, 15.11.2012
     * @return string
    */   
    public function getTitle($name)
    {
		if (rex_request('newsid', 'int') > 0)
        {
            $r = parent::returnName($name);
            if (!empty($r)) $r .= ' &rarr; ';
        }
        return $r;
    }
    

    /*
     * function getFBImage
     * Image fuer Facebook
     * @author Jens Fuchs, fuchs@d-mind.de, 26.11.2012
     * @return string
    */   
    public function getFBImage()
    {
		if (rex_request('newsid', 'int') > 0)
        {
            $r = parent::returnName('thumb');
            // Facebook-Image in Detailansicht, Listenübersichtsbild
            if ($r != "") 
            {
                if (file_exists('files/'.$r))
                {
                    include "redaxo/include/addons/".MY_PAGE."/conf/conf.php";
                    $fb_image = 'index.php?rex_img_type='.$REX_NEWS_CONF['image_list_type'].'&rex_img_file='.$r;
					return $fb_image;
                }
            }

        }
    }
}
?>

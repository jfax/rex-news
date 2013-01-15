<?php
/**
 * News Addon 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 14.11.2012
 * Feedwriter: 
 * http://ajaxray.com/blog/php-universal-feed-generator-supports-rss-10-rss-20-and-atom
 */
if ($REX['GG']):

define (BASE, "REX_VALUE[1]");
define (TITLE, "REX_VALUE[2]");
define (DESCRIPTION, "REX_VALUE[3]");
define (RSSLINK, "REX_VALUE[4]");
define (DETAILLINK, BASE.rex_getUrl("REX_LINK_ID[1]", '', array('newsid' => ''), '&'));
define (LOGO, BASE."files/REX_FILE[1]");
define (UTF8DECODE, "REX_VALUE[18]");
 
include $REX['INCLUDE_PATH']."/addons/news/classes/rss_news.php"; 
include $REX['INCLUDE_PATH']."/addons/news/classes/FeedWriter.php"; 

//Creating an instance of FeedWriter class. 
//The constant RSS2 is passed to mention the version
$Feed = new FeedWriter(RSS2);

//Setting the channel elements
//Use wrapper functions for common channel elements
$Feed->setTitle(TITLE);
$Feed->setLink(RSSLINK);
$Feed->setDescription(DESCRIPTION);

//Image title and link must match with the 'title' and 'link' channel elements for RSS 2.0
$Feed->setImage(TITLE, RSSLINK, LOGO);

//Use core setChannelElement() function for other optional channels
$Feed->setChannelElement('language', 'de-de');
$Feed->setChannelElement('pubDate', date(DATE_RSS, time()));

$posts = news_rss::execute('REX_VALUE[15]');
foreach ($posts as $post)
{
  //Create an empty FeedItem
  $newItem = $Feed->createNewItem();

  //Add elements to the feed item
  //Use wrapper functions to add common feed elements
  if (UTF8DECODE==1) $newItem->setTitle($post['post']['name']);
  else $newItem->setTitle(utf8_decode($post['post']['name']));
  $newItem->setLink(DETAILLINK.$post['post']['id']);
  //The parameter is a timestamp for setDate() function
  $newItem->setDate($post['post']['online_date']);
  if ($post['post']['thumb']!="")
  {
    $datei = OOMedia::getMediaByName($post['post']['thumb']);
    $_bild = "";
    if (file_exists("files/".$file))
    {
        $_bild = '<img src="'.BASE.'index.php?rex_img_type=rex_medialistbutton_preview&rex_img_file='.$datei->getFileName().'" alt="" />';
    }      
  }
  $newItem->setDescription($_bild.$post['post']['teaser']);

  if ($post['post']['filelist']!="")
  {
    $files = "";
    $files = explode(",", $post['post']['filelist']);
      if (is_array($files) and sizeof($files)>0)
      {
          foreach ($files as $file)
          {
              $datei = OOMedia::getMediaByName($file);
              if (file_exists("files/".$file))
              {
                  $newItem->setEncloser(BASE."files/".$datei->getFileName(), $datei->_size, $datei->_type);
              }
          }
      } 
  }

  //Use core addElement() function for other supported optional elements
  //$newItem->addElement('author', 'admin@ajaxray.com (Anis uddin Ahmad)');
  //Attributes have to passed as array in 3rd parameter
  $newItem->addElement('guid', DETAILLINK.$post['post']['id'],array('isPermaLink'=>'true'));

  //Now add the feed item
  $Feed->addItem($newItem);
}

$Feed->genarateFeed();
endif;
?>
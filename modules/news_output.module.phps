<?php
/*
 * Addon News fuer REDAXO
 * News-Ausgabe
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 15.11.2012
 */

if ($REX['GG']==1) {
    if (!class_exists('rex_336_news')) include $REX['HTDOCS_PATH']."/redaxo/include/addons/news/classes/class.336news.inc.php";
    $news = new rex_336_news();
    $news->num = "REX_VALUE[1]";
    $news->pagination = "REX_VALUE[10]";
    $news->active = "REX_VALUE[8]";
    if ('REX_VALUE[2]' == 1) {
        $news->language = $REX['CUR_CLANG'];
    }
    $news->archive = "REX_VALUE[4]";
    if ('REX_VALUE[18]' != "") $news->view = "REX_VALUE[18]";
    if ('REX_VALUE[15]' != "") $news->category = "REX_VALUE[15]";
    $news->sort = "REX_VALUE[19]";
    $news->debug = "REX_VALUE[5]";
    $news->detailArticle = "REX_LINK_ID[7]";
    $news->id = $this->article_id;
	$news->start_article_id = $REX['START_ARTICLE_ID'];
    $news->template = "REX_VALUE[14]";
    if ('REX_VALUE[6]' == 'list') $news->showList();
    if ('REX_VALUE[6]' == 'detail') $news->showDetail();
    if (SPRACHE=="de") $news->category = "1";
    else $news->category = "2";
}
?>
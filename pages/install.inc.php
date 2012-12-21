<?php
/**
 * News Addon 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 */

$mypage = 'news';
$news_input = rex_get_file_contents($REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/modules/news_input.module.phps');
$news_output = rex_get_file_contents($REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/modules/news_output.module.phps');
$rss_input = rex_get_file_contents($REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/modules/rss_input.module.phps');
$rss_output = rex_get_file_contents($REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/modules/rss_output.module.phps');
$rssGetter_input = rex_get_file_contents($REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/modules/rssGetter_input.module.phps');
$rssGetter_output = rex_get_file_contents($REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/modules/rssGetter_output.module.phps');
?>

<div class="rex-addon-output">
	<h2 class="rex-hl2">Einrichtung der Module</h2>
	<div class="rex-addon-content">
		<p class="rex-tx1">Bitte ein neues Modul anlegen, und für Ein- und Ausgabe den Code von unten hineinkopieren.<br />
        Aktuell gibt es drei Module: Newsausgabe, RSS-Ausgabe und RSS-Import eines fremden RSS.<br />
        <br />
        Zu beachten ist, dass bei der RSS-Ausgabe ein leeres Template dem Artikel zuzuweisen ist, also etwas in der Form: 
        <?php rex_highlight_string('echo $this->getArticle();'); ?></p>
	</div>
	<div class="redaxo-addon-content">
       <ul>
    		<li><a href="#code_news_input_intro">Modul News Eingabe</a></li>
        	<li><a href="#code_news_output_intro">Modul News Ausgabe</a></li>
    		<li><a href="#code_rss_input_intro">Modul RSS-Export Eingabe</a></li>
        	<li><a href="#code_rss_output_intro">Modul RSS-Export Ausgabe</a></li>
    		<li><a href="#code_rssGetter_input_intro">Modul RSS-Import Eingabe</a></li>
        	<li><a href="#code_rssGetter_output_intro">Modul RSS-Import Ausgabe</a></li>
        </ul>
	</div>
</div>

<div class="rex-addon-output">
	<h2 class="rex-hl2" id="code_news_input_intro">Moduleingabe News</h2>
	<div class="rex-addon-content">
		<?php rex_highlight_string($news_input); ?>
	</div>
</div>

<div class="rex-addon-output">
	<h2 class="rex-hl2" id="code_news_output_intro">Modulausgabe News</h2>
	<div class="rex-addon-content">
		<?php rex_highlight_string($news_output); ?>
	</div>
</div>

<div class="rex-addon-output">
	<h2 class="rex-hl2" id="code_rss_input_intro">Moduleingabe RSS-Export</h2>
	<div class="rex-addon-content">
		<?php rex_highlight_string($rss_input); ?>
	</div>
</div>

<div class="rex-addon-output">
	<h2 class="rex-hl2" id="code_rss_output_intro">Modulausgabe RSS-Export</h2>
	<div class="rex-addon-content">
		<?php rex_highlight_string($rss_output); ?>
	</div>
</div>

<div class="rex-addon-output">
	<h2 class="rex-hl2" id="code_rssGetter_input_intro">Moduleingabe RSS-Import</h2>
	<div class="rex-addon-content">
		<?php rex_highlight_string($rssGetter_input); ?>
	</div>
</div>

<div class="rex-addon-output">
	<h2 class="rex-hl2" id="code_rssGetter_output_intro">Modulausgabe RSS-Import</h2>
	<div class="rex-addon-content">
		<?php rex_highlight_string($rssGetter_output); ?>
	</div>
</div>
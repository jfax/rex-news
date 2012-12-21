<?php
/*
  Addon News fuer REDAXO

  /**
 * Konfigurationseinstellungen
 * die von Projekt und Projekt unterschiedlich sein können
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 12.11.2012
 */

echo "<h1>Konfiguration</h1>";
echo "Unten stehende Einstellungen sind direkt <strong>hier vorzunehmen</strong>: ".$REX['INCLUDE_PATH'] ."/addons/news/conf/conf.php";
echo "<br /><br />Für die Ausgabe der News wird die <a target=\"_blank\" href=\"http://www.smarty.net/\">Template-Engine Smarty</a> verwendet, so kann die Ausgabe von Projekt zu Projekt angepasst werden, ohne die Programmierung anzufassen. Hierfür im Ordner /view/templates/ die Dateien anpassen";

foreach ($REX_NEWS_CONF as $key => $value) {
    echo "<p class=\"rex-code\" style=\"margin:1em 0;\">".replace_conf_keys($key)."<br /><code>".$key." => ".$value."</code></p>";
}


$string = '<code><span style="color: #000000">
<span style="color: #0000BB">&lt;?php
<br /></span><span style="color: #007700">if&nbsp;(</span><span style="color: #0000BB">rex_request</span><span style="color: #007700">(</span><span style="color: #DD0000">\'newsid\'</span><span style="color: #007700">)&gt;</span><span style="color: #0000BB">0</span><span style="color: #007700">)&nbsp;
<br />{
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #0000BB">define&nbsp;</span><span style="color: #007700">(</span><span style="color: #DD0000">"BASE"</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">"http://localhost/redaxo-news/"</span><span style="color: #007700">);&nbsp;</span><span style="color: #FF8000">//&nbsp;HTML-Base
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">include&nbsp;</span><span style="color: #0000BB">$REX</span><span style="color: #007700">[</span><span style="color: #DD0000">\'INCLUDE_PATH\'</span><span style="color: #007700">].</span><span style="color: #DD0000">"/addons/news/classes/class.336header.inc.php"</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;include&nbsp;</span><span style="color: #0000BB">$REX</span><span style="color: #007700">[</span><span style="color: #DD0000">\'INCLUDE_PATH\'</span><span style="color: #007700">].</span><span style="color: #DD0000">"/addons/news/conf/conf.php"</span><span style="color: #007700">;&nbsp;
<br />}
<br /></span><span style="color: #0000BB">?&gt;
<br /></span>&lt;title&gt;<span style="color: #0000BB">&lt;?php&nbsp;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">print&nbsp;</span><span style="color: #0000BB">news_header</span><span style="color: #007700">::</span><span style="color: #0000BB">getTitle</span><span style="color: #007700">(</span><span style="color: #DD0000">\'name\'</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;</span><span style="color: #0000BB">$meta_title</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;if(</span><span style="color: #0000BB">$meta_keywords&nbsp;</span><span style="color: #007700">!=&nbsp;</span><span style="color: #DD0000">""</span><span style="color: #007700">)&nbsp;
<br />&nbsp;&nbsp;&nbsp;&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;</span><span style="color: #DD0000">\',&nbsp;\'</span><span style="color: #007700">.</span><span style="color: #0000BB">$meta_keywords</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br /></span><span style="color: #0000BB">?&gt;</span>&lt;/title&gt;
<br />&lt;meta&nbsp;name="description"&nbsp;content="<span style="color: #0000BB">&lt;?php&nbsp;</span><span style="color: #007700">print&nbsp;</span><span style="color: #0000BB">news_header</span><span style="color: #007700">::</span><span style="color: #0000BB">getTitle</span><span style="color: #007700">(</span><span style="color: #DD0000">\'teaser\'</span><span style="color: #007700">);&nbsp;</span><span style="color: #0000BB">?&gt;</span>"&nbsp;/&gt;
<br />&lt;meta&nbsp;property="og:url"&nbsp;content="<span style="color: #0000BB">&lt;?php&nbsp;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">(</span><span style="color: #0000BB">rex_request</span><span style="color: #007700">(</span><span style="color: #DD0000">\'newsid\'</span><span style="color: #007700">)&gt;</span><span style="color: #0000BB">0</span><span style="color: #007700">)&nbsp;?&nbsp;</span><span style="color: #0000BB">$_extend_url&nbsp;</span><span style="color: #007700">=&nbsp;array(</span><span style="color: #DD0000">\'newsid\'&nbsp;</span><span style="color: #007700">=&gt;&nbsp;</span><span style="color: #0000BB">rex_request</span><span style="color: #007700">(</span><span style="color: #DD0000">\'newsid\'</span><span style="color: #007700">))&nbsp;:&nbsp;</span><span style="color: #DD0000">""</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;</span><span style="color: #0000BB">BASE</span><span style="color: #007700">.</span><span style="color: #0000BB">rex_getUrl</span><span style="color: #007700">(</span><span style="color: #0000BB">$this</span><span style="color: #007700">-&gt;</span><span style="color: #0000BB">article_id</span><span style="color: #007700">,&nbsp;</span><span style="color: #0000BB">$REX</span><span style="color: #007700">[</span><span style="color: #DD0000">\'CUR_CLANG\'</span><span style="color: #007700">],&nbsp;</span><span style="color: #0000BB">$_extend_url</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">"&amp;"</span><span style="color: #007700">);
<br /></span><span style="color: #0000BB">?&gt;</span>"&nbsp;/&gt;
<br />&lt;meta&nbsp;property="og:image"&nbsp;content="<span style="color: #0000BB">&lt;?php&nbsp;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">if&nbsp;(</span><span style="color: #0000BB">rex_request</span><span style="color: #007700">(</span><span style="color: #DD0000">\'newsid\'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">\'int\'</span><span style="color: #007700">)&gt;</span><span style="color: #0000BB">0</span><span style="color: #007700">)&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;</span><span style="color: #0000BB">BASE</span><span style="color: #007700">.</span><span style="color: #DD0000">"files/"</span><span style="color: #007700">;
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;</span><span style="color: #0000BB">news_header</span><span style="color: #007700">::</span><span style="color: #0000BB">getFBImage</span><span style="color: #007700">();
<br />&nbsp;&nbsp;&nbsp;&nbsp;}&nbsp;else&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;</span><span style="color: #0000BB">$REX_NEWS_CONF</span><span style="color: #007700">[</span><span style="color: #DD0000">\'image_default_opengraph\'</span><span style="color: #007700">];
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br /></span><span style="color: #0000BB">?&gt;</span>"
<br />&lt;meta&nbsp;property="og:description"&nbsp;content="<span style="color: #0000BB">&lt;?php&nbsp;
<br />&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #007700">if&nbsp;(</span><span style="color: #0000BB">rex_request</span><span style="color: #007700">(</span><span style="color: #DD0000">\'newsid\'</span><span style="color: #007700">,&nbsp;</span><span style="color: #DD0000">\'int\'</span><span style="color: #007700">)&gt;</span><span style="color: #0000BB">0</span><span style="color: #007700">)
<br />&nbsp;&nbsp;&nbsp;&nbsp;{
<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print&nbsp;</span><span style="color: #0000BB">news_header</span><span style="color: #007700">::</span><span style="color: #0000BB">getTitle</span><span style="color: #007700">(</span><span style="color: #DD0000">\'teaser\'</span><span style="color: #007700">);
<br />&nbsp;&nbsp;&nbsp;&nbsp;}
<br />&nbsp;&nbsp;&nbsp;&nbsp;else&nbsp;print&nbsp;</span><span style="color: #0000BB">trim</span><span style="color: #007700">(</span><span style="color: #0000BB">$meta_beschreibung</span><span style="color: #007700">);&nbsp;
<br /></span><span style="color: #0000BB">?&gt;</span>"/&gt;</span>
</code>
';

echo "<h2>Beispiel-Header für das Template, um Title-Tag, Meta-Description und Opengraph-Tags zu erweitern:</h2>";
echo "<p class=\"rex-code\" style=\"margin:1em 0;\">".$string."</p>";
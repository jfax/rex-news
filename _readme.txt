<!-- /**
 * News Addon
 * @author Jens Fuchs
 * @author www.d-mind.de
 * @package redaxo4
 * @version $Id: _readme.txt, 2012/11/01 
 */ -->
<h2>Beschreibung: News-Addon</h2>
Autor: Jens Fuchs, fuchs at d-mind.de
Datum: 01.11.2012

<h2>Abhängigkeiten</h2>
1) Aktiviertes Textile-Addon
2) optional Markitup für die Eingabe des Artikels: 
http://www.redaxo.org/de/download/addons/?addon_id=531

<h2>Installation:</h2>
1) Alle Dateien des Archivs nach "redaxo/include/addons/news" entpacken
2) Im Redaxo AddOn Manager das Plugin installieren
3) Im Redaxo AddOn Manager das Plugin aktivieren
4) Dem Backend-Benutzer, sofern nicht admin, das recht "news[]" verleihen

<h2>Ausgabe der News:</h2>
Das Newsmodul ist im News-Addon im Ordner "modules" zu finden, aber auch <a href="index.php?page=news&subpage=mod#code_news_input_intro">im Backend</a>. 
Dort lassen sich Einstellungen fuer die Listenausgabe und fuer die Einzelausgabe (Detailausgabe vornehmen). 
Somit muessen immer zwei Artikel angelegt werden, einer mit Einstellungen fuer Listenausgabe, einer mit Einstellungen fuer Detailausgabe

Das Modul stueckelt anhand der Parameter einen Aufruf der News-Klasse wie folgt zusammen: 

    include $REX['HTDOCS_PATH']."/redaxo/include/addons/news/classes/class.336news.inc.php";
    $news = new rex_336_news();
    $news->num = 2; // Anzahl der Eintraege pro Seite
    $news->pagination = 0; // Blaettern aktivieren?
    $news->archive = 0; 0=Aktuell, 1=Archiv, 2=beides
    $news->active = 1; // 0=inaktive, 1=aktive, 2=beide
    $news->language = ""; // Language-Id
    $news->debug = 0; // Debugging-Modus: 0=aus, 1=an
    $news->detailArticle = 39; // article_id fuer die Detailansicht
    $news->showList();
	
Spaetestens jetzt braucht man ein wenig CSS und ein paar Icons. Die sind beim Addon dabei und werden automatisch in den Ordner /files/ kopiert

Wenn etwas mit der Ausgabe nicht stimmt, einfach die Debugging-Funktion anstellen und ggf. die Parameter bei der Eingabe veraendern (z. B. Archivfunktion).

Ferner lässt sich aus News ein RSS-Feed generieren, <a href="index.php?page=news&subpage=mod#code_rssGetter_input_intro">Modul ist anbei</a>. 
Auch lassen sich fremde RSS-Feeds importieren und in einer Liste ausgeben. 

Die Meta-Angaben zu title, meta-Description sowie ein paar Opengraph-Tags werden ebenfalls bedient. 
Beispiele hierfür sind <a href="index.php?page=news&subpage=conf">hier sichtbar</a>. 

Ist in der Redaxo-Installation mehrere Sprachen angelegt, so erscheint bei der Newseingabe auf die Möglichkeit, einen Artikel einer Sprache zuzuordnen. Bei mehr als fünf Sprachen muss in der entries.inc.php der Filter ergänzt werden.
{* 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 14.11.2012
 * Blaettern-Funktion - Pagebrowser

Optionales CSS fuer die Blaettern-Fuktion
div.pager {
	margin-bottom:1.5em;
	line-height:3em;
}
div.pager a {
	text-decoration:none;
	border: 1px solid #F7941D;
	padding:5px 5px 2px;
	margin-right:5px;
}
div.pager a.active,
div.pager .highlight a {
	color:#fff;
	background: #F7941D;
}
div.pager .pager_info {
	float:left;
	font-style:italic;
	font-family: Georgia,Times,serif;
	margin: 1em 0 1em 2em;
}
div.pager .pager_elements {
	float:left;
	margin: 1em 0;
}
*}
<div class="pager">
    <div class="pager_elements">
        {$pager['jumplist']}
    </div>
    {if $pager['start']}
    <div class="pager_info">
        Zeige Artikel {$pager['start']}-{$pager['end']} von {$pager['gesamt']}
    </div>
    {/if}
    <div style="clear:both;"></div>    
</div>
{* 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 14.11.2012
 * HTML-Ausgabe importierter RSS
*}
{if $itemh1}<h1>{$itemh1}</h1>{/if}
{if $itemDesc}<h2>{$itemDesc}</h2>{/if}
{if $pager}{include file='pager.tpl'}{/if}
<div class="news-list-container">
    {foreach from=$data item=list name='outer'}
        <div class="news-list-item">
            {if $list['enclosure'] !=""}<div class="float_left"><a href="{$list['url']}"><img src="{$list['enclosure']}" alt="" /></a></div>{/if}
            <div class="news-content">
                <h3 class="h3teaser"><span class="news-name"><a href="{$list['url']}">{$list['title']}</a></span></h3>
                <span class="news-date">{$list['pubDate']}</span> &ndash; {$list['description']}
            </div>
            <div style="clear:both"></div>
        </div>
    {/foreach}
</div>
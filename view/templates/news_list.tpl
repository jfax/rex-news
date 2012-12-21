{* 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 14.11.2012
 * Listenausgabe News 
*}
{if $pager['jumplist']}{include file='pager.tpl'}{/if}
<div class="news-list-container">
    {foreach from=$data item=list name='outer'}
    <div class="news-list-item news-list-item-id{$list['id']}">
        <div class="news-list-info">
            <span class="news-list-date">{$list['date']}</span>
        </div>
        <div class="news-list-content">
            <h2><a href="{$list['url']}" title="zum Artikel: {$list['name']}">{$list['name']}</a></h2>
            {if $list['image']}<div class="float_left">{$list['image']}</div>{/if}
            {if $list['teaser']}<p>{$list['teaser']}</p>{/if}
        </div>
    </div>
    {foreachelse}
        <p>Ooops, aktuell liegen keine Meldungen vor. Das kann sich jedoch täglich wieder ändern. Schauen Sie also bald wieder vorbei oder abonnieren Sie unser RSS-Feed</p>
    {/foreach}
</div>
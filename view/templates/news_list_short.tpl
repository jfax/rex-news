{* 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 19.11.2012
 * Listenausgabe News - verkürzt
*}
{if $pager['jumplist']}{include file='pager.tpl'}{/if}
<div class="news-list-container">
    {foreach from=$data item=list name='outer'}
    <div class="news-list-item news-list-item-id{$list['id']}">
        <div class="news-list-content">
            <h2><span class="news-list-date">{$list['date']}</span> | <a href="{$list['url']}" title="zum Artikel: {$list['name']}">{$list['name']}</a></h2>
        </div>
    </div>
    {/foreach}
</div>
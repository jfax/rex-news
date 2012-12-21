{* 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 14.11.2012
 * Detailausgabe News 
*}
<div class="news_detail">
    {foreach from=$data item=list name='outer'}
        {if $list['name']}<h1>{$list['name']}</h1>{/if}
        {if $list['source']}<span class="news-source">{$list['source']}</span>{/if}
        {if $list['teaser']}<h3 class="h3teaser">{/if}
        {if $list['date']}<span class="news-date">{$list['date']}</span> &ndash; {/if}
        {if $list['teaser']}{$list['teaser']}</h3>{/if}
        {if $list['text']}<div class="news_detail_article">{$list['text']}</div>{/if}
        {if $list['bilder']}<div class="imagesContainer">{$list['bilder']}</div>{/if}
        {if $images > 0}
            <div class="imagesContainer">
                {foreach from=$images item=file name='images'}
                    <div class="image"><a href="files/{$file['file']}" rel="fancybox"><img src="index.php?rex_img_type=rex_mediabutton_preview&amp;rex_img_file={$file['file']}" alt="{$file['item']}" /></a></div>
                    <!--
                    <div>({$file['size']})</div>
                    {if $file['description']}<div class="news_description">{$file['description']}</div>{/if}
                    {if $file['copyright']}<div class="news_copyright">{$file['copyright']}</div>{/if}
                    {if $file['date']}<div class="news_updatedate">{$file['date']} {$file['time']} Uhr</div>{/if}
                    {if $file['typ']}<div class="news_typ">{$file['typ']}</div>{/if}
                    //-->
                {/foreach}
            </div>
        {/if}
        {if $files > 0}
            <div class="downloadContainer">
                <h2>Download</h2>
                <ul>
                    {foreach from=$files item=file name='inner'}
                        <li>
                            <a href="files/{$file['file']}">{$file['item']}</a> ({$file['size']})
                            {if $file['description']}<div class="news_description">{$file['description']}</div>{/if}
                            {if $file['copyright']}<div class="news_copyright">{$file['copyright']}</div>{/if}
                            {if $file['date']}<div class="news_updatedate">{$file['date']} {$file['time']} Uhr</div>{/if}
                            {if $file['typ']}<div class="news_typ">{$file['typ']}</div>{/if}
                        </li>
                    {/foreach}
                </ul>
            </div>
        {/if}
        {if $list['keywords']}<div class="keywords"><em>Dieser Artikel wurde verschlagwortet mit: {$list['keywords']}</em></div>{/if}        
        {if $list['back']}<div class="back"><a href="javascript:history.back();">&lt; {$list['back']}</a></div>{/if}
    {/foreach}
    <div style="clear:both"></div>
</div><!-- /news -->
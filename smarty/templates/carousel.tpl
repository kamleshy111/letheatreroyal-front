<section class="section">
    <div class="owl-carousel owl-carousel-condensed" data-items="1" data-sm-items="2" data-xl-items="4" data-dots="false" data-nav="true" data-stage-padding="30" data-sm-stage-padding="100" data-lg-stage-padding="0" data-loop="true" data-margin="0" data-mouse-drag="false">
        {foreach from=$carousel item=slice}
            <a class="services-box-modern" href="{if ($slice->url)}{$slice->url}{else}#{/if}" target="{$slice->target}">
                <figure>
                    <img src="/carousel/{$slice->filename}" alt="{$slice->text1}" width="480" height="659" />
                </figure>
                <div class="services-box-modern-overlay"></div>
                <div class="services-box-modern-caption">
                    <div class="services-box-modern-title">{$slice->text1}</div>
                    {if ($slice->text2)}
                        <span class="services-box-modern-price">{$slice->text2}</span>
                    {/if}
                    <hr class="divider divider-xs-2" />
                </div>
            </a>
        {/foreach}
    </div>
</section>
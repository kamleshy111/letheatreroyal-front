{foreach from=$teamLst key=i item=actMember}
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="row row-narrow-50 align-items-center row-30 {if ($i is odd)}flex-xl-row-reverse{/if}">
                <div class="col-lg-7 wow {if ($i is even)}fadeInLeft{else}fadeInRight{/if}" data-wow-delay=".2s">
                    <div class="inset-xl-right-60"><img src="/equipe/{if ($actMember->photo)}{$actMember->photo}{else}noPhoto.png{/if}" alt="{$actMember->fullname}" width="660" height="495" />
                    </div>
                </div>
                <div class="col-lg-5 wow {if ($i is even)}fadeInRight{else}fadeInLeft{/if}" data-wow-delay=".3s">
                    <div class="pre-title">{$actMember->title}</div>
                    <h2>{$actMember->fullname}<br>{$actMember->title}</h2>
                    <p>{$actMember->presentation}</p>
                </div>
            </div>
        </div>
    </section>
{/foreach}
{*
<div class="page-header" {if ($dynamicText->headerBackground)}style="background : url('/bg/{$dynamicText->headerBackground}') "{/if}>
    <div class="overlay"></div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="hero-copy-container">
                <div class="hero-text">
                    <h1 class="interior-page-title">{$dynamicText->title}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="fill-accent-primary-light page-section" id="ca">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">{$dynamicText->subTitle}</h2>
                <h3 class="section-subheading">{$dynamicText->text}</h3>
            </div>
        </div>
        {foreach from=$teamLst item=actMember}
            <div class="row">
                <div class="fill-white card-board">
                    <div class="board-member">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="rounded-circle" src="/equipe/{if ($actMember->photo)}{$actMember->photo}{else}noPhoto.png{/if}" alt="{$actMember->fullname}">
                            </div>
                            <div class="col-md-9 text-left">
                                <h4>{$actMember->fullname}</h4>
                                <h5>{$actMember->title}</h5>
                                <p>{$actMember->presentation}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
</section>
*}
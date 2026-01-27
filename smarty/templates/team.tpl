<div class="container">
    <h2>La permancence</h2>
</div>
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
<hr />
<div class="container">
    <h2>Conseil d'administration</h2>
</div>
{foreach from=$caLst key=i item=actMember}
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
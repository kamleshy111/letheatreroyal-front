<section class="section section-lg bg-default">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 pageText">
                {*
                <div class="pre-title wow fadeInLeft" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">you are Welcome</div>
                <h2 class="wow fadeInRight" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">Sharing the God’s love with everyone</h2>
                <p class="text-sm wow fadeInUp" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sed elit a urna mollis varius nec at ligula. Vivamus rhoncus odio ut ultrices efficitur. Suspendisse potenti. liquam erat volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas eget elit at lacus.</p>
                <p class="text-sm wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;"> Vestibulum sed elit a urna mollis varius nec at ligula. Vivamus rhoncus odio ut ultrices efficitur. Suspendisse potenti. liquam erat volutpat.</p>
                <p class="text-sm wow fadeInUp" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">Donec congue aliquam elit, non fringilla enim biben dum sit amet. Morbi veliti efficitur. Nullam suscipit sem eu augue consequat, et congue eros.</p>
                *}
                <div class="pre-title wow fadeInLeft" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">{$serviceText->summary}</div>
                <h2 class="wow fadeInRight" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">{$serviceText->title}</h2>
                {$serviceText->text}
            </div>
        </div>
    </div>
</section>


{foreach from=$serviceLst key=i item=actService}
    <section class="section section-lg bg-default">
        <div class="container">
            <div class="row row-narrow-50 align-items-center row-30 {if ($i is odd)}flex-xl-row-reverse{/if}">
                <div class="col-lg-7 wow {if ($i is even)}fadeInLeft{else}fadeInRight{/if}" data-wow-delay=".2s">
                    <div class="inset-xl-right-60"><img src="/service/{$actService->photo}" alt="{$actService->name}" width="660" height="495" />
                    </div>
                </div>
                <div class="col-lg-5 wow {if ($i is even)}fadeInRight{else}fadeInLeft{/if}" data-wow-delay=".3s">
                    <div class="pre-title">{$actService->summary}</div>
                    <h2>{$actService->name}</h2>
                    <p>{$actService->text}</p>
                </div>
            </div>
        </div>
    </section>
{/foreach}

{*
<section class="bg-light page-section-no-pad" id="service">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 portfolio-item fill-accent-primary">
                <div class="section-heading-container">
                    <h2 class="section-heading ">Nos services</h2>
                    <h3 class="section-subheading">Nous effectuons plus de 5570 dépannages par année</h3>
                </div>
            </div>
            {foreach from=$serviceLst key=i item=actService}
                <div class="col-lg-3 col-md-6  col-sm-6 portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href="#service{$i}">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i>
                                <div class="portfolio-caption">
                                    <h4>{$actService->name}</h4>
                                </div>
                            </div>
                        </div>
                        <img class="img-fluid" src="/service/homeThumbnail/{$actService->photo}" alt="{$actService->name}" />
                    </a>
                </div>
            {/foreach}
        </div>
    </div>
</section>*}
{foreach from=$serviceLst key=i item=actService}
    <div class="portfolio-modal modal fade" id="service{$i}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="modal-body">
                                <img class="img-fluid d-block mx-auto" src="/service/{$actService->photo}" alt="{$actService->name}" />
                                <h2>{$actService->name}</h2>
                                {if ($actService->summary)}
                                    <h4>{$actService->summary}</h4>
                                {/if}
                                {if ($actService->text)}
                                    <p>{$actService->text}</p>
                                {/if}
                                {if ($actService->youtube)}
                                    <hr />
                                    <iframe id="youtube" width="560" height="315" src="https://www.youtube.com/embed/{$actService->youtube}" title="{$actService->name}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/foreach}
<section class="section section-md bg-white text-center novi-background" id="{$page}">
    <div class="shell">
        <div class="range range-sm-center range-40">
            <div class="cell-sm-10">
                <div class="tabs-custom tabs-horizontal tabs-corporate" id="regFrm">
                    {if (!$smarty.get.t)}
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabDayCare" data-toggle="tab" aria-expanded="true">Service de garde artistique</a></li>
                            <li class=""><a href="#tabTheaterSchool" data-toggle="tab" aria-expanded="false">École de théâtre</a></li>
                            <li class=""><a href="#tabArtCamp" data-toggle="tab" aria-expanded="false">Camp artistique</a></li>
                            <li class=""><a href="#tabDayCamp" data-toggle="tab" aria-expanded="false">Camp de jour</a></li>
                        </ul>
                    {/if}
                    <div class="tab-content">
                        <div class="tab-pane fade {if (($smarty.get.t eq daycare) or (!$smarty.get.t))}active in{/if}" id="tabDayCare">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <div class="cell-12">
                                    <h3>Inscription au service de garde artistique</h3>
                                    <h4>Journée du {$nextFriday|date_format:"%e %B %Y"}</h4>
                                    {include file="form/registration.tpl" t="daycare" nocache}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {if ($smarty.get.t eq theaterschool)}active in{/if}" id="tabTheaterSchool">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <div class="cell-12">
                                    <h3>Inscription à l'école de théâtre</h3>
                                    {include file="form/registration.tpl" t="theaterschool" nocache}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {if ($smarty.get.t eq artcamp)}active in{/if}" id="tabArtCamp">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <div class="cell-12">
                                    <h3>Inscription aux camps artistiques</h3>
                                    {include file="form/registration.tpl" t="artcamp" nocache}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {if ($smarty.get.t eq daycamp)}active in{/if}" id="tabDayCamp">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <div class="cell-12">
                                    <h3>Inscription au camp de jour</h3>
                                    {include file="form/registration.tpl" t="daycamp" nocache}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="confirmation"></div>
                {if ($loadStripe eq "Y")}
                    <script src="https://js.stripe.com/v3/"></script>
                    <script src="/js/stripe.js"></script>
                {/if}
            </div>
            <div class="cell-sm-4"></div>
        </div>
    </div>
</section>
{nocache}
    <input type="hidden" id="currentReg" value="" />
    <input type="hidden" id="currentRegForm" value="" />
    <input type="hidden" id="cardholderName" value="" autocomplete="off" />
{/nocache}
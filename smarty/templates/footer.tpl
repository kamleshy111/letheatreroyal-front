{*if ($page neq "confirmRegistration")}
    {include file="newsletter.tpl"}
{/if*}
<footer class="page-footer footer-default text-left novi-background">
    <section class="section-md bg-gray-11">
        <div class="shell">
            <div class="range range-50">
                <div class="cell-sm-6 cell-md-3">
                    <h3>Nous joindre</h3>
                    <ul class="contact-list">
                        <li>
                            <div class="unit unit-middle unit-horizontal unit-spacing-sm">
                                <div class="unit__left"><span class="icon novi-icon icon-lg icon-gray-12 mdi mdi-map-marker"></span></div>
                                <div class="unit__body"><a href="https://www.google.com/search?q=766+rue+Saint-Georges%2C+Saint-J%C3%A9r%C3%B4me%2C+Qu%C3%A9bec.&oq=766+rue+Saint-Georges%2C+Saint-J%C3%A9r%C3%B4me%2C+Qu%C3%A9bec.&aqs=chrome..69i57j33i160.215j0j7&sourceid=chrome&ie=UTF-8#" target="_blank">766 rue Saint-Georges<br />Saint-Jérôme<br />Québec&nbsp;&nbsp;J7Z 5C6</a></div>
                            </div>
                        </li>
                        {*<li>
                            <div class="unit unit-middle unit-horizontal unit-spacing-sm">
                                <div class="unit__left"><span class="icon novi-icon icon-lg icon-gray-12 mdi mdi-clock"></span></div>
                                <div class="unit__body">
                                    <dl class="list-desc">
                                        <dt>Weekdays:</dt>
                                        <dd><span>8:00–20:00</span></dd>
                                    </dl>
                                    <dl class="list-desc">
                                        <dt>Weekends:</dt>
                                        <dd><span>9:00–18:00</span></dd>
                                    </dl>
                                </div>
                            </div>
                        </li>*}
                        <li>
                            <div class="unit unit-middle unit-horizontal unit-spacing-sm">
                                <div class="unit__left"><span class="icon novi-icon icon-lg icon-gray-12 mdi mdi-phone-incoming"></span></div>
                                <div class="unit__body"><a class="big" href="tel:4508212532">450 821-2532</a><br><a href="mailto:info@letheatreroyal.com">info@letheatreroyal.com</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="cell-sm-6 cell-md-4">
                    <h3>Prochaines activités</h3>
                    <div id="futureActivity">
                        {if ($artCampLst|count gt 0)}
                            <h4>Camps artistiques</h4>
                            {foreach from=$artCampLst item=actData}
                                {*<div class="post-minimal unit unit-horizontal unit-spacing-sm">
                                    <div class="unit__left"><a href="blog-post.html"><img class="img-rounded" src="images/post-minimal-04-81x84.jpg" alt="" width="81" height="84" /></a></div>
                                    <div class="unit__body"><a class="post-minimal-title link-gray-darker" href="blog-post.html">The Latest Fine Art Trends: Autumn 2019</a>
                                        <div>
                                            <time class="post-box-icon mdi mdi-clock novi-icon" datetime="2019">October 12, 2019</time>
                                        </div>
                                    </div>
                                </div>*}
                                {*<li>{$actData->datePeriod}</li>*}
                                <div class="artCamp unit unit-horizontal unit-spacing-sm">
                                    <div class="unit__body">{$actData->name}
                                        <div>
                                            <time class="post-box-icon mdi mdi-clock novi-icon" datetime="2019">{$actData->datePeriod}</time>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        {/if}
                        {if ($dayCampLst|count gt 0)}
                            <h4>Camps de jour</h4>
                            <ul>
                                {foreach from=$dayCampLst item=actData}
                                    <li>{$actData->datePeriod}</li>
                                {/foreach}
                            </ul>
                        {/if}
                    </div>
                </div>
                <div class="cell-sm-10 cell-md-5">
                    <h3>Écrivez-nous</h3>
                    {include file="form/footerContact.tpl"}
                </div>
            </div>
        </div>
    </section>
    <section class="section-xxs bg-gray-13 text-center">
        <div class="shell">
            <div class="range range-xs-center range-sm-justify">
                <div class="cell-xs-8 cell-sm-6 text-sm-left">
                    <div class="group"><span>Suivez-nous:</span>
                        <ul class="list-inline socialMedia">
                            <li class="instagram"><a class="icon novi-icon icon-sm icon-gray-12 fa fa-instagram" href="#"></a></li>
                            <li class="facebook"><a class="icon novi-icon icon-sm icon-gray-12 fa fa-facebook" href="https://www.facebook.com/theatreroyalagencelafond" target="_blank"></a></li>
                            <li class="twitter"><a class="icon novi-icon icon-sm icon-gray-12 fa fa-twitter" href="#"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="cell-xs-8 cell-sm-6 text-sm-right">
                    <p class="rights">{$sitename}&nbsp;&copy;&nbsp;2023-<span class="copyright-year"></span>.{*&nbsp;<br class="veil-sm"><a href="privacy-policy.html">Privacy Policy</a>.*} Site Internet par&nbsp;<a href="https://jaguar.tech" target="_blank">Jaguar Tech</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</footer>
<div id="bgProcess">
    <div class="loaderProcess">
        <div></div>
        <div></div>
    </div>
</div>
<input type="hidden" id="status" value="{$status}" />
<input type="hidden" id="page" value="{$page}" />
<input type="hidden" id="deviceType" value="{$deviceType}" />
<input type="hidden" id="spk" value="{$stripe_pk}" />
<input type="hidden" id="grc" value="{$smarty.session.reCAPTCHA}_{$smarty.session.reCAPTCHAScore}" />
{if ($status eq "prod")}
    {include file="googleAnalytics.tpl"}
{/if}
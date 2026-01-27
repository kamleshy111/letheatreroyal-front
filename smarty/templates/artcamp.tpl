<section class="section-md bg-white text-center novi-background">
    <div class="shell">
        <div class="range range-sm-center range-40">
            {*<div class="cell-xs-12">
                <h3>Tabs &amp; Accordions</h3>
                <p class="big">With modern and intuitive interface of tabs and accordions, you can <br>control content to be organised within a single frame.</p>
            </div>*}
            <div class="cell-sm-10">
                <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab{$dynamicText["daycamp"]->id}" data-toggle="tab" aria-expanded="true">{$dynamicText["daycamp"]->title}</a></li>
                        <li class=""><a href="#tab{$dynamicText["artcamp"]->id}" data-toggle="tab" aria-expanded="false">{$dynamicText["artcamp"]->title}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab{$dynamicText["daycamp"]->id}">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                {if ($dynamicText["daycamp"]->textImage)}
                                    <div class="cell-sm-4">
                                        <div class="bg-smear">
                                            <figure>
                                                <img src="/media/{$dynamicText["daycamp"]->textImage}" alt="{$dynamicText["daycamp"]->title}" />
                                            </figure>
                                        </div>
                                    </div>
                                {/if}
                                <div class="{if ($dynamicText["daycamp"]->textImage)}cell-sm-8{else}cell-sm-12{/if}">
                                    <h3>{$dynamicText["daycamp"]->title}</h3>
                                    <div class="dynamicText">{$dynamicText["daycamp"]->text}</div>
                                    {if ($dayCampLst|count gt 0)}
                                        <div id="campBloc">
                                            <h5>Blocs de camps de jour</h5>
                                            <ul>
                                                {foreach from=$dayCampLst key=$i item=actData}
                                                    <li><label>Bloc {($i+1)}{if ($actData->title)} - {$actData->title}{/if}</label>Du {$actData->dateStart|date_format:"%e %B"} au {$actData->dateEnd|date_format:"%e %B"}</li>
                                                {/foreach}
                                            </ul>
                                        </div>
                                    {/if}
                                    <div class="cta">
                                        <a href="/inscription/?t=daycamp" class="button button-primary button-square button-block insBtn"><span>Inscrivez-vous</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab{$dynamicText["artcamp"]->id}">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                {if ($dynamicText["artcamp"]->textImage)}
                                    <div class="cell-sm-4">
                                        <div class="bg-smear">
                                            <figure>
                                                <img src="/media/{$dynamicText["artcamp"]->textImage}" alt="{$dynamicText["artcamp"]->title}" />
                                            </figure>
                                        </div>
                                    </div>
                                {/if}
                                <div class="{if ($dynamicText["artcamp"]->textImage)}cell-sm-8{else}cell-sm-12{/if}">
                                    <h3>{$dynamicText["artcamp"]->title}</h3>
                                    <div class="dynamicText">{$dynamicText["artcamp"]->text}</div>
                                    {if ($artCampLst|count gt 0)}
                                        <div id="campBloc">
                                            <h5>Prochains camps artistiques</h5>
                                            <ul>
                                                {foreach from=$artCampLst key=$i item=actData}
                                                    <li>
                                                        <label>{$actData->name}</label>
                                                        <div class="campDate">Du {$actData->dateStart|date_format:"%e %B"} au {$actData->dateEnd|date_format:"%e %B"}</div>
                                                        <div class="campSpecification">Lieu: {$actData->place}<br />Heure: {$actData->time}<br />Âge requis: {$actData->age}<br />Prix: {$actData->price}$</div>
                                                    </li>
                                                {/foreach}
                                            </ul>
                                        </div>
                                    {/if}
                                    <div class="cta">
                                        <a href="/inscription/?t=artcamp" class="button button-primary button-square button-block insBtn"><span>Inscrivez-vous</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
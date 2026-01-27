<section class="section-md bg-white text-center novi-background">
    <div class="shell">
        <div class="range range-sm-center range-40">
            <div class="cell-sm-10">
                <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-1">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab{$dynamicText["daycare"]->id}">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                {if ($dynamicText["daycare"]->textImage)}
                                    <div class="cell-sm-4">
                                        <div class="bg-smear">
                                            <figure>
                                                <img src="/media/{$dynamicText["daycare"]->textImage}" alt="{$dynamicText["daycare"]->title}" />
                                            </figure>
                                        </div>
                                    </div>
                                {/if}
                                <div class="{if ($dynamicText["daycare"]->textImage)}cell-sm-8{else}cell-sm-12{/if}">
                                    <h3>{$dynamicText["daycare"]->title}</h3>
                                    <div class="dynamicText">{$dynamicText["daycare"]->text}</div>
                                    {if ($blocLst|count gt 0)}
                                        <div id="daycareBloc">
                                            <h5>Blocs de camps de jour</h5>
                                            <ul>
                                                {foreach from=$blocLst key=$i item=actData}
                                                    <li><label>Bloc {($i+1)}</label>Du {$actData->dateStart|date_format:"%e %B"} au {$actData->dateEnd|date_format:"%e %B"}</li>
                                                {/foreach}
                                            </ul>
                                        </div>
                                    {/if}
                                    <div class="cta">
                                        <a href="/inscription/?t=daycare" class="button button-primary button-square button-block insBtn"><span>Inscrivez-vous</span></a>
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
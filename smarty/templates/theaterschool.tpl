<section class="section-md bg-white text-center novi-background">
    <div class="shell">
        <div class="range range-sm-center range-40">
            <div class="cell-xs-12">{$dynamicText["theaterschool"]->text}</div>
            <div class="cell-sm-10">
                <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-1">
                    <ul class="nav nav-tabs">
                        {foreach from=$sectionLst key=$i item=actData}
                            <li {if ($i eq 0)}class="active"{/if}><a href="#tab{$dynamicText[{$actData}]->id}" data-toggle="tab" aria-expanded="false">{$dynamicText[{$actData}]->title}</a></li>
                            {if ($i eq 2)}
                                <div></div>
                            {/if}
                        {/foreach}
                    </ul>
                    <div class="tab-content">
                        {foreach from=$sectionLst key=$i item=actData}
                            <div class="tab-pane fade {if ($i eq 0)}active in{/if}" id="tab{$dynamicText[{$actData}]->id}">
                                <div class="range range-50 range-md-justify range-sm-middle">
                                    {if ($dynamicText[{$actData}]->textImage)}
                                        <div class="cell-sm-4">
                                            <figure>
                                                <img src="/media/{$dynamicText[{$actData}]->textImage}" alt="{$dynamicText[{$actData}]->title}" />
                                            </figure>
                                        </div>
                                    {/if}
                                    <div class="{if ($dynamicText[{$actData}]->textImage)}cell-sm-8{else}cell-sm-12{/if}">
                                        <h3>{$dynamicText[{$actData}]->title}</h3>
                                        <div class="dynamicText">{$dynamicText[{$actData}]->text}</div>
                                        {if ($blocLst|count gt 0)}
                                            <div id="theaterschoolBloc">
                                                <h5>Blocs de camps de jour</h5>
                                                <ul>
                                                    {foreach from=$blocLst key=$i item=actData}
                                                        <li><label>Bloc {($i+1)}</label>Du {$actData->dateStart|date_format:"%e %B"} au {$actData->dateEnd|date_format:"%e %B"}</li>
                                                    {/foreach}
                                                </ul>
                                            </div>
                                        {/if}
                                        {if ($actData eq "theaterschoolschedule")}
                                            <div id="schedule">
                                                {foreach from=$schedule key=$i item=actClasse}
                                                    {if ($dayname neq $actClasse->dayname|date_format:"%A"|ucfirst)}
                                                        {assign var="dayname" value=$actClasse->dayname|date_format:"%A"|ucfirst}
                                                        <h5 class="dayname">Les cours offerts les <span>{$dayname|upper}</span> sont les suivants :</h5>
                                                    {/if}
                                                    <div class="classe">
                                                        <h6 class="className">{$actClasse->name}{if ($actClasse->complete eq "Y")}<span class="complete">Complet</span>{/if}</h6>
                                                        <div class="classTime"><label>Heure</label>{$actClasse->timeStart|date_format:"%H:%M"} à {$actClasse->timeEnd|date_format:"%H:%M"}</div>
                                                        <div class="classAge"><label>Âge</label>{$actClasse->age}</div>
                                                        <div class="classPrice"><label>Coût</label>{$actClasse->price}$</div>
                                                        <div class="classTeacher"><label>Enseignant{if ($actClasse->teacher|count gt 1)}s{/if}</label>{$actClasse->teacherLst}</div>
                                                    </div>
                                                {/foreach}
                                                <h5 class="dayname">À la carte</h5>
                                                {foreach from=$alacarte key=$i item=actClasse}
                                                    <div class="classe">
                                                        <h6 class="className">{$actClasse->name}</h6>
                                                        <div class="classPrice"><label>Coût</label>{$actClasse->total}$</div>
                                                    </div>
                                                {/foreach}
                                                {*<p>Cours de chant privé – 35$/heure</p>
                                                <p>Session de coaching de jeu devant la caméra avec selftape inclus – 75$/heure</p>*}
                                            </div>
                                        {/if}
                                        <div class="cta">
                                            <a href="/inscription/?t=theaterschool" class="button button-primary button-square button-block insBtn"><span>Inscrivez-vous</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
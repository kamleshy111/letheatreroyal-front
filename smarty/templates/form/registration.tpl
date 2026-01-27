{if ($t eq "daycare")}
    {assign var="currentLimit" value=$daycarereglimit nocache}
    {assign var="currentTotal" value=$totalRegistration.daycare nocache}
{elseif ($t eq "artcamp")}
    {assign var="currentLimit" value=$artcampreglimit nocache}
    {assign var="currentTotal" value=$totalRegistration.artcamp nocache}
{elseif ($t eq "daycamp")}
    {assign var="currentLimit" value=$daycampreglimit nocache}
    {assign var="currentTotal" value=$totalRegistration.daycamp nocache}
{elseif ($t eq "theaterschool")}
    {assign var="currentLimit" value=$theaterschoolreglimit nocache}
    {assign var="currentTotal" value=$totalRegistration.theaterschool nocache}
{/if}
<form role="form" action="{$smarty.server.REQUEST_URI}" method="post" name="registrationFrm{$t|ucfirst}" id="registrationFrm{$t|ucfirst}" class="regFrm" enctype="multipart/form-data" data-toggle="validator">
    <input type="hidden" name="c" value="1" autocomplete="off" />
    <input type="hidden" name="type" value="{$t}" autocomplete="off" />
    <input type="hidden" id="complete" value="{if ($currentTotal lt $currentLimit)}N{else}Y{/if}" autocomplete="off" />
    {if (($t eq "daycare") and ($currentTotal gte $currentLimit))}
        <div class="fullReg"><span>Activité complète</span></div>
    {/if}
    {if ($t eq "daycare")}
        <input type="hidden" name="dayCareDate" value="{$nextFriday}" autocomplete="off" />
    {else}
        {if ($t neq "theaterschool")}
            <h5>Options de camp</h5>
        {/if}
        <div class="range range-sm-bottom spacing-20 novi-excluded">
            <div class="cell-12">
                <ul class="campChoice">
                    {if ($t eq "artcamp")}
                        {foreach from=$artCampLst key=$i item=actData}
                            <li>
                                {if ($actData->totalRegistration gte $actData->registrationLimit)}
                                    <div class="fullReg"><span>Activité complète</span></div>
                                {/if}
                                <input type="checkbox" {if ($actData->totalRegistration gte $actData->registrationLimit)}disabled="disabled"{/if} id="artcamp{$actData->id}" name="artcamp[]" value="{$actData->id}" /><label for="artcamp{$actData->id}">{$actData->name}</label>
                                <div class="campDate">Du {$actData->dateStart|date_format:"%e %B"} au {$actData->dateEnd|date_format:"%e %B"}</div>
                                <div class="campSpecification">Lieu: {$actData->place}<br />Heure: {$actData->time}<br />Âge requis: {$actData->age}<br />Prix: {$actData->price}$</div>
                            </li>
                        {/foreach}
                    {elseif ($t eq "daycamp")}
                        {foreach from=$dayCampLst key=$i item=actData}
                            <li>
                                {if ($actData->totalRegistration gte $actData->registrationLimit)}
                                    <div class="fullReg"><span>Activité complète</span></div>
                                {/if}
                                <input type="checkbox" {if ($actData->totalRegistration gte $actData->registrationLimit)}disabled="disabled"{/if} class="daycamp" id="daycamp{$actData->id}" name="daycamp[]" value="{$actData->id}" /><label for="daycamp{$actData->id}">Bloc {($i+1)}{if ($actData->title)} - {$actData->title}{/if}</label>
                                <div class="campDate">Du {$actData->dateStart|date_format:"%e %B"} au {$actData->dateEnd|date_format:"%e %B"}</div>
                                <div class="campSpecification">Prix: {$actData->price}$</div>
                                <div class="campDayCare"><input disabled="disabled" type="checkbox" id="daycampDC{$actData->id}" name="campDayCare-{$actData->id}" value="Y" /><label for="daycampDC{$actData->id}">Ajout du service de garde</label></div>
                            </li>
                        {/foreach}
                    {elseif ($t eq "theaterschool")}
                        {*foreach from=$theaterSchoolLst key=$i item=actData}
                            <li>
                                {if ($totalRegistration.theaterschool[$actData->id] gte $theaterschoolreglimit)}
                                    <div class="fullReg"><span>Activité complète</span></div>
                                {/if}
                                <input type="checkbox" {if ($totalRegistration.theaterschool[$actData->id] gte $theaterschoolreglimit)}disabled="disabled"{/if} id="theaterschool{$actData->id}" name="theaterschool[]" value="{$actData->id}" /><label for="theaterschool{$actData->id}">{$actData->name}</label>
                                <div class="campSpecification">Prix: {$actData->price}$</div>
                            </li>
                        {/foreach*}
                    {/if}
                </ul>
            </div>
        </div>
    {/if}
    <h5>Enfant</h5>
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="firstname{$t|ucfirst}" type="text" name="firstname" />
            <label class="form-label" for="firstname{$t|ucfirst}">Prénom de l'enfant</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="lastname{$t|ucfirst}" type="text" name="lastname" />
            <label class="form-label" for="lastname{$t|ucfirst}">Nom de l'enfant</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" max="2099-12-31" id="birthdate{$t|ucfirst}" type="date" name="birthdate" />
            <label class="form-label birthdate" for="birthdate{$t|ucfirst}">Âge</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="school{$t|ucfirst}" type="text" name="school" />
            <label class="form-label" for="school{$t|ucfirst}">École fréquentée</label>
        </div>
    </div>
    <h5>Parents</h5>
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="fatherFirstname{$t|ucfirst}" type="text" name="fatherFirstname" />
            <label class="form-label" for="fatherFirstname{$t|ucfirst}">Prénom du père</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="fatherLastname{$t|ucfirst}" type="text" name="fatherLastname" />
            <label class="form-label" for="fatherLastname{$t|ucfirst}">Nom du père</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="motherFirstname{$t|ucfirst}" type="text" name="motherFirstname" />
            <label class="form-label" for="motherFirstname{$t|ucfirst}">Prénom de la mère</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="motherLastname{$t|ucfirst}" type="text" name="motherLastname" />
            <label class="form-label" for="motherLastname{$t|ucfirst}">Nom de la mère</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required email" id="email{$t|ucfirst}" type="email" name="email" />
            <label class="form-label" for="email{$t|ucfirst}">Courriel</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="phone{$t|ucfirst}" type="tel" name="phone" />
            <label class="form-label" for="phone{$t|ucfirst}">Téléphone</label>
        </div>
    </div>
    <hr />
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="emergencyContact{$t|ucfirst}" type="text" name="emergencyContact" />
            <label class="form-label" for="emergencyContact{$t|ucfirst}">Nom de la personne à contacter en cas d'urgence</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="emergencyPhone{$t|ucfirst}" type="tel" name="emergencyPhone" />
            <label class="form-label" for="emergencyPhone{$t|ucfirst}">Numéro de téléphone d'urgence (autre que celui du parent)</label>
        </div>
    </div>
    <hr />
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input" id="allergies{$t|ucfirst}" type="text" name="allergies" />
            <label class="form-label" for="allergies{$t|ucfirst}">Allergie</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <select class="form-input heardAbout" id="heardAbout{$t|ucfirst}" name="heardAbout">
                <option></option>
                {html_options options=$hearAboutLst}
            </select>
            <label class="form-label heardAbout" for="heardAbout{$t|ucfirst}">Vous avez entendu parler de nos services de quelle façon</label>
        </div>
        {if ($t neq "daycare")}
            <div class="cell-sm-12 form-wrap">
                <input class="" id="consent{$t|ucfirst}" value="Y" type="checkbox" name="consent" />
                <label class="checkbox" for="consent{$t|ucfirst}">J'autorise la réception de courriels concernant la programmation et l'inscription aux cours offerts, en septembre, à l'école du Théâtre royal ou concernant l'inscription à l'agence de casting Marie-Ève Lafond. J'aimerais être avisé par courriel, en avant-première, pour l'inscription aux camps l'année prochaine.</label>
            </div>
        {/if}
    </div>
    <hr />
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-12">
            <div class="transactionSummary">
                {include file="transactionSummary.tpl"}
            </div>
        </div>
        {if (($t eq "artcamp") or ($t eq "daycamp"))}
            <div class="cell-12 paymentOption">
                <h5>Modalité de paiement</h5>
                <ul>
                    <li>
                        <input type="radio" class="required paymentOption" checked="checked" name="paymentOption" value="complete" />
                        <label class="fullPaymentLabel">Paiement complet de <span></span></label>
                    </li>
                    <li>
                        <input type="radio" class="required paymentOption" name="paymentOption" value="monthly" />
                        <label class="monthlyPaymentLabel"><span class="nbPayment"></span> paiements mensuels de <span class="monthlyPayment"></span></label>
                    </li>
                </ul>
            </div>
        {/if}
        {if ($t eq "theaterschool")}
            <div class="cell-12">
                <h5>Méthode de paiement</h5>
            </div>
        {/if}
        <div class="cell-sm-12 form-wrap {if ($t neq "theaterschool")}hidden{/if}" id="paymentModeWrapper">
            <select id="paymentMode{$t|ucfirst}" name="paymentMode" class="form-input paymentMode required">
                {if ((($t eq "theaterschool") and ($paymentTheaterModeLst|count gt 0)) or (($t neq "theaterschool") and ($paymentModeLst|count gt 0)))}
                {/if}
                {if ($t eq "theaterschool")}
                    <option value=""></option>
                {/if}
                {if ($t eq "theaterschool")}
                    {html_options options=$paymentTheaterModeLst}
                {else}
                    {html_options options=$paymentModeLst}
                {/if}
            </select>
            <label class="form-label paymentMode" for="paymentMode{$t|ucfirst}">Méthode de paiement</label>
        </div>
        <div class="cell-12 creditForm">
            <h5>Informations de la carte <i class="fa fa-cc-mastercard" aria-hidden="true"></i> <i class="fa fa-cc-visa" aria-hidden="true"></i></h5>
            {if ($status eq "dev")}4000001240000000{/if}
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 form-group creditPaymentForm"></div>
            </div>
        </div>
        <div id="ccError"></div>
    </div>
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        {if (($t eq "artcamp") or ($t eq "daycamp"))}
            <div class="cell-sm-12" id="regClause">
                <div>Veuillez prendre note qu'en raison des places très limitées, nous ne pouvons faire un remboursement et ce formulaire retourné sert de consentement.</div>
                {if ($t eq "daycamp")}
                    <div>Il est à prévoir que le deuxième jeudi de chaque bloc n'offre pas de service de garde en vue de la préparation du spectacle.</div>
                {/if}
            </div>
        {/if}
        <div class="cell-sm-6 form-wrap">
            <button class="button button-primary button-square button-block" type="submit" {if (($t eq "daycare") and ($currentTotal gte $currentLimit))}disabled="disabled"{/if}><span>Procéder à l'inscription</span></button>
        </div>
    </div>
</form>
<?php
/* Smarty version 4.5.4, created on 2024-11-16 07:27:04
  from '/web/theatreroyal/letheatreroyal.com/smarty/templates/form/registration.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_67388f98f1a979_49318076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2057e052ff720613cb78c947bf45b63d98f5021' => 
    array (
      0 => '/web/theatreroyal/letheatreroyal.com/smarty/templates/form/registration.tpl',
      1 => 1718648589,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:transactionSummary.tpl' => 1,
  ),
),false)) {
function content_67388f98f1a979_49318076 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/web/theatreroyal/composer/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'/web/theatreroyal/composer/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),2=>array('file'=>'/web/theatreroyal/composer/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
if (($_smarty_tpl->tpl_vars['t']->value == "daycare")) {?>
    <?php $_smarty_tpl->_assignInScope('currentLimit', $_smarty_tpl->tpl_vars['daycarereglimit']->value ,true);?>
    <?php $_smarty_tpl->_assignInScope('currentTotal', $_smarty_tpl->tpl_vars['totalRegistration']->value['daycare'] ,true);
} elseif (($_smarty_tpl->tpl_vars['t']->value == "artcamp")) {?>
    <?php $_smarty_tpl->_assignInScope('currentLimit', $_smarty_tpl->tpl_vars['artcampreglimit']->value ,true);?>
    <?php $_smarty_tpl->_assignInScope('currentTotal', $_smarty_tpl->tpl_vars['totalRegistration']->value['artcamp'] ,true);
} elseif (($_smarty_tpl->tpl_vars['t']->value == "daycamp")) {?>
    <?php $_smarty_tpl->_assignInScope('currentLimit', $_smarty_tpl->tpl_vars['daycampreglimit']->value ,true);?>
    <?php $_smarty_tpl->_assignInScope('currentTotal', $_smarty_tpl->tpl_vars['totalRegistration']->value['daycamp'] ,true);
} elseif (($_smarty_tpl->tpl_vars['t']->value == "theaterschool")) {?>
    <?php $_smarty_tpl->_assignInScope('currentLimit', $_smarty_tpl->tpl_vars['theaterschoolreglimit']->value ,true);?>
    <?php $_smarty_tpl->_assignInScope('currentTotal', $_smarty_tpl->tpl_vars['totalRegistration']->value['theaterschool'] ,true);
}?>
<form role="form" action="<?php echo $_SERVER['REQUEST_URI'];?>
" method="post" name="registrationFrm<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" id="registrationFrm<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" class="regFrm" enctype="multipart/form-data" data-toggle="validator">
    <input type="hidden" name="c" value="1" autocomplete="off" />
    <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
" autocomplete="off" />
    <input type="hidden" id="complete" value="<?php if (($_smarty_tpl->tpl_vars['currentTotal']->value < $_smarty_tpl->tpl_vars['currentLimit']->value)) {?>N<?php } else { ?>Y<?php }?>" autocomplete="off" />
    <?php if ((($_smarty_tpl->tpl_vars['t']->value == "daycare") && ($_smarty_tpl->tpl_vars['currentTotal']->value >= $_smarty_tpl->tpl_vars['currentLimit']->value))) {?>
        <div class="fullReg"><span>Activité complète</span></div>
    <?php }?>
    <?php if (($_smarty_tpl->tpl_vars['t']->value == "daycare")) {?>
        <input type="hidden" name="dayCareDate" value="<?php echo $_smarty_tpl->tpl_vars['nextFriday']->value;?>
" autocomplete="off" />
    <?php } else { ?>
        <?php if (($_smarty_tpl->tpl_vars['t']->value != "theaterschool")) {?>
            <h5>Options de camp</h5>
        <?php }?>
        <div class="range range-sm-bottom spacing-20 novi-excluded">
            <div class="cell-12">
                <ul class="campChoice">
                    <?php if (($_smarty_tpl->tpl_vars['t']->value == "artcamp")) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['artCampLst']->value, 'actData', false, 'i');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                            <li>
                                <?php if (($_smarty_tpl->tpl_vars['actData']->value->totalRegistration >= $_smarty_tpl->tpl_vars['actData']->value->registrationLimit)) {?>
                                    <div class="fullReg"><span>Activité complète</span></div>
                                <?php }?>
                                <input type="checkbox" <?php if (($_smarty_tpl->tpl_vars['actData']->value->totalRegistration >= $_smarty_tpl->tpl_vars['actData']->value->registrationLimit)) {?>disabled="disabled"<?php }?> id="artcamp<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
" name="artcamp[]" value="<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
" /><label for="artcamp<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['actData']->value->name;?>
</label>
                                <div class="campDate">Du <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actData']->value->dateStart,"%e %B");?>
 au <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actData']->value->dateEnd,"%e %B");?>
</div>
                                <div class="campSpecification">Lieu: <?php echo $_smarty_tpl->tpl_vars['actData']->value->place;?>
<br />Heure: <?php echo $_smarty_tpl->tpl_vars['actData']->value->time;?>
<br />Âge requis: <?php echo $_smarty_tpl->tpl_vars['actData']->value->age;?>
<br />Prix: <?php echo $_smarty_tpl->tpl_vars['actData']->value->price;?>
$</div>
                            </li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php } elseif (($_smarty_tpl->tpl_vars['t']->value == "daycamp")) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dayCampLst']->value, 'actData', false, 'i');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                            <li>
                                <?php if (($_smarty_tpl->tpl_vars['actData']->value->totalRegistration >= $_smarty_tpl->tpl_vars['actData']->value->registrationLimit)) {?>
                                    <div class="fullReg"><span>Activité complète</span></div>
                                <?php }?>
                                <input type="checkbox" <?php if (($_smarty_tpl->tpl_vars['actData']->value->totalRegistration >= $_smarty_tpl->tpl_vars['actData']->value->registrationLimit)) {?>disabled="disabled"<?php }?> class="daycamp" id="daycamp<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
" name="daycamp[]" value="<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
" /><label for="daycamp<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
">Bloc <?php echo ($_smarty_tpl->tpl_vars['i']->value+1);
if (($_smarty_tpl->tpl_vars['actData']->value->title)) {?> - <?php echo $_smarty_tpl->tpl_vars['actData']->value->title;
}?></label>
                                <div class="campDate">Du <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actData']->value->dateStart,"%e %B");?>
 au <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actData']->value->dateEnd,"%e %B");?>
</div>
                                <div class="campSpecification">Prix: <?php echo $_smarty_tpl->tpl_vars['actData']->value->price;?>
$</div>
                                <div class="campDayCare"><input disabled="disabled" type="checkbox" id="daycampDC<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
" name="campDayCare-<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
" value="Y" /><label for="daycampDC<?php echo $_smarty_tpl->tpl_vars['actData']->value->id;?>
">Ajout du service de garde</label></div>
                            </li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php } elseif (($_smarty_tpl->tpl_vars['t']->value == "theaterschool")) {?>
                                            <?php }?>
                </ul>
            </div>
        </div>
    <?php }?>
    <h5>Enfant</h5>
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="firstname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="firstname" />
            <label class="form-label" for="firstname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Prénom de l'enfant</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="lastname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="lastname" />
            <label class="form-label" for="lastname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Nom de l'enfant</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" max="2099-12-31" id="birthdate<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="date" name="birthdate" />
            <label class="form-label birthdate" for="birthdate<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Âge</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="school<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="school" />
            <label class="form-label" for="school<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">École fréquentée</label>
        </div>
    </div>
    <h5>Parents</h5>
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="fatherFirstname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="fatherFirstname" />
            <label class="form-label" for="fatherFirstname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Prénom du père</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="fatherLastname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="fatherLastname" />
            <label class="form-label" for="fatherLastname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Nom du père</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="motherFirstname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="motherFirstname" />
            <label class="form-label" for="motherFirstname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Prénom de la mère</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="motherLastname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="motherLastname" />
            <label class="form-label" for="motherLastname<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Nom de la mère</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required email" id="email<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="email" name="email" />
            <label class="form-label" for="email<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Courriel</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="phone<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="tel" name="phone" />
            <label class="form-label" for="phone<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Téléphone</label>
        </div>
    </div>
    <hr />
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="emergencyContact<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="emergencyContact" />
            <label class="form-label" for="emergencyContact<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Nom de la personne à contacter en cas d'urgence</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="emergencyPhone<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="tel" name="emergencyPhone" />
            <label class="form-label" for="emergencyPhone<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Numéro de téléphone d'urgence (autre que celui du parent)</label>
        </div>
    </div>
    <hr />
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input" id="allergies<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" type="text" name="allergies" />
            <label class="form-label" for="allergies<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Allergie</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <select class="form-input heardAbout" id="heardAbout<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="heardAbout">
                <option></option>
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['hearAboutLst']->value),$_smarty_tpl);?>

            </select>
            <label class="form-label heardAbout" for="heardAbout<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Vous avez entendu parler de nos services de quelle façon</label>
        </div>
        <?php if (($_smarty_tpl->tpl_vars['t']->value != "daycare")) {?>
            <div class="cell-sm-12 form-wrap">
                <input class="" id="consent<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" value="Y" type="checkbox" name="consent" />
                <label class="checkbox" for="consent<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">J'autorise la réception de courriels concernant la programmation et l'inscription aux cours offerts, en septembre, à l'école du Théâtre royal ou concernant l'inscription à l'agence de casting Marie-Ève Lafond. J'aimerais être avisé par courriel, en avant-première, pour l'inscription aux camps l'année prochaine.</label>
            </div>
        <?php }?>
    </div>
    <hr />
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-12">
            <div class="transactionSummary">
                <?php $_smarty_tpl->_subTemplateRender("file:transactionSummary.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </div>
        </div>
        <?php if ((($_smarty_tpl->tpl_vars['t']->value == "artcamp") || ($_smarty_tpl->tpl_vars['t']->value == "daycamp"))) {?>
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
        <?php }?>
        <?php if (($_smarty_tpl->tpl_vars['t']->value == "theaterschool")) {?>
            <div class="cell-12">
                <h5>Méthode de paiement</h5>
            </div>
        <?php }?>
        <div class="cell-sm-12 form-wrap <?php if (($_smarty_tpl->tpl_vars['t']->value != "theaterschool")) {?>hidden<?php }?>" id="paymentModeWrapper">
            <select id="paymentMode<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="paymentMode" class="form-input paymentMode required">
                <?php if (((($_smarty_tpl->tpl_vars['t']->value == "theaterschool") && (smarty_modifier_count($_smarty_tpl->tpl_vars['paymentTheaterModeLst']->value) > 0)) || (($_smarty_tpl->tpl_vars['t']->value != "theaterschool") && (smarty_modifier_count($_smarty_tpl->tpl_vars['paymentModeLst']->value) > 0)))) {?>
                <?php }?>
                <?php if (($_smarty_tpl->tpl_vars['t']->value == "theaterschool")) {?>
                    <option value=""></option>
                <?php }?>
                <?php if (($_smarty_tpl->tpl_vars['t']->value == "theaterschool")) {?>
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['paymentTheaterModeLst']->value),$_smarty_tpl);?>

                <?php } else { ?>
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['paymentModeLst']->value),$_smarty_tpl);?>

                <?php }?>
            </select>
            <label class="form-label paymentMode" for="paymentMode<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
">Méthode de paiement</label>
        </div>
        <div class="cell-12 creditForm">
            <h5>Informations de la carte <i class="fa fa-cc-mastercard" aria-hidden="true"></i> <i class="fa fa-cc-visa" aria-hidden="true"></i></h5>
            <?php if (($_smarty_tpl->tpl_vars['status']->value == "dev")) {?>4000001240000000<?php }?>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 form-group creditPaymentForm"></div>
            </div>
        </div>
        <div id="ccError"></div>
    </div>
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <?php if ((($_smarty_tpl->tpl_vars['t']->value == "artcamp") || ($_smarty_tpl->tpl_vars['t']->value == "daycamp"))) {?>
            <div class="cell-sm-12" id="regClause">
                <div>Veuillez prendre note qu'en raison des places très limitées, nous ne pouvons faire un remboursement et ce formulaire retourné sert de consentement.</div>
                <?php if (($_smarty_tpl->tpl_vars['t']->value == "daycamp")) {?>
                    <div>Il est à prévoir que le deuxième jeudi de chaque bloc n'offre pas de service de garde en vue de la préparation du spectacle.</div>
                <?php }?>
            </div>
        <?php }?>
        <div class="cell-sm-6 form-wrap">
            <button class="button button-primary button-square button-block" type="submit" <?php if ((($_smarty_tpl->tpl_vars['t']->value == "daycare") && ($_smarty_tpl->tpl_vars['currentTotal']->value >= $_smarty_tpl->tpl_vars['currentLimit']->value))) {?>disabled="disabled"<?php }?>><span>Procéder à l'inscription</span></button>
        </div>
    </div>
</form><?php }
}

<?php
/* Smarty version 4.5.4, created on 2024-11-16 07:27:04
  from '/web/theatreroyal/letheatreroyal.com/smarty/templates/registration.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_67388f98d11353_70897237',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76b3d32997e9b898d95a8a23a3ca58a8e179bf99' => 
    array (
      0 => '/web/theatreroyal/letheatreroyal.com/smarty/templates/registration.tpl',
      1 => 1670608726,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:form/registration.tpl' => 4,
  ),
),false)) {
function content_67388f98d11353_70897237 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/web/theatreroyal/composer/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<section class="section section-md bg-white text-center novi-background" id="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">
    <div class="shell">
        <div class="range range-sm-center range-40">
            <div class="cell-sm-10">
                <div class="tabs-custom tabs-horizontal tabs-corporate" id="regFrm">
                    <?php if ((!$_GET['t'])) {?>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabDayCare" data-toggle="tab" aria-expanded="true">Service de garde artistique</a></li>
                            <li class=""><a href="#tabTheaterSchool" data-toggle="tab" aria-expanded="false">École de théâtre</a></li>
                            <li class=""><a href="#tabArtCamp" data-toggle="tab" aria-expanded="false">Camp artistique</a></li>
                            <li class=""><a href="#tabDayCamp" data-toggle="tab" aria-expanded="false">Camp de jour</a></li>
                        </ul>
                    <?php }?>
                    <div class="tab-content">
                        <div class="tab-pane fade <?php if ((($_GET['t'] == 'daycare') || (!$_GET['t']))) {?>active in<?php }?>" id="tabDayCare">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <div class="cell-12">
                                    <h3>Inscription au service de garde artistique</h3>
                                    <h4>Journée du <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['nextFriday']->value,"%e %B %Y");?>
</h4>
                                    <?php $_smarty_tpl->_subTemplateRender("file:form/registration.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('t'=>"daycare"), 0, false);
?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if (($_GET['t'] == 'theaterschool')) {?>active in<?php }?>" id="tabTheaterSchool">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <div class="cell-12">
                                    <h3>Inscription à l'école de théâtre</h3>
                                    <?php $_smarty_tpl->_subTemplateRender("file:form/registration.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('t'=>"theaterschool"), 0, true);
?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if (($_GET['t'] == 'artcamp')) {?>active in<?php }?>" id="tabArtCamp">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <div class="cell-12">
                                    <h3>Inscription aux camps artistiques</h3>
                                    <?php $_smarty_tpl->_subTemplateRender("file:form/registration.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('t'=>"artcamp"), 0, true);
?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if (($_GET['t'] == 'daycamp')) {?>active in<?php }?>" id="tabDayCamp">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <div class="cell-12">
                                    <h3>Inscription au camp de jour</h3>
                                    <?php $_smarty_tpl->_subTemplateRender("file:form/registration.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('t'=>"daycamp"), 0, true);
?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="confirmation"></div>
                <?php if (($_smarty_tpl->tpl_vars['loadStripe']->value == "Y")) {?>
                    <?php echo '<script'; ?>
 src="https://js.stripe.com/v3/"><?php echo '</script'; ?>
>
                    <?php echo '<script'; ?>
 src="/js/stripe.js"><?php echo '</script'; ?>
>
                <?php }?>
            </div>
            <div class="cell-sm-4"></div>
        </div>
    </div>
</section>

    <input type="hidden" id="currentReg" value="" />
    <input type="hidden" id="currentRegForm" value="" />
    <input type="hidden" id="cardholderName" value="" autocomplete="off" />
<?php }
}

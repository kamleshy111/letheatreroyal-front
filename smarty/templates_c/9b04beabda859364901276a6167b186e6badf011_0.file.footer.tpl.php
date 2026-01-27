<?php
/* Smarty version 4.5.4, created on 2025-05-21 18:36:45
  from '/home/letheatreroyal/public_html/smarty/templates/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_682e557d3fd5b1_72061043',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b04beabda859364901276a6167b186e6badf011' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/footer.tpl',
      1 => 1718666110,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:form/footerContact.tpl' => 1,
    'file:googleAnalytics.tpl' => 1,
  ),
),false)) {
function content_682e557d3fd5b1_72061043 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/letheatreroyal/composer/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
?>
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
                        <?php if ((smarty_modifier_count($_smarty_tpl->tpl_vars['artCampLst']->value) > 0)) {?>
                            <h4>Camps artistiques</h4>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['artCampLst']->value, 'actData');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                                                                                                <div class="artCamp unit unit-horizontal unit-spacing-sm">
                                    <div class="unit__body"><?php echo $_smarty_tpl->tpl_vars['actData']->value->name;?>

                                        <div>
                                            <time class="post-box-icon mdi mdi-clock novi-icon" datetime="2019"><?php echo $_smarty_tpl->tpl_vars['actData']->value->datePeriod;?>
</time>
                                        </div>
                                    </div>
                                </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                        <?php if ((smarty_modifier_count($_smarty_tpl->tpl_vars['dayCampLst']->value) > 0)) {?>
                            <h4>Camps de jour</h4>
                            <ul>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dayCampLst']->value, 'actData');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                                    <li><?php echo $_smarty_tpl->tpl_vars['actData']->value->datePeriod;?>
</li>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                        <?php }?>
                    </div>
                </div>
                <div class="cell-sm-10 cell-md-5">
                    <h3>Écrivez-nous</h3>
                    <?php $_smarty_tpl->_subTemplateRender("file:form/footerContact.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
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
                    <p class="rights"><?php echo $_smarty_tpl->tpl_vars['sitename']->value;?>
&nbsp;&copy;&nbsp;2023-<span class="copyright-year"></span>. Site Internet par&nbsp;<a href="https://jaguar.tech" target="_blank">Jaguar Tech</a>
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
<input type="hidden" id="status" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
" />
<input type="hidden" id="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" />
<input type="hidden" id="deviceType" value="<?php echo $_smarty_tpl->tpl_vars['deviceType']->value;?>
" />
<input type="hidden" id="spk" value="<?php echo $_smarty_tpl->tpl_vars['stripe_pk']->value;?>
" />
<input type="hidden" id="grc" value="<?php echo $_SESSION['reCAPTCHA'];?>
_<?php echo $_SESSION['reCAPTCHAScore'];?>
" />
<?php if (($_smarty_tpl->tpl_vars['status']->value == "prod")) {?>
    <?php $_smarty_tpl->_subTemplateRender("file:googleAnalytics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
}

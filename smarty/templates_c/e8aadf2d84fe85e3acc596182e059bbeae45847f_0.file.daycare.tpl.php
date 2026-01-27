<?php
/* Smarty version 4.5.4, created on 2025-05-21 18:39:25
  from '/home/letheatreroyal/public_html/smarty/templates/daycare.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_682e561db59702_36374262',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8aadf2d84fe85e3acc596182e059bbeae45847f' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/daycare.tpl',
      1 => 1669326556,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682e561db59702_36374262 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/letheatreroyal/composer/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'/home/letheatreroyal/composer/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<section class="section-md bg-white text-center novi-background">
    <div class="shell">
        <div class="range range-sm-center range-40">
            <div class="cell-sm-10">
                <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-1">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycare"]->id;?>
">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <?php if (($_smarty_tpl->tpl_vars['dynamicText']->value["daycare"]->textImage)) {?>
                                    <div class="cell-sm-4">
                                        <div class="bg-smear">
                                            <figure>
                                                <img src="/media/<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycare"]->textImage;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycare"]->title;?>
" />
                                            </figure>
                                        </div>
                                    </div>
                                <?php }?>
                                <div class="<?php if (($_smarty_tpl->tpl_vars['dynamicText']->value["daycare"]->textImage)) {?>cell-sm-8<?php } else { ?>cell-sm-12<?php }?>">
                                    <h3><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycare"]->title;?>
</h3>
                                    <div class="dynamicText"><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycare"]->text;?>
</div>
                                    <?php if ((smarty_modifier_count($_smarty_tpl->tpl_vars['blocLst']->value) > 0)) {?>
                                        <div id="daycareBloc">
                                            <h5>Blocs de camps de jour</h5>
                                            <ul>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blocLst']->value, 'actData', false, 'i');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                                                    <li><label>Bloc <?php echo ($_smarty_tpl->tpl_vars['i']->value+1);?>
</label>Du <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actData']->value->dateStart,"%e %B");?>
 au <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actData']->value->dateEnd,"%e %B");?>
</li>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </ul>
                                        </div>
                                    <?php }?>
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
</section><?php }
}

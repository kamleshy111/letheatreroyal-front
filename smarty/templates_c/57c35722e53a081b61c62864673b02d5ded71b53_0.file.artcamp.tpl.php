<?php
/* Smarty version 4.5.6, created on 2026-01-19 06:27:26
  from '/home/kmxwwmbzse/tr/smarty/templates/artcamp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_696e151ee8c006_51284548',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57c35722e53a081b61c62864673b02d5ded71b53' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/artcamp.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_696e151ee8c006_51284548 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/kmxwwmbzse/tr/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'/home/kmxwwmbzse/tr/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<section class="section-md bg-white text-center novi-background">
    <div class="shell">
        <div class="range range-sm-center range-40">
                        <div class="cell-sm-10">
                <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->id;?>
" data-toggle="tab" aria-expanded="true"><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->title;?>
</a></li>
                        <li class=""><a href="#tab<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->id;?>
" data-toggle="tab" aria-expanded="false"><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->title;?>
</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->id;?>
">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <?php if (($_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->textImage)) {?>
                                    <div class="cell-sm-4">
                                        <div class="bg-smear">
                                            <figure>
                                                <img src="/media/<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->textImage;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->title;?>
" />
                                            </figure>
                                        </div>
                                    </div>
                                <?php }?>
                                <div class="<?php if (($_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->textImage)) {?>cell-sm-8<?php } else { ?>cell-sm-12<?php }?>">
                                    <h3><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->title;?>
</h3>
                                    <div class="dynamicText"><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["daycamp"]->text;?>
</div>
                                    <?php if ((smarty_modifier_count($_smarty_tpl->tpl_vars['dayCampLst']->value) > 0)) {?>
                                        <div id="campBloc">
                                            <h5>Blocs de camps de jour</h5>
                                            <ul>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['dayCampLst']->value, 'actData', false, 'i');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                                                    <li><label>Bloc <?php echo ($_smarty_tpl->tpl_vars['i']->value+1);
if (($_smarty_tpl->tpl_vars['actData']->value->title)) {?> - <?php echo $_smarty_tpl->tpl_vars['actData']->value->title;
}?></label>Du <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actData']->value->dateStart,"%e %B");?>
 au <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actData']->value->dateEnd,"%e %B");?>
</li>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </ul>
                                        </div>
                                    <?php }?>
                                    <div class="cta">
                                        <a href="/inscription/?t=daycamp" class="button button-primary button-square button-block insBtn"><span>Inscrivez-vous</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->id;?>
">
                            <div class="range range-50 range-md-justify range-sm-middle">
                                <?php if (($_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->textImage)) {?>
                                    <div class="cell-sm-4">
                                        <div class="bg-smear">
                                            <figure>
                                                <img src="/media/<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->textImage;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->title;?>
" />
                                            </figure>
                                        </div>
                                    </div>
                                <?php }?>
                                <div class="<?php if (($_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->textImage)) {?>cell-sm-8<?php } else { ?>cell-sm-12<?php }?>">
                                    <h3><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->title;?>
</h3>
                                    <div class="dynamicText"><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["artcamp"]->text;?>
</div>
                                    <?php if ((smarty_modifier_count($_smarty_tpl->tpl_vars['artCampLst']->value) > 0)) {?>
                                        <div id="campBloc">
                                            <h5>Prochains camps artistiques</h5>
                                            <ul>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['artCampLst']->value, 'actData', false, 'i');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                                                    <li>
                                                        <label><?php echo $_smarty_tpl->tpl_vars['actData']->value->name;?>
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
                                            </ul>
                                        </div>
                                    <?php }?>
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
</section><?php }
}

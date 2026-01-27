<?php
/* Smarty version 4.5.6, created on 2026-01-19 06:27:57
  from '/home/kmxwwmbzse/tr/smarty/templates/theaterschool.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_696e153dc903f2_10710746',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd687b481eafbd09f139901ec61652775b0927b60' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/theaterschool.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_696e153dc903f2_10710746 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/kmxwwmbzse/tr/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'/home/kmxwwmbzse/tr/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<section class="section-md bg-white text-center novi-background">
    <div class="shell">
        <div class="range range-sm-center range-40">
            <div class="cell-xs-12"><?php echo $_smarty_tpl->tpl_vars['dynamicText']->value["theaterschool"]->text;?>
</div>
            <div class="cell-sm-10">
                <div class="tabs-custom tabs-horizontal tabs-corporate" id="tabs-1">
                    <ul class="nav nav-tabs">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sectionLst']->value, 'actData', false, 'i');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                            <li <?php if (($_smarty_tpl->tpl_vars['i']->value == 0)) {?>class="active"<?php }?>><a href="#tab<?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable1 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable1]->id;?>
" data-toggle="tab" aria-expanded="false"><?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable2 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable2]->title;?>
</a></li>
                            <?php if (($_smarty_tpl->tpl_vars['i']->value == 2)) {?>
                                <div></div>
                            <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                    <div class="tab-content">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sectionLst']->value, 'actData', false, 'i');
$_smarty_tpl->tpl_vars['actData']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actData']->value) {
$_smarty_tpl->tpl_vars['actData']->do_else = false;
?>
                            <div class="tab-pane fade <?php if (($_smarty_tpl->tpl_vars['i']->value == 0)) {?>active in<?php }?>" id="tab<?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable3 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable3]->id;?>
">
                                <div class="range range-50 range-md-justify range-sm-middle">
                                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable4 = ob_get_clean();
if (($_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable4]->textImage)) {?>
                                        <div class="cell-sm-4">
                                            <figure>
                                                <img src="/media/<?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable5 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable5]->textImage;?>
" alt="<?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable6 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable6]->title;?>
" />
                                            </figure>
                                        </div>
                                    <?php }?>
                                    <div class="<?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable7 = ob_get_clean();
if (($_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable7]->textImage)) {?>cell-sm-8<?php } else { ?>cell-sm-12<?php }?>">
                                        <h3><?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable8 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable8]->title;?>
</h3>
                                        <div class="dynamicText"><?php ob_start();
echo $_smarty_tpl->tpl_vars['actData']->value;
$_prefixVariable9 = ob_get_clean();
echo $_smarty_tpl->tpl_vars['dynamicText']->value[$_prefixVariable9]->text;?>
</div>
                                        <?php if ((smarty_modifier_count($_smarty_tpl->tpl_vars['blocLst']->value) > 0)) {?>
                                            <div id="theaterschoolBloc">
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
                                        <?php if (($_smarty_tpl->tpl_vars['actData']->value == "theaterschoolschedule")) {?>
                                            <div id="schedule">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['schedule']->value, 'actClasse', false, 'i');
$_smarty_tpl->tpl_vars['actClasse']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actClasse']->value) {
$_smarty_tpl->tpl_vars['actClasse']->do_else = false;
?>
                                                    <?php if (($_smarty_tpl->tpl_vars['dayname']->value != ucfirst(smarty_modifier_date_format($_smarty_tpl->tpl_vars['actClasse']->value->dayname,"%A")))) {?>
                                                        <?php $_smarty_tpl->_assignInScope('dayname', ucfirst(smarty_modifier_date_format($_smarty_tpl->tpl_vars['actClasse']->value->dayname,"%A")));?>
                                                        <h5 class="dayname">Les cours offerts les <span><?php echo mb_strtoupper((string) $_smarty_tpl->tpl_vars['dayname']->value ?? '', 'UTF-8');?>
</span> sont les suivants :</h5>
                                                    <?php }?>
                                                    <div class="classe">
                                                        <h6 class="className"><?php echo $_smarty_tpl->tpl_vars['actClasse']->value->name;
if (($_smarty_tpl->tpl_vars['actClasse']->value->complete == "Y")) {?><span class="complete">Complet</span><?php }?></h6>
                                                        <div class="classTime"><label>Heure</label><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actClasse']->value->timeStart,"%H:%M");?>
 à <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['actClasse']->value->timeEnd,"%H:%M");?>
</div>
                                                        <div class="classAge"><label>Âge</label><?php echo $_smarty_tpl->tpl_vars['actClasse']->value->age;?>
</div>
                                                        <div class="classPrice"><label>Coût</label><?php echo $_smarty_tpl->tpl_vars['actClasse']->value->price;?>
$</div>
                                                        <div class="classTeacher"><label>Enseignant<?php if ((smarty_modifier_count($_smarty_tpl->tpl_vars['actClasse']->value->teacher) > 1)) {?>s<?php }?></label><?php echo $_smarty_tpl->tpl_vars['actClasse']->value->teacherLst;?>
</div>
                                                    </div>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                <h5 class="dayname">À la carte</h5>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['alacarte']->value, 'actClasse', false, 'i');
$_smarty_tpl->tpl_vars['actClasse']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['actClasse']->value) {
$_smarty_tpl->tpl_vars['actClasse']->do_else = false;
?>
                                                    <div class="classe">
                                                        <h6 class="className"><?php echo $_smarty_tpl->tpl_vars['actClasse']->value->name;?>
</h6>
                                                        <div class="classPrice"><label>Coût</label><?php echo $_smarty_tpl->tpl_vars['actClasse']->value->total;?>
$</div>
                                                    </div>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                                            </div>
                                        <?php }?>
                                        <div class="cta">
                                            <a href="/inscription/?t=theaterschool" class="button button-primary button-square button-block insBtn"><span>Inscrivez-vous</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php }
}

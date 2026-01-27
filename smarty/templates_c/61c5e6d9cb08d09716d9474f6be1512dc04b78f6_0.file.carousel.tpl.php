<?php
/* Smarty version 4.5.4, created on 2025-05-21 18:36:45
  from '/home/letheatreroyal/public_html/smarty/templates/carousel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_682e557d3edf82_55035642',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '61c5e6d9cb08d09716d9474f6be1512dc04b78f6' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/carousel.tpl',
      1 => 1667747712,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682e557d3edf82_55035642 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section">
    <div class="owl-carousel owl-carousel-condensed" data-items="1" data-sm-items="2" data-xl-items="4" data-dots="false" data-nav="true" data-stage-padding="30" data-sm-stage-padding="100" data-lg-stage-padding="0" data-loop="true" data-margin="0" data-mouse-drag="false">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['carousel']->value, 'slice');
$_smarty_tpl->tpl_vars['slice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['slice']->value) {
$_smarty_tpl->tpl_vars['slice']->do_else = false;
?>
            <a class="services-box-modern" href="<?php if (($_smarty_tpl->tpl_vars['slice']->value->url)) {
echo $_smarty_tpl->tpl_vars['slice']->value->url;
} else { ?>#<?php }?>" target="<?php echo $_smarty_tpl->tpl_vars['slice']->value->target;?>
">
                <figure>
                    <img src="/carousel/<?php echo $_smarty_tpl->tpl_vars['slice']->value->filename;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['slice']->value->text1;?>
" width="480" height="659" />
                </figure>
                <div class="services-box-modern-overlay"></div>
                <div class="services-box-modern-caption">
                    <div class="services-box-modern-title"><?php echo $_smarty_tpl->tpl_vars['slice']->value->text1;?>
</div>
                    <?php if (($_smarty_tpl->tpl_vars['slice']->value->text2)) {?>
                        <span class="services-box-modern-price"><?php echo $_smarty_tpl->tpl_vars['slice']->value->text2;?>
</span>
                    <?php }?>
                    <hr class="divider divider-xs-2" />
                </div>
            </a>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</section><?php }
}

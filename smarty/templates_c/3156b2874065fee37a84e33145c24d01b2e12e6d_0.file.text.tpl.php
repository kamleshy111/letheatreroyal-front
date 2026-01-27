<?php
/* Smarty version 4.5.6, created on 2026-01-20 23:54:49
  from '/home/kmxwwmbzse/tr/smarty/templates/text.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_69705c1929fd79_52284594',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3156b2874065fee37a84e33145c24d01b2e12e6d' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/text.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:form/donation.tpl' => 1,
  ),
),false)) {
function content_69705c1929fd79_52284594 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section section-lg bg-default" id="text<?php echo ucfirst($_smarty_tpl->tpl_vars['page']->value);?>
">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 pageText">
                <?php if (($_smarty_tpl->tpl_vars['pageText']->value->subTitle)) {?>
                    <h3 class="sub_title"><?php echo $_smarty_tpl->tpl_vars['pageText']->value->subTitle;?>
</h3>
                <?php }?>
                <h2 class="section_title"><?php echo $_smarty_tpl->tpl_vars['pageText']->value->title;?>
</h2>
                <div><?php echo $_smarty_tpl->tpl_vars['pageText']->value->text;?>
</div>
            </div>
        </div>
        <?php if (($_smarty_tpl->tpl_vars['page']->value == "don")) {?>
            <?php $_smarty_tpl->_subTemplateRender("file:form/donation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php }?>
    </div>
</section><?php }
}

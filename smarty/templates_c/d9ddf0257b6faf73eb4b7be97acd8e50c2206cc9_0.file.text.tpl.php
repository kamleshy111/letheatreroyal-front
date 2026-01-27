<?php
/* Smarty version 4.5.4, created on 2026-01-12 13:08:36
  from '/home/letheatreroyal/public_html/smarty/templates/text.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_696538a4710484_07501273',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9ddf0257b6faf73eb4b7be97acd8e50c2206cc9' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/text.tpl',
      1 => 1669213078,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:form/donation.tpl' => 1,
  ),
),false)) {
function content_696538a4710484_07501273 (Smarty_Internal_Template $_smarty_tpl) {
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

<?php
/* Smarty version 4.5.6, created on 2026-01-19 06:25:04
  from '/home/kmxwwmbzse/tr/smarty/templates/mainNav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_696e1490282047_99278484',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31c9a37d54c00270ccc76dcac057ea6b8968e6f0' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/mainNav.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_696e1490282047_99278484 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="rd-navbar-nav">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mainNav']->value, 'actMenu');
$_smarty_tpl->tpl_vars['actMenu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['actMenu']->value) {
$_smarty_tpl->tpl_vars['actMenu']->do_else = false;
?>
        <?php $_smarty_tpl->_assignInScope('currentParent', $_smarty_tpl->tpl_vars['actMenu']->value['id']);?>
        <?php if (($_smarty_tpl->tpl_vars['actMenu']->value['subMenu'])) {?>
            <li class="rd-nav-item <?php echo $_smarty_tpl->tpl_vars['parent']->value['status'];?>
 level1 <?php if (($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['parent']->value['url'])) {?>active<?php }?>">
                <a href="#" class="rd-nav-link"><?php echo $_smarty_tpl->tpl_vars['actMenu']->value['title'];?>
</a>
                <ul class="rd-menu rd-navbar-dropdown">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['actMenu']->value['subMenu'], 'sub');
$_smarty_tpl->tpl_vars['sub']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sub']->value) {
$_smarty_tpl->tpl_vars['sub']->do_else = false;
?>
                        <?php $_smarty_tpl->_assignInScope('currentParent', $_smarty_tpl->tpl_vars['sub']->value['id']);?>
                        <li class="rd-dropdown-item <?php echo $_smarty_tpl->tpl_vars['parent']->value['status'];?>
 level2"><a href="<?php echo $_smarty_tpl->tpl_vars['sub']->value['url'];?>
" <?php if (($_smarty_tpl->tpl_vars['sub']->value['target'])) {?>target="<?php echo $_smarty_tpl->tpl_vars['sub']->value['target'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['sub']->value['title'];?>
</a></li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </li>
        <?php } else { ?>
            <li class="rd-nav-item <?php if (($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['actMenu']->value['code'])) {?>active<?php }?>"><a class="rd-nav-link" href="<?php echo $_smarty_tpl->tpl_vars['actMenu']->value['url'];?>
" <?php if (($_smarty_tpl->tpl_vars['actMenu']->value['target'])) {?>target="<?php echo $_smarty_tpl->tpl_vars['actMenu']->value['target'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['actMenu']->value['title'];?>
</a></li>
        <?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul><?php }
}

<?php
/* Smarty version 4.5.4, created on 2024-11-16 07:26:34
  from '/web/theatreroyal/letheatreroyal.com/smarty/templates/mainNav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_67388f7add4705_05852296',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eae1fc76f45a1ea49b7878da40db6afd3b2dbc18' => 
    array (
      0 => '/web/theatreroyal/letheatreroyal.com/smarty/templates/mainNav.tpl',
      1 => 1667738711,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67388f7add4705_05852296 (Smarty_Internal_Template $_smarty_tpl) {
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

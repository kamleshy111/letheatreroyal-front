<?php
/* Smarty version 4.5.6, created on 2026-01-19 06:25:04
  from '/home/kmxwwmbzse/tr/smarty/templates/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_696e149026cfa3_52549558',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f3d229e8730167d2216e6e1746267d302f8e771' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/header.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:mainNav.tpl' => 1,
  ),
),false)) {
function content_696e149026cfa3_52549558 (Smarty_Internal_Template $_smarty_tpl) {
?><header class="page-header">
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar novi-background rd-navbar-default-with-top-panel rd-navbar-default-with-top-panel-gray-nav" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fullwidth" data-lg-device-layout="rd-navbar-fullwidth" data-md-stick-up-offset="90px" data-lg-stick-up-offset="150px" data-stick-up="true" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true" id="mainNav">
            <div class="rd-navbar-top-panel rd-navbar-collapse">
                <div class="rd-navbar-top-panel-inner">
                    <div class="left-side">
                        <div class="contact-info">
                            <div class="unit unit-middle unit-horizontal unit-spacing-xs">
                                <div class="unit__left"><span class="icon novi-icon icon-primary text-middle mdi mdi-phone"></span></div>
                                <div class="unit__body"><a class="text-middle" href="tel:4508212532">450 821-2532</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="center-side">
                        <div class="rd-navbar-brand fullwidth-brand"><a class="brand-name" href="/"><?php echo $_smarty_tpl->tpl_vars['sitename']->value;?>
 <img src="/images/logo.jpg" alt="" /></a></div>
                    </div>
                    <div class="right-side"><a class="button button-bold button-secondary-outline button-square" href="/inscription/"><span>Inscrivez-vous</span></a></div>
                </div>
            </div>
            <div class="rd-navbar-inner">
                <div class="rd-navbar-panel">
                    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                    <button class="rd-navbar-collapse-toggle" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></button>
                    <div class="rd-navbar-brand mobile-brand"><a class="brand-name" href="/"><?php echo $_smarty_tpl->tpl_vars['sitename']->value;?>
</a></div>
                </div>
                <div class="rd-navbar-aside-right">
                    <div class="rd-navbar-nav-wrap">
                        <?php $_smarty_tpl->_subTemplateRender("file:mainNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header><?php }
}

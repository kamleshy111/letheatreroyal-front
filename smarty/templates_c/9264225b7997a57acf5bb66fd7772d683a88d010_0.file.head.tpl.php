<?php
/* Smarty version 4.5.4, created on 2025-05-21 18:36:45
  from '/home/letheatreroyal/public_html/smarty/templates/head.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_682e557d385de7_82139825',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9264225b7997a57acf5bb66fd7772d683a88d010' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/head.tpl',
      1 => 1667660216,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682e557d385de7_82139825 (Smarty_Internal_Template $_smarty_tpl) {
?><head>
    <title><?php if (($_smarty_tpl->tpl_vars['pageTitle']->value)) {
echo $_smarty_tpl->tpl_vars['pageTitle']->value;
if (($_smarty_tpl->tpl_vars['pageSubTitle']->value)) {?> - <?php echo $_smarty_tpl->tpl_vars['pageSubTitle']->value;
}?> | <?php }
echo $_smarty_tpl->tpl_vars['siteName']->value;?>
</title>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="<?php echo preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['siteDescription']->value);?>
" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8" />

    <link rel="apple-touch-icon" sizes="57x57" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/favicon-16x16.png" />
    <link rel="manifest" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />

    <link rel="icon" href="/icon/<?php echo $_smarty_tpl->tpl_vars['site']->value->code;?>
/favicon.ico" type="image/x-icon" />
    <link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['canonicalURL']->value;?>
" />
    <link rel="shortlink" href="<?php echo $_smarty_tpl->tpl_vars['canonicalURL']->value;?>
" />

    <meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['currentURL']->value;?>
" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if (($_smarty_tpl->tpl_vars['pageTitle']->value)) {
echo $_smarty_tpl->tpl_vars['pageTitle']->value;
}
if (($_smarty_tpl->tpl_vars['pageSubTitle']->value)) {?> - <?php echo $_smarty_tpl->tpl_vars['pageSubTitle']->value;
}?>" />
    <meta property="og:description" content="<?php echo preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['siteDescription']->value);?>
" />
    <meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['mainPictureURL']->value;?>
" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:image" content="<?php echo $_smarty_tpl->tpl_vars['mainPictureURL']->value;?>
" />
    <meta property="twitter:title" content="<?php if (($_smarty_tpl->tpl_vars['pageTitle']->value)) {
echo $_smarty_tpl->tpl_vars['pageTitle']->value;
}
if (($_smarty_tpl->tpl_vars['pageSubTitle']->value)) {?> - <?php echo $_smarty_tpl->tpl_vars['pageSubTitle']->value;
}?>" />
    <meta property="twitter:description" content="<?php echo preg_replace('!\s+!u', ' ',$_smarty_tpl->tpl_vars['siteDescription']->value);?>
" />

    <link href="//fonts.googleapis.com/css?family=Lato:400,700,400italic%7CPoppins:300,400,500,700" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="/css/style.css?v=<?php echo $_smarty_tpl->tpl_vars['serial']->value;?>
" />
    <?php if ((file_exists(((string)$_smarty_tpl->tpl_vars['WWW_PATH']->value)."/css/".((string)$_smarty_tpl->tpl_vars['page']->value).".css"))) {?>
        <link rel="stylesheet" href="/css/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
.css?v=<?php echo $_smarty_tpl->tpl_vars['serial']->value;?>
" />
    <?php }?>
    <base href="<?php echo $_smarty_tpl->tpl_vars['currentURL']->value;?>
" />
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="/images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <?php echo '<script'; ?>
 src="/js/html5shiv.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
</head><?php }
}

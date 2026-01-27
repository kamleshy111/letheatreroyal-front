<head>
    <title>{if ($pageTitle)}{$pageTitle}{if ($pageSubTitle)} - {$pageSubTitle}{/if} | {/if}{$siteName}</title>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="{$siteDescription|strip}" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8" />

    <link rel="apple-touch-icon" sizes="57x57" href="/icon/{$site->code}/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="/icon/{$site->code}/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/icon/{$site->code}/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/icon/{$site->code}/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/icon/{$site->code}/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/icon/{$site->code}/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/icon/{$site->code}/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/icon/{$site->code}/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/{$site->code}/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="/icon/{$site->code}/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/{$site->code}/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="/icon/{$site->code}/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/{$site->code}/favicon-16x16.png" />
    <link rel="manifest" href="/icon/{$site->code}/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/icon/{$site->code}/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />

    <link rel="icon" href="/icon/{$site->code}/favicon.ico" type="image/x-icon" />
    <link rel="canonical" href="{$canonicalURL}" />
    <link rel="shortlink" href="{$canonicalURL}" />

    <meta property="og:url" content="{$currentURL}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{if ($pageTitle)}{$pageTitle}{/if}{if ($pageSubTitle)} - {$pageSubTitle}{/if}" />
    <meta property="og:description" content="{$siteDescription|strip}" />
    <meta property="og:image" content="{$mainPictureURL}" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:image" content="{$mainPictureURL}" />
    <meta property="twitter:title" content="{if ($pageTitle)}{$pageTitle}{/if}{if ($pageSubTitle)} - {$pageSubTitle}{/if}" />
    <meta property="twitter:description" content="{$siteDescription|strip}" />

    <link href="//fonts.googleapis.com/css?family=Lato:400,700,400italic%7CPoppins:300,400,500,700" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="/css/style.css?v={$serial}" />
    {if (file_exists("{$WWW_PATH}/css/{$page}.css"))}
        <link rel="stylesheet" href="/css/{$page}.css?v={$serial}" />
    {/if}
    <base href="{$currentURL}" />
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="/images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="/js/html5shiv.min.js"></script>
    <![endif]-->
</head>
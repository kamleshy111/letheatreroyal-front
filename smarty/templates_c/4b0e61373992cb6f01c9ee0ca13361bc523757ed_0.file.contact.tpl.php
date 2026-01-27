<?php
/* Smarty version 4.5.4, created on 2025-10-14 09:45:10
  from '/home/letheatreroyal/public_html/smarty/templates/contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_68ee53e685efe4_10276282',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b0e61373992cb6f01c9ee0ca13361bc523757ed' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/contact.tpl',
      1 => 1667751538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:form/contact.tpl' => 1,
  ),
),false)) {
function content_68ee53e685efe4_10276282 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section section-md bg-white text-center novi-background" id="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">
    <div class="shell">
        <div class="range range-50 range-md-center">
            <div class="cell-sm-8">
                <div class="contact-box">
                    <h3>Contactez-nous</h3>
                    <?php $_smarty_tpl->_subTemplateRender("file:form/contact.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                </div>
            </div>
            <div class="cell-sm-4">
                <aside class="contact-box-aside text-left">
                    <div class="range range-50">
                        <div class="cell-xs-6 cell-sm-12">
                            <p class="aside-title"> Médias sociaux</p>
                            <hr class="divider divider-left divider-custom">
                            <ul class="list-inline socialMedia">
                                <li class="instagram"><a class="icon novi-icon icon-sm icon-gray-3 fa fa-instagram" href="#"></a></li>
                                <li class="facebook"><a class="icon novi-icon icon-sm icon-gray-3 fa fa-facebook" href="https://www.facebook.com/theatreroyalagencelafond" target="_blank"></a></li>
                                <li class="twitter"><a class="icon novi-icon icon-sm icon-gray-3 fa fa-twitter" href="#"></a></li>
                                <li class="youtube"><a class="icon novi-icon icon-sm icon-gray-3 fa fa-youtube" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="cell-xs-6 cell-sm-12">
                            <p class="aside-title"> Téléphone</p>
                            <hr class="divider divider-left divider-custom">
                            <div class="unit unit-middle unit-horizontal unit-spacing-xs unit-xs-top">
                                <div class="unit__left"><span class="text-middle icon icon-sm mdi mdi-phone icon-primary novi-icon"></span></div>
                                <div class="unit__body"><a class="text-middle link link-gray-dark" href="tel:4508212532">450 821-2532</a></div>
                            </div>
                        </div>
                        <div class="cell-xs-6 cell-sm-12">
                            <p class="aside-title"> Adresse</p>
                            <hr class="divider divider-left divider-custom">
                            <div class="unit unit-middle unit-horizontal unit-spacing-xs unit-xs-top">
                                <div class="unit__left"><span class="text-middle icon icon-sm mdi mdi-map-marker icon-primary novi-icon"></span></div>
                                <div class="unit__body"><a class="text-middle link link-gray-dark" href="https://www.google.com/search?q=766+rue+Saint-Georges%2C+Saint-J%C3%A9r%C3%B4me%2C+Qu%C3%A9bec.&oq=766+rue+Saint-Georges%2C+Saint-J%C3%A9r%C3%B4me%2C+Qu%C3%A9bec.&aqs=chrome..69i57j33i160.215j0j7&sourceid=chrome&ie=UTF-8#" target="_blank">766 rue Saint-Georges<br />Saint-Jérôme<br />Québec&nbsp;&nbsp;J7Z 5C6</a></div>
                            </div>
                        </div>
                                            </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="google-map-container" data-key="<?php echo $_smarty_tpl->tpl_vars['google_api_key']->value;?>
" data-center="766 rue Saint-Georges&nbsp;Saint-Jerome&nbsp;&nbsp;J7Z 5C6" data-zoom="15" data-icon="/images/gmap_marker.png" data-icon-active="/images/gmap_marker_active.png" data-styles="[{&quot;featureType&quot;:&quot;landscape&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;lightness&quot;:60}]},{&quot;featureType&quot;:&quot;road.local&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;lightness&quot;:40},{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;transit&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;administrative.province&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;water&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;},{&quot;lightness&quot;:30}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#ef8c25&quot;},{&quot;lightness&quot;:40}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;geometry.stroke&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.park&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#b6c54c&quot;},{&quot;lightness&quot;:40},{&quot;saturation&quot;:-40}]},{}]">
        <div class="google-map"></div>
        <ul class="google-map-markers">
            <li data-location="766 rue Saint-Georges&nbsp;Saint-Jerome&nbsp;&nbsp;J7Z 5C6" data-description="766 rue Saint-Georges&nbsp;Saint-Jerome&nbsp;&nbsp;J7Z 5C6"></li>
        </ul>
    </div>
</section><?php }
}

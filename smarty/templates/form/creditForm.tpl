<h5>Informations de la carte <i class="fa fa-cc-mastercard" aria-hidden="true"></i> <i class="fa fa-cc-visa" aria-hidden="true"></i></h5>
{if ($status eq "dev")}4000001240000000{/if}
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 form-group">
        {include "form/creditPayment.tpl"}
    </div>
</div>
<div id="ccError"></div>
{if ($loadStripe eq "Y")}
    <script src="https://js.stripe.com/v3/"></script>
    <script src="/js/stripe.js"></script>
{/if}
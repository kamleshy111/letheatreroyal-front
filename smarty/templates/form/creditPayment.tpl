<div class="row form-row">
    <div class="form-group col-sm-12 col-xs-12">
        <label for="card-element"></label>
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>
    </div>
</div>
{if ($loadStripe eq "Y")}
    <script src="/js/stripe.js"></script>
{/if}
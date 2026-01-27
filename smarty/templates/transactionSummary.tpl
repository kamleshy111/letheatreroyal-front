<h5>Sommaire de la transaction</h5>
<ul>
    <li class="subTotalTxt"><label>Sous-total</label> <span>{$subTotal|number_format:2:".":" "}</span></li>
    <li class="gstTxt"><label>TPS</label> <span>{$gst|number_format:2:".":" "}</span></li>
    <li class="pstTxt"><label>TVQ</label> <span>{$pst|number_format:2:".":" "}</span></li>
    <li class="totalTxt"><label>Total</label> <span>{$total|number_format:2:".":" "}</span></li>
</ul>
<input type="hidden" id="amount{$t|ucfirst}" name="amount" value="{$subTotal}" autocomplete="off" />
<input type="hidden" id="stripeToken{$t|ucfirst}" name="stripeToken" value="" autocomplete="off" />
<input type="hidden" id="stripeDescription{$t|ucfirst}" name="stripeDescription" value="{$stripeDescription}" autocomplete="off" />
<input type="hidden" id="currency{$t|ucfirst}" name="currency" value="CAD" autocomplete="off" />
<input type="hidden" id="subTotal{$t|ucfirst}" name="subTotal" value="{$subTotal|number_format:2:".":""}" autocomplete="off" />
<input type="hidden" id="gst{$t|ucfirst}" name="gst" value="{$gst|number_format:2:".":""}" autocomplete="off" />
<input type="hidden" id="pst{$t|ucfirst}" name="pst" value="{$pst|number_format:2:".":""}" autocomplete="off" />
<input type="hidden" id="total{$t|ucfirst}" name="total" value="{$total|number_format:2:".":""}" autocomplete="off" />
<input type="hidden" id="monthlyPayment{$t|ucfirst}" name="monthlyPayment" value="{$monthlyPayment|number_format:2:".":""}" autocomplete="off" />
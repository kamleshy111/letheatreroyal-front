var spk      = $("#spk").val();
var stripe   = Stripe(spk);
var elements = stripe.elements();
var ccCard   = document.getElementById("card-element");
var style    = {
    base   : {
        color          : "#666",
        fontFamily     : "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
        fontSmoothing  : "antialiased",
        fontSize       : "16px",
        "::placeholder": {
            color: "#AAB7C4"
        }
    },
    invalid: {
        color    : "#A00",
        iconColor: "#A00"
    }
};
var card     = elements.create("card", {style: style});

if (ccCard) {
    card.mount("#card-element");
    card.addEventListener("change", function (event) {
        var displayError = document.getElementById("card-errors");
        if (event.error) {
            $("#bgProcess").hide();
            $("input[type=submit]").prop("disabled", false);
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    });
}

function getToken(idForm) {
    stripe.createToken(card).then(function (result) {
        $.ajax({
            type: "POST",
            url : "/ajax/logStripe.php",
            data: {result: result}
        });
        if (result.error) {
            var errorElement         = document.getElementById("card-errors");
            errorElement.textContent = result.error.message;
        } else {
            stripeTokenHandler(idForm, result.token);
        }
    });
}

function saveStripeCard(idStripeCustomer) {
    var cardholderName = document.getElementById('cardholderName');
    stripe.createPaymentMethod({
            type           : 'card',
            card           : card,
            billing_details: {
                name: cardholderName.value,
            },
        }
    ).then(function (result) {
        if (result.error) {
            // resultContainer.textContent = result.error.message;
            console.log(result.error);
        } else {
            $.ajax({
                type: "POST",
                url : "/ajax/attachStripePaymentMethodToCustomer.php",
                data: {result: result, idStripeCustomer: idStripeCustomer}
            });
        }
    });
}

function stripeTokenHandler(idForm, token) {
    $("#" + idForm + " input[name=stripeToken]").val(token.id);
}

//4000001240000000
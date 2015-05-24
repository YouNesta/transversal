/**
 * Created by Younes on 24/05/15.
 */
function stripeResponseHandler(status, response)
{
    if (response.error)
    {
        // Stripe.js failed to generate a token. The error message will explain why.
        // Usually, it's because the customer mistyped their card info.
        // You should customize this to present the message in a pretty manner:
        alert(response.error.message);
        $('input').css({backgroundColor: "white"});
    }
    else
    {
        // Stripe.js generated a token successfully. We're ready to charge the card!
        var token = response.id;
        var firstName = $("#first-name").val();
        var lastName = $("#last-name").val();
        var email = $("#email").val();

        // We need to know what amount to charge. Assume $20.00 for the tutorial.
        // You would obviously calculate this on your own:
        var price = 20;

        // Make the call to the server-script to process the order.
        // Pass the token and non-sensitive form information.
        var request = $.ajax ({
            type: "POST",
            url: "src/Website/Controller/PaymentController.php",
            dataType: "json",
            data: {
                "stripeToken" : token,
                "firstName" : firstName,
                "lastName" : lastName,
                "email" : email,
                "price" : price
            }
        });
        alert(request.done)

        request.done(function(msg)
        {
            if (msg.result === 0)
            {
                // Customize this section to present a success message and display whatever
                // should be displayed to the user.
                alert("The credit card was charged successfully!");
            }
            else
            {
                // The card was NOT charged successfully, but we interfaced with Stripe
                // just fine. There's likely an issue with the user's credit card.
                // Customize this section to present an error explanation
                alert("The user's credit card failed.");
            }
        });

        request.fail(function(jqXHR, textStatus)
        {
            console.log(jqXHR.responseText);
            // We failed to make the AJAX call to pay.php. Something's wrong on our end.
            // This should not normally happen, but we need to handle it if it does.
            alert("Error: failed to call pay.php to process the transaction.");
        });
    }
}

$(document).ready(function()
{
    $('#buy-form').submit(function(event)
    {
        // immediately disable the submit button to prevent double submits

        var fName = $('#first-name').val();
        var lName = $('#last-name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var passwordCheck = $('#passwordCheck').val();
        var adress = $('#adress').val();
        var city = $('#city').val();
        var postalCode = $('#postalCode').val();
        var cardNumber = $('#card-number').val();
        var cardCVC = $('#card-security-code').val();
        var errorLog = [];


        // First and last name fields: make sure they're not blank

        if (lName === "") {
            $('#last-name').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer de Nom de Famille");
        }
        if (fName === "") {
            $('#first-name').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer de Prénom");
        }

        // Validate the email address:
        var emailFilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (email === "") {
            $('#email').css({backgroundColor: "red"});
            errorLog.push("Vous n'avez pas entrer d'email");
        } else if (!emailFilter.test(email)) {
            errorLog.push("Votre email n'est pas valide");
            $('#email').css({backgroundColor: "red"});
        }
        if (password === "") {
            $('#password').css({backgroundColor: "red"});

        }
        if (passwordCheck === "") {
            $('#password').css({backgroundColor: "red"});

        }else if (password != passwordCheck ) {
            showErrorDialogWithMessage("Vos Password sons differents");
            $('#password').css({backgroundColor: "red"});
            $('#passwordCheck').css({backgroundColor: "red"});
        }

        // Stripe will validate the card number and CVC for us, so just make sure they're not blank
        if (cardNumber === "") {
            $('#card-number').css({backgroundColor: "red"});

        }
        if (cardCVC === "") {
            $('#card-security-code').css({backgroundColor: "red"});

        }
        for (error in errorLog){
            $("#errorLog").append('<br>'+errorLog[error]);
        }

        // Boom! We passed the basic validation, so we're ready to send the info to
        // Stripe to create a token! (We'll add this code soon.)
        Stripe.createToken({
            number: cardNumber,
            cvc: cardCVC,
            exp_month: $('#expiration-month').val(),
            exp_year: $('#expiration-year').val()
        }, stripeResponseHandler);

// Prevent the default submit action on the form
        return false;
    });
})
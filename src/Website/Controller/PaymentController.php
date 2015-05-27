<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 24/05/15
 * Time: 21:48
 */
namespace Website\Controller;
use Website\Model\PaymentManager;
class PaymentController extends AbstractBaseController{

    function returnErrorWithMessage($message)
    {
        $a = array('result' => 1, 'errorMessage' => $message);
        echo json_encode($a);
    }

    function PaymentAction($request){
        if ($request['request']) {

// Credit Card Billing
            // change this path to wherever you put the Stripe PHP library!

            $trialAPIKey = "sk_test_t0HuhvBQGHCUZwQ9Eqk4aCIW";  // These are the SECRET keys!
            $liveAPIKey = "sk_test_t0HuhvBQGHCUZwQ9Eqk4aCIW";

            \Stripe\Stripe::setApiKey($trialAPIKey);  // Switch to change between live and test environments

// Get all the values from the form
            $token = $request['request']['stripeToken'];
            $email = $request['request']['email'];
            $firstName = $request['request']['firstName'];
            $lastName = $request['request']['lastName'];
            $price = $request['request']['price'];
            $array = array();

            $priceInCents = $price * 100;   // Stripe requires the amount to be expressed in cents
            try
            {
                // We must have all of this information to proceed. If it's missing, balk.
                if (!isset($token)) throw new Exception("Website Error: The Stripe token was not generated correctly or passed to the payment handler script. Your credit card was NOT charged. Please report this problem to the webmaster.");
                if (!isset($email)) throw new Exception("Website Error: The email address was NULL in the payment handler script. Your credit card was NOT charged. Please report this problem to the webmaster.");
                if (!isset($firstName)) throw new Exception("Website Error: FirstName was NULL in the payment handler script. Your credit card was NOT charged. Please report this problem to the webmaster.");
                if (!isset($lastName)) throw new Exception("Website Error: LastName was NULL in the payment handler script. Your credit card was NOT charged. Please report this problem to the webmaster.");
                if (!isset($priceInCents)) throw new Exception("Website Error: Price was NULL in the payment handler script. Your credit card was NOT charged. Please report this problem to the webmaster.");

                try
                {
                    // create the charge on Stripe's servers. THIS WILL CHARGE THE CARD!
                    $charge = \Stripe\Charge::create(array(
                            "amount" => $priceInCents,
                            "currency" => "eur",
                            "card" => $token,
                            "description" => $email)
                    );

                    // If no exception was thrown, the charge was successful!
                    // Here, you might record the user's info in a database, email a receipt, etc.

                    // Return a result code of '0' and whatever other information you'd like.
                    // This is accessible to the jQuery Ajax call return-handler in "buy-controller.js"
                    $array = array('result' => 0, 'email' => $email, 'price' => $price, 'message' => 'Thank you; your transaction was successful!');


                }
                catch (Stripe_Error $e)
                {
                    // The charge failed for some reason. Stripe's message will explain why.
                    $message = $e->getMessage();
                    $this->returnErrorWithMessage($message);
                }
                $paymentManager = new PaymentManager($this->getConnection());
                $paymentManager->paymentSuccess($email);
                return [
                    'result' => $array,
                    'ajax' => 'src/Website/View/ajax/PaymentSuccess.html.php',

                ];
            }
            catch (Exception $e)
            {
                // One or more variables was NULL
                $message = $e->getMessage();
                $this->returnErrorWithMessage($message);
            }

        }else {

            return [
                'view' => 'src/Website/View/user/userPayment.html.php',
            ];
        }
    }}
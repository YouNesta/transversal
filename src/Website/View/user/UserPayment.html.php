<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 24/05/15
 * Time: 00:31
 */
?>
<head>

    <script src="https://js.stripe.com/v1/"></script>
    <script src="asset/js/buy-controller.js"></script>
    <script>
        Stripe.setPublishableKey('pk_test_uktBoAqaMQMofp5gZ1M7kkE3');   // Test key!
    </script>

</head>

<form  method="post" id="buy-form" action="javascript:" >

    <h2 class="form-label">Last Name:</h2>
    <input class="text" id="last-name" spellcheck="false" name="lastname" placeholder="STERZATI"><br/>

    <h2 class="form-label">First Name:</h2>
    <input class="text" id="first-name" spellcheck="false" name="firstname" placeholder="Paloma"><br/>

    <h2 class="form-label">Email Address:</h2>
    <input class="text" id="email" name="email" spellcheck="false" placeholder="paloma.sterzati@supinternet.fr" style="font-size: 2.5vh"><br/>

    <h2 class="form-label">Credit Card Number:</h2>
    <input class="text" id="card-number" autocomplete="off" placeholder="4242424242424242"><br/>

    <h2 class="form-label">Expiration Date:</h2>
    <select id="expiration-month">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
    <select id="expiration-year">
        <?php
        $yearRange = 20;
        $thisYear = date('Y');
        $startYear = ($thisYear + $yearRange);

        foreach (range($thisYear, $startYear) as $year)
        {
            if ( $year == $thisYear) {
                print '<option value="'.$year.'" selected="selected">' . $year . '</option>';
            } else {
                print '<option value="'.$year.'">' . $year . '</option>';
            }
        }
        ?>
    </select><br/>

    <h2 class="form-label">CVC:</h2>
    <input class="text" id="card-security-code" autocomplete="off" placeholder="665"><br>

    <button id="buy-submit-button" type="submit" >√</button>
</form>

<div id="errorLog">

</div>

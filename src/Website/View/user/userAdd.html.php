<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 16/05/15
 * Time: 16:02
 */

/**action="index.php?p=user_add"*/

require_once('vendor/autoload.php');
?>
<head>

    <script src="https://js.stripe.com/v1/"></script>
    <script src="asset/js/buy-controller.js"></script>
    <script>
        Stripe.setPublishableKey('pk_test_uktBoAqaMQMofp5gZ1M7kkE3');   // Test key!
    </script>

</head>
<br />
<font size='1'><table class='xdebug-error xe-fatal-error' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
        <tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Fatal error: Class 'Stripe\Stripe' not found in /Users/Younes/Documents/GitHub/transversal/transversalProject/src/Website/Controller/PaymentController.php on line <i>21</i></th></tr>
        <tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
        <tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
        <tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0018</td><td bgcolor='#eeeeec' align='right'>249360</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='/Users/Younes/Documents/GitHub/transversal/transversalProject/src/Website/Controller/PaymentController.php' bgcolor='#eeeeec'>../PaymentController.php<b>:</b>0</td></tr>
    </table></font>
<form  method="post" id="buy-form" action="javascript:" >

    <label class="form-label">Last Name:</label>
    <input class="text" id="last-name" spellcheck="false" name="lastname"><br/>

    <label class="form-label">First Name:</label>
    <input class="text" id="first-name" spellcheck="false" name="firstname"><br/>

    <select id="day"
            name="day" />
    <?php;
    foreach (range(1, 31) as $day)
    {
        if ( $day == 14) {
            print '<option value="'.$day.'" selected="selected">' . $day . '</option>';
        } else {
            print '<option value="'.$day.'">' . $day . '</option>';
        }
    }?>
    </select>
    <select id="month" name="month">
        <option value="1">Janvier</option>
        <option value="2">Fevrier</option>
        <option value="3">Mars</option>
        <option value="4">Avril</option>
        <option value="5">Mai</option>
        <option value="6">Juin</option>
        <option value="7">Juillet</option>
        <option value="8">Aout</option>
        <option value="9">Septembre</option>
        <option value="10">Octobre</option>
        <option value="11">Novembre</option>
        <option value="12">Decembre</option>
    </select>
    <select id="year" name="year">
        <?php
        $yearRange = 18;
        $thisYear = date('Y');
        $startYear = ($thisYear - $yearRange);

        foreach (range($startYear, 1960) as $year)
        {
            if ( $year == $thisYear) {
                print '<option value="'.$year.'" selected="selected">' . $year . '</option>';
            } else {
                print '<option value="'.$year.'">' . $year . '</option>';
            }
        }
        ?>
    </select><br/>

    <label class="form-label">Email Address:</label>
    <input class="text" id="email" name="email" spellcheck="false"><br/>

    <input type="password"  id="password" name="password" placeholder="Password"/><br>
    <input type="password" id="passwordCheck" name="passwordCheck" placeholder="Password"/><br>

    <input type="text" id="adress" name="adress" placeholder="21 Jump Street"/><br>
    <input type="text" id="city" name="city" placeholder="Kingston"/><br>
    <input type="number" id="postalCode" name="postalCode" placeholder="75000"/><br>

    <input type="radio" name="subscription" value=1 checked> Basic<br>
    <input type="radio" name="subscription" value=2> Basic Plus<br>
    <input type="radio" name="subscription" value=3> Premium <br/>

    <label class="form-label">Credit Card Number:</label>
    <input class="text" id="card-number" autocomplete="off"><br/>

    <label class="form-label">Expiration Date:</label>
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

    <label class="form-label">CVC:</label>
    <input class="text" id="card-security-code" autocomplete="off">

    <input id="buy-submit-button" type="submit" value="Place This Order »">
</form>


<div id="errorLog">

</div>


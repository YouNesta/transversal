<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 16/05/15
 * Time: 16:02
 */
?>

<form  method="post" id="add-form" action="index.php?p=user_add" >
    <div class="left">
    <h2 class="form-label">Nom de famille:</h2>
    <input class="text" id="last-name" spellcheck="false" name="lastname" placeholder="Zamor"><br/>
    <h2 class="form-label">Prénom:</h2>
    <input class="text" id="first-name" spellcheck="false" name="firstname" placeholder="Julien"><br/>

    <h2 class="form-label">Date de naissance:</h2>
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
    </div>
    <div class="">
    <h2 class="form-label">Email:</h2>
    <input class="text" id="email" name="email" spellcheck="false"><br/>

    <h2 class="form-label">Mots de passe:</h2>
    <input type="password"  id="password" name="password" placeholder="Password"/><br>
    <input type="password" id="passwordCheck" name="passwordCheck" placeholder="Password"/><br>

    <h2 class="form-label">Adress:</h2>
    <input type="address" id="adress" name="adress" placeholder="21 Jump Street"/><br>
    <input type="text" id="city" name="city" placeholder="Kingston"/><br>
    <input type="number" id="postalCode" name="postalCode" placeholder="75000"/><br>
    </div>
    <div class="right">
    Basic<input type="radio" name="subscription" value=1 checked><br>
    Basic Plus<input type="radio" name="subscription" value=2><br>
    Premium<input type="radio" name="subscription" value=3> <br/>
    </div>
    <button id="buy-submit-button" type="submit">√</button>
</form>


<div id="errorLog">

</div>


<?php
if(isset($request['session']['user'])){
    $user = true;
}else{
    $user = false;
};

?>
<form action="?p=show_contact" method="post">
    <h2 style="padding-top:0">Nous contacter</h2>
    <h2 class="form-label">Nom de famille*:</h2>
    <input type="text" name="lastname" value="<?php if($user) echo $request['session']['user']['lastname'];?>"/><br>
    <h2 class="form-label">Prénom*:</h2>
    <input type="text" name="firstname" value="<?php if($user) echo $request['session']['user']['firstname'];?>"/><br>
    <h2 class="form-label">Email*:</h2>
    <input type="email" name="email" value="<?php if($user) echo $request['session']['user']['email'];?>"/><br>
    <input type="hidden" name="subscription" value="<?php if($user) {echo $request['session']['user']['stateSubscription'];}else{echo 'Non connecté ou non inscrit';}?>"><br>
    <h2 class="form-label">Votre Message*:</h2>
    <textarea name="comment" id="comment" cols="50" rows="10"> </textarea><br>
    <button type="submit">√</button>
</form>
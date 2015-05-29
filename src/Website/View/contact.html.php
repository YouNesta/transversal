<?php
if(isset($request['session']['user'])){
    $user = true;
}else{
    $user = false;
};

?>
<form action="?p=show_contact" method="post">
    <h2 style="padding-top:10vh">Nous contacter</h2>
    <input type="text" name="lastname" value="<?php if($user) echo $request['session']['user']['lastname'];?>"/><br>
    <input type="text" name="firstname" value="<?php if($user) echo $request['session']['user']['firstname'];?>"/><br>
    <input type="email" name="email" value="<?php if($user) echo $request['session']['user']['email'];?>"/><br>
    <input type="hidden" name="subscription" value="<?php if($user) {echo $request['session']['user']['stateSubscription'];}else{echo 'Non connecté ou non inscrit';}?>"><br>
    <textarea name="comment" id="comment" cols="50" rows="10"> </textarea><br>
    <button type="submit">√</button>
</form>
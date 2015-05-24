<?php
if(isset($request['session']['user'])){
    $user = true;
}else{
    $user = false;
};

?>
<form action="?p=show_contact" method="post">
    <input type="text" name="lastname" value="<?php if($user) echo $request['session']['user']['lastname'];?>"/>
    <input type="text" name="firstname" value="<?php if($user) echo $request['session']['user']['firstname'];?>"/>
    <input type="email" name="email" value="<?php if($user) echo $request['session']['user']['email'];?>"/>
    <input type="hidden" name="subscription" value="<?php if($user) {echo $request['session']['user']['stateSubscription'];}else{echo 'Non connecté ou non inscrit';}?>">
    <textarea name="comment" id="comment" cols="30" rows="10"> </textarea>
    <input type="submit"/>
</form>
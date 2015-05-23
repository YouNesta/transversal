<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 23/05/15
 * Time: 15:20
 */


var_dump($response['products'][0]['category']);
echo '<table>';
foreach ($response['products'] as $content) {
    echo '<td>';
    echo '<img src="asset/images/'.$content["class"].'/'.sha1($content["name"]).'.jpg" >';
    echo '<div class="productName"  >'.$content["name"].'</div>';
    echo '<div class="class"  >'.$content["class"].'</div>';
    echo '<div class="subclass"  >'.$content["subclass"].'</div>';
   foreach($content['category'] as $value){
       echo '<div class="category"  >'.$value.'</div>';
   }
    echo '</td>';
}
echo '</table>';
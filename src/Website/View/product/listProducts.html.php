<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 23/05/15
 * Time: 15:20
 */

?>

<head>
    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="asset/owl-carousel/owl.carousel.css">

    <!-- Default Theme -->
    <link rel="stylesheet" href="asset/owl-carousel/owl.theme.css">


    <!-- Include js plugin -->
    <script src="asset/owl-carousel/owl.carousel.js"></script>
</head>

<?
echo '<div id="owl-example" class="owl-carousel" style="margin:auto">';
foreach ($response['products'] as $content) {
    echo '<div>';
    echo '<img class="products" src="asset/images/products/'.$content["class"].'/'.$content["name"].'.jpg" >';
    echo '<h3 class="productName"  >'.$content["name"].'</h3>';
    echo '<h3 class="class"  >'.$content["class"].'</h3>';
    echo '<h3 class="subclass"  >'.$content["subclass"].'</h3>';
   foreach($content['category'] as $value){
       echo '<h3 class="category"  >'.$value.'</h3>';
   }
    echo '</div>';
}
echo '<div><script>$(document).ready(function() {

  $("#owl-example").owlCarousel({
  items : 3,
  navigation : true
  });

});</script>';
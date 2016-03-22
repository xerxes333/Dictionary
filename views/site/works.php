<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Triple 3 Studios';
?>

<style type="text/css">
    div.wrap{
        /*background-color: #222;*/
    }
    
    a, img {

  color: #3282e6;
  border-style: none;
  outline: none;
  text-decoration: none;
  margin: 0.5px;

}
</style>

<div class="site-index">
    <div class="row">        
        <div class="col-md-6">
            <? echo HTML::a(HTML::img("@web/images/ridenhour_screenshot.jpg"), "http://voteridenhour.com" , ["target" => "_new"]) . " "; ?>
        </div>
        <div class="col-md-6">
            Election website for Mecklenburg County Commisioner Matthew Ridenhour.
            
        </div>
    </div>
    
</div>
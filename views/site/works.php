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
        <div class="col-sm-12 col-works-info">
            <h2>Here are some things I have made</h2>
            <h4>(click on the image to view)</h4>
        </div>
    </div>
    <hr>
    <? foreach ($works as $work): ?>
        <div class="row">        
            <div class="col-sm-4 col-works-img">
                <? echo HTML::a(HTML::img("@web/images/works/{$work['img']}"), $work['link'] , ["target" => "_new"]) . " "; ?>
            </div>
            <div class="col-sm-8 col-works-desc">
                <? echo $work['desc']; ?>
            </div>
        </div>
        <hr>
    <? endforeach; ?>

</div>
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
        <div class="col-md-12 text-center">

			<? //echo HTML::img('@web/images/T3S.png') ?>
			<? foreach ($social as $name => $href) {
				echo HTML::a(HTML::img("@web/images/social/64/{$name} icon.png"), $href, ["target" => "_new"]) . " ";
			} ?>
			
		</div>
    </div>
</div>
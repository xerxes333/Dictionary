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
			<br>
			<br>
			
			<? echo HTML::a(HTML::img('@web/images/social/64/facebook icon.png'), "https://facebook.com/xerxes333", ["target" => "_new"]); ?>
			<? echo HTML::a(HTML::img('@web/images/social/64/twitter icon.png'), "https://twitter.com/xerxes333", ["target" => "_new"]); ?>
			<? echo HTML::a(HTML::img('@web/images/social/64/instagram icon.png'), "https://instagram.com/xerxes333", ["target" => "_new"]); ?>
			<? echo HTML::a(HTML::img('@web/images/social/64/pinterest icon.png'), "https://pinterest.com/jdraxler", ["target" => "_new"]); ?>
			
			<? echo HTML::a(HTML::img('@web/images/social/64/stackoverflow icon.png'), "http://stackoverflow.com/users/1332233/xerxes333", ["target" => "_new"]); ?>
			<? echo HTML::a(HTML::img('@web/images/social/64/github icon.png'), "https://github.com/xerxes333", ["target" => "_new"]); ?>
			<? echo HTML::a(HTML::img('@web/images/social/64/bitbucket icon.png'), "https://bitbucket.com/xerxes333", ["target" => "_new"]); ?>
			<? echo HTML::a(HTML::img('@web/images/social/64/linkedin icon.png'), "https://www.linkedin.com/pub/jeremy-draxler/11/b76/309", ["target" => "_new"]); ?>
			
		</div>
    </div>
    
</div>
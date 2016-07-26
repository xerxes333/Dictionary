<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this -> title = 'T3S - jsTree Challenge';

$play = '<span class="glyphicon glyphicon-play" aria-hidden="true"></span>';
$pause = '<span class="glyphicon glyphicon-pause" aria-hidden="true"></span>';
?>
<div class="site-dictionary">

    <h2>jsTree Challenge</h2>
    <div class="row">
        <?
        echo \yii\bootstrap\Collapse::widget([
            'items' => [[
                'label' => 'Challenge Info (click to expand)', 
                'content' => $this->context->renderPartial('jstree_info'), 
            ]]
        ]);
        ?>
    </div>

    <h2>jsTree Solution</h2>
    <div class="row">
        <div class="well">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">  
                    
                    <div style="margin-bottom: 10px;">
                        <?= Html::button('Reset Tree', ['class' => 'btn btn-primary','id'=>'reset-tree']) ?>
                        <?= Html::button("Enable Async {$play}", ['class' => 'btn btn-success','id'=>'async-off', 'value' => 0]) ?>
                        <?= Html::button("Disable Async {$pause}", ['class' => 'btn btn-danger hidden','id'=>'async-on', 'value' => 1]) ?>
                    </div>
                    
                    <div id="html1">
                      <ul>
                        <li>Root node 1</li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>My Thoughts</h2>
            <p>
                This challenge had pretty basic requirements, I've never used the jsTree library but its pretty straight forward and was pretty easy to pick up.   
            </p>
            <p>
                I added two buttons (not in the requirements).  The Reset button will clean up the database to the original state of one pre-generated Factory.
                The Async button allows the user to turn on/off the short polling, which is turned off by default to reduce the number of async calls to the API.   
            </p>
            <p>
                The only somewhat challenging requirement was the "live updates".  I considered several options but ended up going with short polling.  
                I decided on this approach because my production environment (godaddy, i know i know, get off my back) is not currently set up for real time user interaction 
                (using things like Angular or React) and the challenge requested that I host my solution on a live server.
            </p>
            <p>
                I have been experimenting more with Node.js, Meteor, Angular, and React since its essentially a required skill in todays industry. 
            </p>
            <p>
                I also found it odd that the challenge never requested my source code, rather they only asked for a link to my solution. *shrugs*
            </p>
        </div>
    </div>

</div>

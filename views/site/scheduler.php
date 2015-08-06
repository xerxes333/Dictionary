<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
// use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
$this->title = 'T3S - Shifts Challenge';



?>
<div class="site-scheduler">
    
    <h2>Scheduler Challenge</h2>
    <div class="row">
            <? echo $collapse; ?>
    </div>
    
    
    <h2>Scheduler Solution</h2>
    <div class="row">
        <div class="well">
            <div class="row">
                <div class="col-lg-12">
                    The solution is the underlying API created in
                    <code>ShiftsController</code><a href="https://github.com/xerxes333/Dictionary/blob/master/controllers/ShiftsController.php" target="_new">(link)</a> 
                    and 
                    <code>UserController</code><a href="https://github.com/xerxes333/Dictionary/blob/master/controllers/UserController.php" target="_new">(link)</a> 
                    classes.
                    
                    <ul class="list-ununstyled scheduler-stories">
                        
                        <? foreach ($requests as $request): ?>
                        <li>
                            <?= Html::button('Run', ['class' => 'btn btn-primary btn-xs scheduler-button','value'=>$request->action]) ?>
                            <? echo $request->text; ?>
                        </li>
                        <? endforeach; ?>
                        
                    </ul>
                    
                    
                    
                    <hr>
                    <div class="" id="results-well">
                        <p>
                            <h4>Example Request:</h4> 
                            <code id="url">request</code>
                        </p>
                        
                        <p>
                            <h4>Example Response:</h4> 
                            <div id="results">
                                <pre style="font-size: 11px;">results</pre>
                            </div>
                        </p>
                        
                    </div>
                    
                    <div class="alert alert-info" role="alert">These actually call the API, they are NOT just dumping out static JSON results.</div>
                    
                </div>
            </div>
        </div>
    </div>

</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
// use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
$this->title = 'T3S - Shifts Challenge';

?>
<div class="site-scheduler">
    
    
    <div class="row">
        <div class="col-lg-12">
            <h2>Scheduler Challenge</h2>
            <? echo $collapse; ?>
        </div>
    </div>

    
    
    <div class="row">
        <div class="col-lg-12">
            <h2>Scheduler Solution</h2>
            
            <div class="well">
                <div class="row">
                    <div class="col-lg-12">
                        The solution is the underlying API created in
                        <code>ShiftsController</code><a href="https://github.com/xerxes333/Dictionary/blob/master/controllers/ShiftsController.php" target="_new">(link)</a> 
                        and 
                        <code>UserController</code><a href="https://github.com/xerxes333/Dictionary/blob/master/controllers/UserController.php" target="_new">(link)</a> 
                        classes.
                        
                        <p class="text-primary">*NOTE: These buttons make AJAX requests to the API (code located in the app.js file), they are not just rendering static JSON results.</p>
                        
                        <ol class="list-ununstyled scheduler-stories">
                            
                            <? foreach ($requests as $request): ?>
                            <li>
                                <?= Html::button('Run', ['class' => 'btn btn-primary btn-xs scheduler-button','value'=>$request->action]) ?>
                                <? echo $request->text; ?>
                            </li>
                            <? endforeach; ?>
                            
                        </ol>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div class="row">
        <div class="col-lg-12">
            
            <h2>My Thoughts</h2>
            <p>
                Over all pretty simple and straight forward challenge, no tricks or anything like that.  
                The only real issue I ran into was dumbing down the built in Yii2 ActiveController actions.  
                By default the ActiveController offers all the basic CRUD options and the challenge states only the provided User Stories be exposed.
            </p>
            <p>
                It seemed logical, so I combined stories 1 and 4.    
            </p>
            <p>  
                I like these types of "real world" challenges rather than "trick puzzles".    
            </p>
            <p>
                <span class="text-primary"><strong>TODO:</strong></span>
                <? echo HTML::ul([
                    "Need to add authentication to the API request",
                    "Need to clean up and document SiteController curl action",
                 ]); ?>
                
            </p>
        </div>
    </div>

</div>

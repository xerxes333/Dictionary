<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
// use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
$this->title = 'T3S - Shifts Challenge';
?>
<div class="site-dictionary">
    
    <h2>Scheduler Challenge</h2>
    <div class="row">
            <? echo $collapse; ?>
    </div>
    
    
    <h2>Scheduler Solution</h2>
    <div class="row">
        <div class="well">
            <div class="row">
                <div class="col-lg-12">
                    The solution is the underlying API created in <code>ShiftsController</code>and <code>UserController</code> classes.
                    Here we are simply using the API to show examples.
                    
                    <br><br>
                    As an employee, I want to know when I am working, by being able to see all of the shifts assigned to me.
                </div>
            </div>
        </div>
    </div>

</div>

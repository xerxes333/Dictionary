<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */
/* @var $form ActiveForm */
?>
<div class="GoalForm">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'userId') ?>
        <?= $form->field($model, 'createdAt') ?>
        <?= $form->field($model, 'parentId') ?>
        <?= $form->field($model, 'updatedAt') ?>
        <?= $form->field($model, 'completedAt') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- GoalForm -->

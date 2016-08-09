<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'deadline')->textInput(['maxlength' => true])->input('deadline', ['placeholder' => "YYYY-MM-DD hh:mm:ss"]) ?>
    
    <?= $form->field($model, 'userId')->hiddenInput(['value'=> Yii::$app->user->getId()])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>

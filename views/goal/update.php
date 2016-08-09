<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */

$this->title = 'Update Goal: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Goals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    
    <h2>Milestones</h2>
    
    <?= Html::ul($model->getMilestones(), ['item' => function($milestone, $index) {
        return Html::tag('li',$milestone->title);
    }]) ?>
    
    <?= Html::a('Add Milestone', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

</div>

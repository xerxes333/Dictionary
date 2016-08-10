<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */

if($model->parentId == null)
    $this->title = 'Update Goal: ' . $model->title;
else
    $this->title = 'Update Milestone: ' . $model->title;
 
$this->params['breadcrumbs'][] = ['label' => 'Goals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    <?php //var_dump($milestones); ?>
    
    <h2>Milestones</h2>
    <?= GridView::widget([
        'dataProvider' => $milestones,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'deadline',
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
    
    <?= Html::a('Add Milestone', ['create', 'parentId' => $model->id], ['class' => 'btn btn-primary']) ?>

</div>

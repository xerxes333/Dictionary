<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Goal */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Goals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-view">

    <div class="jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>
        <h3><p class="text-success"><?= $model->getPercentCompleted(); ?>% Complete</p></h3>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h2>Milestones</h2>
            
            <?php
            echo GridView::widget([
                'dataProvider' => $milestones,
                'columns' => [
                    'title',
                    // ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            
        </div>
        
        <div class="col-lg-6">
            <h2>Log</h2>
            <?php
            echo GridView::widget([
                'dataProvider' => $log,
                'columns' => [
                    'info',
                    [
                        'value' => function ($data) {
                            return $data->progress;
                        },
                        'label' => '%'
                    ],
                    'createdAt',
                ],
            ]);
            ?>
            
        </div>
        
    </div>    
    
    <hr>
    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Complete', ['complete', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'createdAt',
            'updatedAt',
            'completedAt',
        ],
    ]) ?>
    

</div>

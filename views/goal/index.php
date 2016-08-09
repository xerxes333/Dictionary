<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Progress;


/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goal-index">
    
    <h2>Goals Challenge</h2>
    <div class="row">
        <?
        echo \yii\bootstrap\Collapse::widget([
            'items' => [[
                'label' => 'Challenge Info (click to expand)', 
                'content' => $this->context->renderPartial('goals_md'), 
            ]]
        ]);
        ?>
    </div>
    
    <h2>Goals Solution</h2>
    <div class="row">
        <div class="well">
            <div class="row">
                <div class="col-lg-12 ">
                    
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    
                    <p>
                        <?= Html::a('Create Goal', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'title',
                            'deadline',
                            'createdAt',
                            [
                                'value' => function ($data) {
                                    return $data->getPercentCompleted();
                                },
                                'label' => '% Completed'
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    
                </div>
            </div>
        </div>
    </div>

</div>

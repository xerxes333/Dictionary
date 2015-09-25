<?php

namespace app\modules\scheduler\controllers;
use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\scheduler\models\WiwApiCall;



class DefaultController extends Controller
{
    public function actionIndex()
    {
        // quick and dirty shift table propigation
        // WiwShift::generateRandomShifts();
        
        $link = "https://github.com/wheniwork/standards/blob/master/project.md";
        $md = $this->renderPartial('scheduler_md');
        
        $collapse = \yii\bootstrap\Collapse::widget([
            'items' => [
                [
                    'label' => 'Challenge Info (click to expand)',
                    'content' => 'Source: ' . Html::a($link, $link) . $md,
                    // 'contentOptions' => ['class' => 'in']
                ]
            ]
        ]);
        
        $requests = WiwApiCall::find()->all();
        
        return $this->render('scheduler',[
            'collapse'  => $collapse,
            'requests'  => $requests,
        ]);
    }
    
    private function getApiUrl(){
        $module = Yii::$app->controller->module;
        
        return $url;
    }
    
    public function actionCurl($action = null){
        
        if(empty($action))
            return json_encode(["url" => "Invalid Action","response" => "Invalid Action",]);
        
        $wiw = WiwApiCall::find()->where(['action'=>$action])->one();
        
        $response = $wiw->processRequest();
        
        return json_encode($response);     


    }
        
}

<?php

namespace app\modules\scheduler\controllers;
use Yii;
use yii\web\Controller;
use app\modules\scheduler\models;
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\scheduler\models\WiwApiCall;
use app\modules\scheduler\models\WiwShift;

use yii\helpers\ArrayHelper;
use GuzzleHttp\Client;

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
    
    public function actionCurl(){
        
        $module = Yii::$app->controller->module;
        $req    = Yii::$app->request;
        $action = $req->get('action');
        
        $api    = WiwApiCall::find()->where(['action'=>$action])->one();
        $url    = "http://{$req->servername}/{$module->id}{$api->url}";
        $html   = '';
        
        // messing with Guzzle
        $client = new Client(['headers' => ['Accept' => 'application/json',]]); 
        
        switch ($api->method) {
            case 'GET':
                $response = $client->get($url);
                break;
            case 'POST':
                $enc = json_decode($api->data,true);
                $response = $client->post($url, ['form_params' => $enc]);
                
                // this just deletes the newly created shift to keep clutter out of the database
                if($api->action == 'mgr_create')
                    $this->deleteShiftExample($response);
                break;
            case 'PUT':
                $enc = json_decode($api->data,true);
                $response = $client->put($url, ['form_params' => $enc]);
                break;
            default:
                // do nothing
                break;
        }
        
        // tomfoolery here to pretty print guzzle results
        $body = json_decode($response->getBody());
        $response = json_encode($body,JSON_PRETTY_PRINT);
        
        $data = [
            "url" => "{$api->method} {$url}" . (!empty($api->data)? " --data '$api->data'" : ""),
            "response" => $response,
        ];
        
        return json_encode($data);
    }

    /**
     * This just deletes the newly create shift to keep redundant clutter out of the schema table
     */
    private function deleteShiftExample($response){
        $obj = json_decode($response->getBody());
        $shift = WiwShift::findOne($obj->id);
        $shift->delete();
        return true;
    }
    
}

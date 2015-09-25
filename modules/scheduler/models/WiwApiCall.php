<?php

namespace app\modules\scheduler\models;

use Yii;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use app\modules\scheduler\models\WiwShift;

/**
 * This is the model class for table "wiw_api_call".
 *
 * @property integer $id
 * @property string $text
 * @property string $action
 * @property string $method
 * @property string $url
 * @property string $data
 */
class WiwApiCall extends \yii\db\ActiveRecord
{
    public $requestUrl;
    private $endPoint;
    
    public function init()
    {
        parent::init();

        $this->setEndPoint();
        $this->setRequestUrl();
    }
    
    public function afterFind()
    {
        $this->setRequestUrl();
        parent::afterFind();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wiw_api_call';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'data'], 'string', 'max' => 255],
            [['action', 'method', 'url'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'action' => 'Action',
            'method' => 'Method',
            'url' => 'Url',
            'data' => 'Data',
        ];
    }
    
    public function setEndPoint(){
        $module = Yii::$app->controller->module;
        $req    = Yii::$app->request;
        $this->endPoint = "http://{$req->servername}/{$module->id}";;
    }
    
    public function setRequestUrl(){
        $this->requestUrl = $this->endPoint . $this->url;
    }
    
    
    public function getEndPoint(){
        return $this->endPoint;
    }
    
    private function getJsonData(){
        if(isset($this->data))
            return json_decode($this->data,true);
        return '';
    }
    
    public function processRequest(){
        
        // messing with Guzzle
        $client = new Client([
            'auth' => ['comeonfhqwhgads'],
            'headers' => ['Accept' => 'application/json']
        ]);
        
        $data = $this->getJsonData();
        
        try {
            switch (strtolower($this->method)) {
                case 'get':
                    $response = $client->get($this->requestUrl);
                    break;
                case 'post':
                    $response = $client->post($this->requestUrl, ['form_params' => $data]);
                    if($api->action == 'mgr_create')
                        $this->deleteShiftExample($response);
                    break;
                case 'put':
                    $response = $client->put($this->requestUrl, ['form_params' => $data]);
                    break;
                default:
                    // do nothing
                    break;
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $err = $response->getReasonPhrase();
            }
            
            return [
                "url" => "ERROR",
                "response" => $err,
            ];
        }
        
        // tomfoolery here to pretty print guzzle results
        $body = json_decode($response->getBody());
        $response = json_encode($body,JSON_PRETTY_PRINT);
        
        $ret = [
            "url" => "{$api->method} {$this->requestUrl}" . (!empty($this->data)? " --data '$this->data'" : ""),
            "response" => $response,
        ];
        
        return $ret;
                    
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

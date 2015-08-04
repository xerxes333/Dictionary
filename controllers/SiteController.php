<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\DictionaryForm;
use app\models\Dictionary;
use app\models\WiwShift;
use app\models\WiwUser;
use app\models\WiwApiCall;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use GuzzleHttp\Client;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'contact', 'about'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $arr = [
            'facebook'      => 'https://facebook.com/xerxes333',
            'twitter'       => 'https://twitter.com/xerxes333',
            'instagram'     => 'https://instagram.com/xerxes333',
            'pinterest'     => 'https://pinterest.com/jdraxler',
            'stackoverflow' => 'https://stackoverflow.com/users/1332233/xerxes333',
            'github'        => 'https://github.com/xerxes333',
            'bitbucket'     => 'https://bitbucket.com/xerxes333',
            'linkedin'      => 'https://www.linkedin.com/pub/jeremy-draxler/11/b76/309',
        ];
        
        return $this->render('index',[
            'social' => $arr,
        ]);
    }

    public function actionDictionary()
    {
        $model  = new DictionaryForm();
        
        if (Yii::$app->request->isPost) {
            
            $model->load(Yii::$app->request->post());
            $model->dictionaryFile = UploadedFile::getInstance($model, 'dictionaryFile');
            if($model->process())
            	 Yii::$app->session->setFlash('success', 'Success! See below for output files.');
            
            
        } else {
            // set the default params
            $model->seqLength = 4;
            $model->appearance = 1;
        }
        
        return $this->render('dictionary',[
            'model'    => $model,
        ]);
    }
    
    public function actionScheduler()
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
        
        $req    = Yii::$app->request;
        $action = $req->get('action');
        $request= WiwApiCall::find()->where(['action'=>$action])->one();
        $html   = '';
        $domain = 'http://' . Yii::$app->request->servername;
		
        // messing with Guzzle
        $client = new Client(['headers' => ['Accept' => 'application/json',]]); 
		
		switch ($request->method) {
			case 'GET':
				$response = $client->get($domain . $request->url);
				break;
			case 'POST':
                $enc = json_decode($request->data,true);
				$response = $client->post($domain . $request->url, ['form_params' => $enc]);
                
                if($request->action == 'mgr_create')
                    $this->deleteShiftExample();
                
				break;
            case 'PUT':
                $enc = json_decode($request->data,true);
                $response = $client->put($domain . $request->url, ['form_params' => $enc]);
                break;
			default:
				
				break;
		}
        
        // tomfoolery here to pretty print guzzle results
        $body = json_decode($response->getBody());
        $response = json_encode($body,JSON_PRETTY_PRINT);
        
        $data = [
            "url" => $request->method ." ". $domain . $request->url . (!empty($request->data)? " --data '$request->data'" : ""),
            "response" => $response,
        ];
        
        return json_encode($data);
    }

    public function actionDownload($name = "none"){
        $path = Url::to('@app/uploads/');
        $file = $path . $name;
        
        if (file_exists($file))
            return Yii::$app->response->sendFile($file);
        else
            return $this->goHome();
        
    }





    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    private function deleteShiftExample(){
        // immediately delete the created shift to avoid clutter in schema table
    }
}

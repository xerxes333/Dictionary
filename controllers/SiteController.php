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
    
    public function actionWorks()
    {
        return $this->render('works',[
            // 'arr' => $arr,
        ]);
    }
    
    public function actionPaintball()
    {
        $client = new Client(['headers' => ['Accept' => 'application/json',]]);
        $response = $client->get("http://gosports.herokuapp.com/channels/");
        $episodes = json_decode($response->getBody());
        
        $response = $client->get("http://gosports.herokuapp.com/events/");
        $events = json_decode($response->getBody());
        
        
        return $this->render('paintball',[
            'data' => $episodes,
            'events' => $events
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
    
    public function actionDc2015()
    {
        return $this->render('dc2015');
    }
    
    public function actionDc2016()
    {
        return $this->render('dc2016');
    }
    
}

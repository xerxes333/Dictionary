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
use yii\helpers\Url;
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
        
        
        
        $client = new Client([
            'base_uri' => 'http://dictionary.dev/',
            'headers' => [
                'Accept'     => 'application/json',
            ]
        ]);
        $response = $client->get('dictionary');
        $body = json_decode($response->getBody());
        
        $d = Dictionary::find()->all();
        
        // echo str_repeat("<br>",3);
        // var_dump($body);
        
        /**
         * The API must follow REST specification:

    POST should be used to create
    GET should be used to read
    PUT should be used to update (and optionally to create)
    DELETE should be used to delete
  
 

GET As an employee, I want to know when I am working, by being able to see all of the shifts assigned to me.
GET As an employee, I want to know who I am working with, by being able see the employees that are working during the same time period as me.
GET As an employee, I want to know how much I worked, by being able to get a summary of hours worked for each week.
GET As an employee, I want to be able to contact my managers, by seeing manager contact information for my shifts.

POST/PUT As a manager, I want to schedule my employees, by creating shifts for any employee.
GET As a manager, I want to see the schedule, by listing shifts within a specific time period.
PUT As a manager, I want to be able to change a shift, by updating the time details.
PUT As a manager, I want to be able to assign a shift, by changing the employee that will work a shift.
GET As a manager, I want to contact an employee, by seeing employee details.
         
         * 
         * 
         * 
         */
        $employee = WiwUser::findOne(2);
        var_dump($employee->shifts);
        
        for ($i=0; $i < 100; $i++) { 
            // get random employee 1-6
            // get random manager 7-9
            $emp = rand(1,6);
            $mgr = rand(7,9);
            
            $day    = rand(1,30);
            $month  = 8;
            $year   = 2015;
            $start  = rand(0,12);
            $end    = rand(12,23);
            
            // save to shifts
            $x = new WiwShift();
            $x->attributes = [
                'manager_id'    => $mgr,
                'employee_id'   => $emp,
                'start_time'    => "{$year}-{$month}-{$day} {$start}:00:00",
                'end_time'      => "{$year}-{$month}-{$day} {$end}:00:00",
                'created_at'    => date("Y-m-d H:i:s")
            ];
            // $x->save();
        }

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
}

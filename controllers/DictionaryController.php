<?
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Dictionary;

class DictionaryController extends ActiveController
{
    public $modelClass = 'app\models\Dictionary';
    
    public function actions(){
        $actions = parent::actions();
        // unset($actions['index']);
         $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
    
    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => Dictionary::find(),
            'pagination' => false,
        ]);
    }
    
    public function actionFoo()
    {
        return new ActiveDataProvider([
            'query' => Dictionary::find()->where(['like','word','abb']),
        ]);
    }

}


?>
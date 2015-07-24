<?
namespace app\controllers;

use yii\rest\Controller;
use yii\data\ActiveDataProvider;
use app\models\WiwShift;
use app\models\WiwUser;

class RequestController extends Controller
{
    
    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    
    public function actionIndex($id)
    {
        return "foo";   
    }

    public function actionWith($id)
    {
        
    }
    
}


?>
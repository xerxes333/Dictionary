<?
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\WiwUser;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\WiwUser';
    
    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }
    
    
    public function actionIndex($id)
    {
        $user = WiwUser::findOne($id);
        $user->created_at = date(DATE_RFC2822, strtotime($user->created_at));
        $user->updated_at = date(DATE_RFC2822, strtotime($user->updated_at));
		$user->phone ='foo';
        
        return $user;
        
    }
    
}


?>
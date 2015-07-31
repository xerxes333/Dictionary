<?
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\WiwUser;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\WiwUser';
    
	/**
	 * Returns user information
	 * 
	 * The base ActiveController index action returns the user information
	 * 
	 * @requirement : As a manager, I want to contact an employee, by seeing employee details.
	 * @example http://dictionary.dev/users/9
	 */
	 
}


?>
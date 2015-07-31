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
	 * The base ActiveController index action handles everything for us.
     * Since we aren't doing anything fancy we can let Yii2 do all the work
     * As a manager, I want to contact an employee, by seeing employee details.
     *      @example GET http://api.domain.com/users/9
     * 
     * @param integer $id The Id of the user to retrieve
     * 
     * @return array Returns all the WiwUser model info
     * 
	 */
	 
}


?>
<?
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\WiwShift;
use app\models\WiwUser;

class ShiftsController extends ActiveController
{
    public $modelClass = 'app\models\WiwShift';
    
    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
         // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
    
    public function prepareDataProvider($x)
    {
        return new ActiveDataProvider([
            'query' => WiwShift::find()->where(['employee_id'=>1]),
            'pagination' => false,
        ]);
    }

    public function actionIndex($id)
    {   
        $shifts = WiwShift::find()
            ->select(['id','start_time', 'end_time'])
            ->where(['employee_id'=>$id])
            ->orderBy('start_time ASC')
            ->all();
        
        foreach ($shifts as $key => $shift) {
            $shift->start_time = date(DATE_RFC2822, strtotime($shift->start_time));
            $shift->end_time = date(DATE_RFC2822, strtotime($shift->end_time));
        }
        
        return ["shifts" => $shifts];
        
        // return new ActiveDataProvider([
            // 'query' => WiwShift::find()->select(['start_time', 'end_time'])->where(['employee_id'=>$id]),
            // 'pagination' => false,
        // ]);
    }

    public function actionWith($user_id)
    {
        $shifts = WiwShift::find()
            ->select(['id','start_time', 'end_time'])
            ->where(['employee_id'=>$user_id])
            ->orderBy('start_time ASC')
            ->all();
            
        // for each shift get any employee that overlaps
        $shifts->workingWith();
        
        return ["method" => "with"];
    }
    
}


?>
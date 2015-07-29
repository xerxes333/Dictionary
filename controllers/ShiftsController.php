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

    /**
     * As an employee, I want to know when I am working, by being able to see all of the shifts assigned to me. 
     * As an employee, I want to be able to contact my managers, by seeing manager contact information for my shifts.
     */
    public function actionIndex($user_id)
    {   
        $shifts = WiwShift::find()
            ->where(['employee_id'=>$user_id])
            ->orderBy('start_time ASC')
            ->all();
        
        foreach ($shifts as $key => $shift) {
            
            $data['id'] = $shift->id; 
            $data['start_time'] = date(DATE_RFC2822, strtotime($shift->start_time)); 
            $data['end_time'] = date(DATE_RFC2822, strtotime($shift->end_time));
            $data['manager'] = [
                'name' => $shift->manager->name,
                'email' => $shift->manager->email,
                'phone' => $shift->manager->phone,
            ];
            $resutls[] = $data;
        }
        
        return ["shifts" => $resutls];
        
        // return new ActiveDataProvider([
            // 'query' => WiwShift::find()->select(['start_time', 'end_time'])->where(['employee_id'=>$id]),
            // 'pagination' => false,
        // ]);
    }

    /**
     * As an employee, I want to know who I am working with, by being able see the employees that are working during the same time period as me.
     */
    public function actionWith($user_id)
    {
        $shifts = WiwShift::find()
            ->where(['employee_id'=>$user_id])
            ->orderBy('start_time ASC')
            ->all();
        
        foreach ($shifts as $key => $shift) {
            $shift->workingWith();
            
            $data['id'] = $shift->id; 
            $data['start_time'] = date(DATE_RFC2822, strtotime($shift->start_time));
            $data['end_time'] = date(DATE_RFC2822, strtotime($shift->end_time));
            $data['working_with'] = $shift->with;
            $resutls[] = $data;
        }
        
        return ["shifts" => $resutls];
    }
    
    /**
     * As an employee, I want to know how much I worked, by being able to get a summary of hours worked for each week.
     */
    public function actionWeeklysummary($user_id)
    {
         $shifts = WiwShift::find()
            ->select([
                'WEEK(start_time,1) AS week_number', 
                'YEAR(start_time) as year',
                'SUM(HOUR(end_time)-HOUR(start_time)) AS hours_worked'])
            ->where(['employee_id'=>$user_id])
            ->groupBy(['WEEK(start_time,1)'])
            ->orderBy('start_time ASC')
            ->all();
        
        $date = new \DateTime();
        
        foreach ($shifts as $key => $shift) {
            
            $date = $date->setISODate($shift->year, $shift->week_number);
            $end = date("Y-m-d",strtotime($date->format('Y-m-d') . " +6 days"));
            
            $data['week_begin'] = $date->format('Y-m-d');
            $data['week_end'] = $end;
            $data['total_hours'] = $shift->hours_worked;
            $resutls[] = $data;
        }    
        
        return ["summary" => $resutls];    
    }
    
}


?>
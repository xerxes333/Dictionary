<?

/**
 * @requirements https://github.com/wheniwork/standards/blob/master/project.md
 */

namespace app\modules\scheduler\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\modules\scheduler\models\WiwShift;
use app\modules\scheduler\models\WiwUser;
use yii\filters\auth\HttpBasicAuth;

class ShiftsController extends ActiveController
{
    public $modelClass = 'app\modules\scheduler\models\WiwShift';
	private $results = [];
    
    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['update']);
        unset($actions['create']);
        unset($actions['delete']);
         // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // $behaviors['authenticator'] = [
            // 'class' => HttpBasicAuth::className(),
        // ];
        return $behaviors;
    }

	/**
	 * @ignore
	 */
    public function prepareDataProvider($x)
    {
        return new ActiveDataProvider([
            'query' => WiwShift::find()->where(['employee_id'=>1]),
            'pagination' => false,
        ]);
    }

    /**
     * Gets shifts for the supplied criteria
	 * 
     * This function handles a few possibilities:
     * As an employee, I want to know when I am working, by being able to see all of the shifts assigned to me. 
     * As an employee, I want to be able to contact my managers, by seeing manager contact information for my shifts.
	 *     @example GET http://api.domain.com/shifts?user_id=3
     * As a manager, I want to see the schedule, by listing shifts within a specific time period.
     *     @example GET http://api.domain.com/shifts?user_id=11&start_time=2015-08-02 00:00:00&end_time=2015-08-03 23:59:59
	 * 
     * @param integer $user_id ID of the WiwUser model
     * @param string $start_time Shift start time when searching for shifts within a time range
     * @param string $end_time Shift end time when searching for shifts within a time range
     * 
     * @return array Returns an array of matching shifts
	 * 
     */
    public function actionIndex($user_id, $start_time = null, $end_time = null)
    {
		$manager = WiwUser::findOne($user_id);
		$isManagerView = ($manager->isManager() && isset($start_time) && isset($end_time)) ? TRUE : FALSE;
		
		if($isManagerView){
			$shifts = WiwShift::find()
	            ->where(['between', 'start_time', $start_time, $end_time])
	            ->orderBy('start_time ASC')
	            ->all();
		} else {
			$shifts = WiwShift::find()
	            ->where(['employee_id'=>$user_id])
	            ->orderBy('start_time ASC')
	            ->all();
		}
			   
        
        
        foreach ($shifts as $key => $shift) {
            
            $data['id'] = $shift->id; 
            $data['start_time'] = date(DATE_RFC2822, strtotime($shift->start_time)); 
            $data['end_time'] = date(DATE_RFC2822, strtotime($shift->end_time));
			
			if($isManagerView){
				$data['employee'] = $shift->employee->name;
			} else {
				$data['manager'] = [
	                'name' => $shift->manager->name,
	                'email' => $shift->manager->email,
	                'phone' => $shift->manager->phone,
	            ];
			}
            
            $this->results[] = $data;
        }
        
        return ["shifts" => $this->results];
        
    }

    /**
     * Gets shifts and co-worker names with overlapping shifts for the employee 
     * 
     * As an employee, I want to know who I am working with, by being able see the employees that are working during the same time period as me.
     *      @example GET http://api.domain.com/shifts/with?user_id=3
     * 
     * @param integer $user_id ID of the WiwUser model
     * 
     * @return array Returns an array of matching shifts and employees names
     * 
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
            $this->results[] = $data;
        }
        
        return ["shifts" => $this->results];
    }
    
    /**
     * Gets a summary of hours worked per week for an employee
     * 
     * As an employee, I want to know how much I worked, by being able to get a summary of hours worked for each week.
	 *     @example GET http://api.domain.com/shifts/weeklysummary?user_id=3
     * 
     * @param integer $user_id ID of the WiwUser model
     * 
     * @return array Returns summation of hours worked grouped by week 
     * 
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
            $end = date(DATE_RFC2822,strtotime($date->format('Y-m-d') . " +6 days"));
            
            $data['week_begin'] = $date->format(DATE_RFC2822);
            $data['week_end'] = $end;
            $data['total_hours'] = $shift->hours_worked;
            $this->results[] = $data;
        }    
        
        return ["summary" => $this->results];    
    }
	
	/**
	 * Creates a new shift
     * 
     * As a manager, I want to schedule my employees, by creating shifts for any employee.
     * The body can include fields from the Shift Object (REQUIRED: start_time, end_time, employee_id, manager_id)
	 *     @example POST http://api.domain.com/shifts/create --data '{"manager_id":12, "employee_id":3, "start_time":"2015-08-01 01:00:00", "end_time":"2015-08-01 06:00:00"}'
     * 
     * @return array On success the new shift information is returned
     * 
	 */
	public function actionCreate()
	{
        
        // create shift object
        $shift = new WiwShift(['scenario' => WiwShift::SCENARIO_CREATE]);
        $shift->attributes  = \Yii::$app->request->getBodyParams();
		
        if($shift->save()){
            $shift->refresh();
            return $shift;
        } else {
        	$list = '';
            foreach ($shift->errors as $error) { $list .= $error[0]; }
            throw new \yii\web\HttpException(422, 'Data validation failed. ' .$list);
        }
        
	}
	
	/**
	 * Updates and existing shift
     * 
     * This function handles a few possibilities: 
     * As a manager, I want to be able to change a shift, by updating the time details.
	 * As a manager, I want to be able to assign a shift, by changing the employee that will work a shift.
	 *     @example PUT http://api.domain.com/shifts/update/155 --data '{"start_time":"2015-08-01 01:00:00"}'
	 *     NOTE: When testing with Postman, I have to use x-www-form-urlencode to submit body data
     * 
     * @param integer $id The id of the shift to update
     * 
     * @return array On success the updated shift is returned
     * 
	 */
	public function actionUpdate($id)
	{
		$shift = WiwShift::findOne($id);
		$shift->attributes =  \Yii::$app->request->getBodyParams();
		
		if($shift->save()){
			$shift->refresh();
            return $shift;
        } else {
        	$list = '';
            foreach ($shift->errors as $error) { $list .= $error[0]; }
            throw new \yii\web\HttpException(422, 'Data validation failed. ' .$list);
        }
	}
	
    
}


?>
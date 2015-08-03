<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "wiw_shift".
 *
 * @property integer $id
 * @property integer $manager_id
 * @property integer $employee_id
 * @property double $break
 * @property string $start_time
 * @property string $end_time
 * @property string $created_at
 * @property string $updated_at
 */
class WiwShift extends \yii\db\ActiveRecord
{
    public $with;
    public $week_number;
    public $year;
    public $hours_worked;
    
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wiw_shift';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manager_id', 'employee_id'], 'integer'],
            [['break'], 'number'],
            [['start_time', 'end_time', 'created_at', 'updated_at', 'with'], 'safe'],
            // TODO: need to add validation to ensure start/end times dont get backwards
            // TODO: need to validate user roles when creating/updating
            
            [['manager_id', 'employee_id','start_time', 'end_time'], 'required', 'on' => self::SCENARIO_CREATE],
            [['start_time', 'end_time'], 'date', 'format'=>'php:Y-m-d H:i:s',  'on' => self::SCENARIO_CREATE],
            ['manager_id', 'validateManager',  'on' => self::SCENARIO_CREATE],
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['manager_id', 'employee_id','start_time', 'end_time'];
        return $scenarios;
    }
    
    public function behaviors()
    {
        return [
	        [
	            'class' => TimestampBehavior::className(),
	            'createdAtAttribute' => 'created_at',
	            'updatedAtAttribute' => 'updated_at',
	            'value' => new \yii\db\Expression('NOW()'),
	        ],
   		];
    }

	public function validateManager($attribute)
	{
		if($this->manager->role != 'manager')
			 $this->addError($attribute, 'Only managers can create shifts.'); 
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manager_id' => 'Manager ID',
            'employee_id' => 'Employee ID',
            'break' => 'Break',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getEmployee()
    {
        return $this->hasOne(WiwUser::className(), ['id' => 'employee_id']);
    }
    
    public function getManager()
    {
        return $this->hasOne(WiwUser::className(), ['id' => 'manager_id']);
    }
    
    public function workingWith()
    {
           
        // we have a shift object in $this
        // find any shift that overlaps && employee_id != $this->employee_id
        $start = date("Y-m-d 00:00:00",strtotime($this->start_time));
        $end = date("Y-m-d 23:59:59",strtotime($this->start_time));
        $list = [];
        
         $shifts = WiwShift::find()
            ->where(['<>','employee_id',$this->employee_id])
            ->andWhere(['between', 'start_time', $start, $end])
            ->andWhere(['>=', 'end_time', $this->start_time])
            ->andWhere(['<=', 'start_time', $this->end_time])
            ->all();
        
        // we could return the entire employee object but for now lets just supply the name
        foreach ($shifts as $key => $shift) {
            $list[] = $shift->employee->name; 
        }
    
        $this->with = $list;
          
        
    }
    
    public static function generateRandomShifts()
    {
        for ($i=1; $i <= 31; $i++) {
            
            // gets 5 random employees
            $emps = range(1,10);
            shuffle($emps);
            $emp = array_splice($emps,0,5);
            
            $mgr = rand(11,15);
            $month  = 8;
            $day    = $i;
            $year   = 2015;
            
            
            foreach ($emps as $key => $emp) {
                $start  = rand(0,23);
                $shiftLen = rand(2,6);
                
                if($start + $shiftLen > 23){
                    $end = $start;
                    $start = $end - $shiftLen;
                } else {
                    $end = $start + $shiftLen;
                }
                
                // save to shifts
                $x = new WiwShift();
                $x->attributes = [
                    'manager_id'    => $mgr,
                    'employee_id'   => $emp,
                    'start_time'    => "{$year}-{$month}-{$day} {$start}:00:00",
                    'end_time'      => "{$year}-{$month}-{$day} {$end}:00:00",
                    'created_at'    => date("Y-m-d H:i:s")
                ];
                $x->save();
                
            }
            
            
        }
    }
}

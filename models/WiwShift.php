<?php

namespace app\models;

use Yii;

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
            [['start_time', 'end_time', 'created_at', 'updated_at'], 'safe']
        ];
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
    
    public function workingWith()
    {
        // we have a shift object in $this
        // find any shift that overlaps && employee_id != $this->employee_id
        
        /**
         * {
  "shifts": [
    {
      "id": 3,
      "start_time": "Mon, 03 Aug 2015 02:00:00 -0400",
      "end_time": "Mon, 03 Aug 2015 23:00:00 -0400"
    },
         */
        
        
        
        
    }
}

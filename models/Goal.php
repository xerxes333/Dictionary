<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "goal".
 *
 * @property integer $id
 * @property string $title
 * @property integer $userId
 * @property integer $parentId
 * @property integer $deadline
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $completedAt
 */
class Goal extends ActiveRecord
{
    
    public $completed;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'userId'], 'required'],
            [['userId', 'parentId'], 'integer'],
            [['createdAt', 'updatedAt', 'completedAt', 'deadline', 'completed'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'userId' => 'User ID',
            'parentId' => 'Parent ID',
            'deadline' => 'Deadline',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'completedAt' => 'Completed At',
        ];
    }
    
    /**
     * Returns all associated milestones (sub-goals)
     * 
     * @return mixed
     */
    public function getMilestones()
    {
        return self::find()->where(['parentId'=>$this->id])->all();
    }
    
    /**
     * Relation that for associated log entries
     * 
     * @return mixed
     */
    public function getGlogs()
    {
        return $this->hasMany(Glog::className(), ['goalId' => 'id']);
    }
    
    /**
     * Returns goal percentage completed
     * 
     * This method scalculate the goals percentage completed 
     * 
     * @return int
     */
    public function getPercentCompleted()
    {
        return rand(0, 100); // placeholder code
    }
}

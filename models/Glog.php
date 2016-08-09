<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "glog".
 *
 * @property integer $id
 * @property integer $goalId
 * @property string $info
 * @property integer $progress
 * @property string $createdAt
 */
class Glog extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'glog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goalId', 'info'], 'required'],
            [['goalId', 'progress'], 'integer'],
            [['createdAt'], 'safe'],
            [['info'], 'string', 'max' => 255],
        ];
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt'],
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
            'goalId' => 'Goal ID',
            'info' => 'Info',
            'progress' => 'Progress',
            'createdAt' => 'Created At',
        ];
    }
    
}

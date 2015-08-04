<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wiw_api_call".
 *
 * @property integer $id
 * @property string $text
 * @property string $action
 * @property string $method
 * @property string $url
 * @property string $data
 */
class WiwApiCall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wiw_api_call';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'data'], 'string', 'max' => 255],
            [['action', 'method', 'url'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'action' => 'Action',
            'method' => 'Method',
            'url' => 'Url',
            'data' => 'Data',
        ];
    }
}

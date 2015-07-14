<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sequence".
 *
 * @property integer $id
 * @property string $letters
 * @property integer $count
 * @property string $word
 */
class Sequence extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sequence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['letters'], 'required'],
            [['count'], 'integer'],
            [['letters', 'word'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'letters' => 'Letters',
            'count' => 'Count',
            'word' => 'Word',
        ];
    }
}

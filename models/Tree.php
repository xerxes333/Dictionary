<?php

namespace app\models;

use Yii;

class Tree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }
    
}

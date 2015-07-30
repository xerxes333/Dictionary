<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wiw_user".
 *
 * @property integer $id
 * @property string $name
 * @property string $role
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 */
class WiwUser extends \yii\db\ActiveRecord
{
	const MANAGER_ROLE = 'manager';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wiw_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'role', 'email', 'phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'role' => 'Role',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getShifts()
    {
        return $this->hasMany(WiwShift::className(), ['employee_id' => 'id']);
    }
	
	public function isManager(){
		return $this->role == self::MANAGER_ROLE ? TRUE : FALSE;
	}
}

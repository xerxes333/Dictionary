<?php

use yii\db\Schema;
use yii\db\Migration;

class m150723_185601_create_wiw_tables extends Migration
{
    public function up()
    {
      
      $this->createTable('wiw_user', [
            'id'        => Schema::TYPE_PK,
            'name'      => Schema::TYPE_STRING,
            'role'      => Schema::TYPE_STRING,
            'email'     => Schema::TYPE_STRING,
            'phone'     => Schema::TYPE_STRING,
            'created_at'=> Schema::TYPE_DATETIME,
            'updated_at'=> Schema::TYPE_DATETIME,
        ]);
        
        $this->createTable('wiw_shift', [
            'id'            => Schema::TYPE_PK,
            'manager_id'    => Schema::TYPE_INTEGER,
            'employee_id'   => Schema::TYPE_INTEGER,
            'break'         => Schema::TYPE_FLOAT,
            'start_time'    => Schema::TYPE_DATETIME,
            'end_time'      => Schema::TYPE_DATETIME,
            'created_at'    => Schema::TYPE_DATETIME,
            'updated_at'    => Schema::TYPE_DATETIME,
        ]);
      
      
    }

    public function down()
    {
        $this->dropTable('wiw_user');
        $this->dropTable('wiw_shift');
        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}

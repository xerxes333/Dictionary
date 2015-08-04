<?php

use yii\db\Schema;
use yii\db\Migration;

class m150804_135554_api_calls_table extends Migration
{
    public function up()
    {
        $this->createTable('wiw_api_call', [
            'id'    => Schema::TYPE_PK,
            'text'  => Schema::TYPE_TEXT,
            'action'=> Schema::TYPE_TEXT,
            'method'=> Schema::TYPE_TEXT,
            'url'   => Schema::TYPE_TEXT,
            'data'  => Schema::TYPE_TEXT,
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As an employee, I want to know when I am working, by being able to see all of the shifts assigned to me.",
            'action'=> "emp_shifts",
            'method'=> "GET",
            'url'   => "http://dictionary.dev/shifts?user_id=3",
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As an employee, I want to know who I am working with, by being able see the employees that are working during the same time period as me.",
            'action'=> "emp_with",
            'method'=> "GET",
            'url'   => "http://dictionary.dev/shifts/with?user_id=3",
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As an employee, I want to know how much I worked, by being able to get a summary of hours worked for each week.",
            'action'=> "emp_summary",
            'method'=> "GET",
            'url'   => "http://dictionary.dev/shifts/weeklysummary?user_id=3",
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As an employee, I want to be able to contact my managers, by seeing manager contact information for my shifts.",
            'action'=> "emp_shifts",
            'method'=> "GET",
            'url'   => "http://dictionary.dev/shifts?user_id=3",
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As a manager, I want to schedule my employees, by creating shifts for any employee.",
            'action'=> "mgr_create",
            'method'=> "POST",
            'url'   => "http://dictionary.dev/shifts/create",
            'data'   => '{"manager_id":12, "employee_id":3, "start_time":"2015-08-01 01:00:00", "end_time":"2015-08-01 06:00:00"}',
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As a manager, I want to see the schedule, by listing shifts within a specific time period.",
            'action'=> "mgr_shifts",
            'method'=> "GET",
            'url'   => "http://dictionary.dev/shifts?user_id=11&start_time=2015-08-02 00:00:00&end_time=2015-08-03 23:59:59",
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As a manager, I want to be able to change a shift, by updating the time details.",
            'action'=> "mgr_update",
            'method'=> "PUT",
            'url'   => "http://dictionary.dev/shifts/update/155",
            'data'  => '{"start_time":"2015-08-31 01:00:00"}',
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As a manager, I want to be able to assign a shift, by changing the employee that will work a shift.",
            'action'=> "mgr_assign",
            'method'=> "PUT",
            'url'   => "http://dictionary.dev/shifts/update/155",
            'data'   => '{"employee_id":"2"}',
        ]);
        
        $this->insert('wiw_api_call', [
            'text'  => "As a manager, I want to contact an employee, by seeing employee details.",
            'action'=> "mgr_contact",
            'method'=> "GET",
            'url'   => "http://dictionary.dev/users/4",
        ]);
        
        
        
    }

    public function down()
    {
        $this->dropTable('wiw_api_call');
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

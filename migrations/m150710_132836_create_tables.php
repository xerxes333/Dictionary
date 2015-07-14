<?php

use yii\db\Schema;
use yii\db\Migration;

class m150710_132836_create_tables extends Migration
{
    public function up()
    {
         $this->createTable('dictionary', [
            'id'    => Schema::TYPE_PK,
            'word'  => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        
        $this->createTable('sequence', [
            'id'        => Schema::TYPE_PK,
            'letters'   => Schema::TYPE_STRING . ' NOT NULL',
            'count'     => Schema::TYPE_INTEGER,
            'word'      => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('dictionary');
        $this->dropTable('sequence');
    }
    
}

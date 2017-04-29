<?php

namespace plathir\settings\migrations;


use yii\db\Migration;

class WidgetsModuleMigration extends Migration {

    public function up() {

        $this->CreateModuleTables();

    }
    
    public function down() {
        $this->dropIfExist('settings');
    }


    public function CreateModuleTables() {

        $this->dropIfExist('settings');
        
        // Settings
        $this->createTable('settings', [
            'id' => $this->primaryKey(),
            'module_name' => $this->string(255)->notNull(),
            'key_name' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'value' => $this->text(),
            'type' => $this->string(255)->notNull(),
            'active' => $this->integer(4)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ]);
      
    }

    public function dropIfExist($tableName) {
        if (in_array($tableName, $this->getDb()->schema->tableNames)) {
            $this->dropTable($tableName);
        }
    }

}

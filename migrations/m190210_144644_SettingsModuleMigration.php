<?php

use yii\db\Migration;

/**
 * Class m190210_144644_Set
 */
class m190210_144644_SettingsModuleMigration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190210_144644_Set cannot be reverted.\n";

        return false;
    }

    public function up() {

        $this->CreateModuleTables();

    }
    
    public function down() {
        $this->dropIfExist('settings');
    }


    public function CreateModuleTables() {

        $this->dropIfExist('settings');
        
        // Settings
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'module_name' => $this->string(255)->notNull(),
            'key_name' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'value' => $this->text(),
            'type' => $this->string(255)->notNull(),
            'active' => $this->integer(4)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
      
    }

    public function dropIfExist($tableName) {
        if (in_array($this->db->tablePrefix .$tableName, $this->getDb()->schema->tableNames)) {
            $this->dropTable($this->db->tablePrefix .$tableName);
        }
    }

}

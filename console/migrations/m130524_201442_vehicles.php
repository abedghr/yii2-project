<?php

use yii\db\Migration;

class m130524_201442_vehicles extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%vehicles}}', [
            'id' => $this->primaryKey(),
            'v_name' => $this->string()->notNull(),
            'v_make_id' => $this->integer()->notNull(),
            'v_model_id' => $this->integer()->notNull(),
            'manufacturing_year' => $this->string()->notNull(),
            'main_image' => $this->text()->notNull(),
            'price' => $this->double(100,2)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string(255)->notNull()->defaultValue('new'),
            'status' => $this->string(255)->notNull()->defaultValue('pending'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-viechles-make_id',
            'vehicles',
            'v_make_id',
            'make',
            'id',
            'CASCADE',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-viechles-model_id',
            'vehicles',
            'v_model_id',
            'models',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-users-id',
            'vehicles',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    

    public function down()
    {
        $this->dropForeignKey('fk-viechles-model_id','vehicles');
        $this->dropForeignKey('fk-users-id', 'vehicles');
        $this->dropTable('{{%vehicles}}');
    }
}

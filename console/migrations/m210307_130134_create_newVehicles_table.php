<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%newVehicales}}`.
 */
class m210307_130134_create_newVehicles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%newVehicles}}', [
            'id' => $this->primaryKey(),
            'v_id'=> $this->integer()->notNull(),
            'v_engine'=> $this->string(255)->notNull(),
            'video_url'=> $this->string(500)->notNull(),
            'v_year' => $this->string(10)
        ]);
        
        $this->addForeignKey(
            'fk-vNew-vehicles_id',
            'newVehicles',
            'v_id',
            'vehicles',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%newVehicles}}');
    }
}

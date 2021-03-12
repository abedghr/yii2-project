<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%usedVehicles}}`.
 */
class m210307_130543_create_usedVehicles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%usedVehicles}}', [
            'id' => $this->primaryKey(),
            'v_id'=> $this->integer()->notNull(),
            'v_city'=> $this->integer()->notNull(),
            'v_mileage'=> $this->integer()->notNull(),
            'v_year'=> $this->string(10)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-vUsed-vehicles_id',
            'usedVehicles',
            'v_id',
            'vehicles',
            'id',
            'CASCADE',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-vUsed-city_id',
            'usedVehicles',
            'v_city',
            'city',
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
        $this->dropTable('{{%usedVehicles}}');
    }
}

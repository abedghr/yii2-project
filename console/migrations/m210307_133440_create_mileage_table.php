<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mileage}}`.
 */
class m210307_133440_create_mileage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mileage}}', [
            'id' => $this->primaryKey(),
            'v_mileage'=>$this->string(255)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mileage}}');
    }
}

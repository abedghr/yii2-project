<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%make}}`.
 */
class m210307_131907_create_make_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%make}}', [
            'id' => $this->primaryKey(),
            'm_name'=> $this->string(255)->unique()->notNull(),
            'make_logo'=> $this->string(500)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%make}}');
    }
}

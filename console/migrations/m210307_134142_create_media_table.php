<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%media}}`.
 */
class m210307_134142_create_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%media}}', [
            'id' => $this->primaryKey(),
            'v_id'=> $this->integer(),
            'v_media'=> $this->string(500)
        ]);

        $this->addForeignKey(
            'fk-vMedia-vehicles_id',
            'media',
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
        $this->dropTable('{{%media}}');
    }
}

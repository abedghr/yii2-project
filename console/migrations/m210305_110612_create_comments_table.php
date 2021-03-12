<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m210305_110612_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'comment'=>$this->text(),
            'user_id'=>$this->integer()->notNull(),
            'vehicle_id'=>$this->integer()->notNull()
        ]);
        
        $this->addForeignKey(
            'fk-comment-vehicle_id',
            'comments',
            'vehicle_id',
            'vehicles',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comment-user_id',
            'comments',
            'user_id',
            'user',
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
        $this->dropTable('{{%comments}}');
    }
}

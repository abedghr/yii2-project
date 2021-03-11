<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%models}}`.
 */
class m210305_093248_create_models_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%models}}', [
            'id' => $this->primaryKey(),
            'make_v_id'=> $this->integer(),
            'model_name'=>$this->string()->notNull(),
            'model_description'=> $this->string(500),
            'model_logo'=>$this->string(500)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-make-vehicles_id',
            'models',
            'make_v_id',
            'make',
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
        $this->dropTable('{{%models}}');
    }
}

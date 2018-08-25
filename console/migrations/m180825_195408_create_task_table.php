<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m180825_195408_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'estimation' => $this->integer()->notNull(),
            'executor_id' => $this->integer(),
            'started_at' => $this->integer(),
            'completed_at' => $this->integer(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_task_user_executor',
            'task',
            'executor_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk_task_user_created',
            'task',
            'created_by',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk_task_user_updated',
            'task',
            'updated_by',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_user_updated','task');
        $this->dropForeignKey('fk_task_user_created','task');
        $this->dropForeignKey('fk_task_user_executor','task');
        $this->dropTable('task');
    }
}

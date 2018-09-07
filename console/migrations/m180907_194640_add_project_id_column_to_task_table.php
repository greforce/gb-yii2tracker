<?php

use yii\db\Migration;

/**
 * Handles adding project_id to table `task`.
 */
class m180907_194640_add_project_id_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'project_id', $this->integer()->notNull()->after('estimation'));

        $this->addForeignKey(
            'fk_task_project',
            'task',
            'project_id',
            'project',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_project','task');
        $this->dropColumn('task', 'project_id');
    }
}

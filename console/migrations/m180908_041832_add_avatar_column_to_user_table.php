<?php

use yii\db\Migration;

/**
 * Handles adding avatar to table `user`.
 */
class m180908_041832_add_avatar_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'avatar', $this->string()->after('status'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'avatar');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles adding creation_time to table `post`.
 */
class m180514_165134_add_creation_time_column_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'creation_time', $this->integer(11));
        $this->addColumn('post', 'update_time', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'creation_time');
        $this->dropColumn('post', 'update_time');
    }
}

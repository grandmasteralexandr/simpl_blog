<?php

use yii\db\Migration;

/**
 * Handles adding status to table `post`.
 */
class m180513_152150_add_status_column_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'ALTER TABLE `post` ADD COLUMN `status` ENUM(\'Draft\',\'Active\',\'Archive\') NOT NULL DEFAULT \'Draft\' AFTER `rubric_id`;';
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'status');
    }
}

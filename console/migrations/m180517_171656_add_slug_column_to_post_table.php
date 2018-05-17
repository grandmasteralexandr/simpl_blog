<?php

use yii\db\Migration;

/**
 * Handles adding slug to table `post`.
 */
class m180517_171656_add_slug_column_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'ALTER TABLE `post`
	ADD COLUMN `slug` VARCHAR(255) NOT NULL AFTER `id`,
	ADD UNIQUE INDEX `slug` (`slug`)';
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'slug');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles adding uri to table `rubric`.
 */
class m180516_180935_add_uri_column_to_rubric_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'ALTER TABLE `rubric`
	ADD COLUMN `slug` VARCHAR(255) NOT NULL AFTER `id`,
	ADD UNIQUE INDEX `slug` (`slug`)';
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('rubric', 'slug');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 * Has foreign keys to the tables:
 *
 * - `rubric`
 */
class m180513_064937_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'rubric_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `rubric_id`
        $this->createIndex(
            'idx-post-rubric_id',
            'post',
            'rubric_id'
        );

        // add foreign key for table `rubric`
        $this->addForeignKey(
            'fk-post-rubric_id',
            'post',
            'rubric_id',
            'rubric',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `rubric`
        $this->dropForeignKey(
            'fk-post-rubric_id',
            'post'
        );

        // drops index for column `rubric_id`
        $this->dropIndex(
            'idx-post-rubric_id',
            'post'
        );

        $this->dropTable('post');
    }
}

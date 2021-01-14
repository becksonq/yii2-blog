<?php

use becksonq\blog\migrations\Migration;

/**
 * Class m191220_202225_add_blog_post_comments_count_field
 */
class m191220_202225_add_blog_post_comments_count_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_posts}}', 'comments_count', $this->integer()->notNull());

        $this->update('{{%blog_posts}}', ['comments_count' => 0]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%blog_posts}}', 'comments_count');
    }
}

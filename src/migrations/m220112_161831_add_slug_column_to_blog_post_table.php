<?php

use becksonq\blog\migrations\Migration;

/**
 * Handles adding columns to table `{{%blog_post}}`.
 */
class m220112_161831_add_slug_column_to_blog_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog_posts}}', 'slug', $this->string()->notNull()->after('title'));
        $this->createIndex('ids-slug-blog_posts', '{{%blog_posts}}', 'slug');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ids-slug-blog_posts', '{{%blog_posts}}');
        $this->dropColumn('{{%blog_posts}}', 'slug');
    }
}

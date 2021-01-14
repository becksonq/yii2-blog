<?php

use becksonq\blog\migrations\Migration;

class m170531_084120_create_blog_tag_assignments_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%blog_tag_assignments}}', [
            'post_id' => $this->integer()->notNull(),
            'tag_id'  => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk-blog_tag_assignments}}', '{{%blog_tag_assignments}}', ['post_id', 'tag_id']);

        $this->createIndex('{{%idx-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}', 'post_id');
        $this->createIndex('{{%idx-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}', 'tag_id');

        $this->addForeignKey('{{%fk-blog_tag_assignments-post_id}}', '{{%blog_tag_assignments}}', 'post_id',
            '{{%blog_posts}}', 'id', $this->cascade, $this->restrict);
        $this->addForeignKey('{{%fk-blog_tag_assignments-tag_id}}', '{{%blog_tag_assignments}}', 'tag_id',
            '{{%blog_tags}}', 'id', $this->cascade, $this->restrict);
    }

    public function down()
    {
        $this->dropTable('{{%blog_tag_assignments}}');
    }
}

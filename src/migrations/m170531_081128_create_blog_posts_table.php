<?php

use becksonq\blog\migrations\Migration;

class m170531_081128_create_blog_posts_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%blog_posts}}', [
            'id'          => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'created_at'  => $this->integer()->unsigned()->notNull(),
            'title'       => $this->string()->notNull(),
            'description' => $this->text(),
            'content'     => 'MEDIUMTEXT',
            'image'       => $this->string(),
            'status'      => $this->integer()->notNull(),
            'meta_json'   => 'JSON NOT NULL',
        ]);

        $this->createIndex('{{%idx-blog_posts-category_id}}', '{{%blog_posts}}', 'category_id');

        $this->addForeignKey('{{%fk-blog_posts-category_id}}', '{{%blog_posts}}', 'category_id', '{{%blog_categories}}',
            'id');
    }

    public function down()
    {
        $this->dropTable('{{%blog_posts}}');
    }
}

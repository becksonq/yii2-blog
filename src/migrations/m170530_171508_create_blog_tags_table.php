<?php

use becksonq\blog\migrations\Migration;

class m170530_171508_create_blog_tags_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%blog_tags}}', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
        ]);

        $this->createIndex('{{%idx-blog_tags-slug}}', '{{%blog_tags}}', 'slug', true);
    }

    public function down()
    {
        $this->dropTable('{{%blog_tags}}');
    }
}

<?php

use becksonq\blog\migrations\Migration;

class m170530_172725_create_blog_categories_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%blog_categories}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string()->notNull(),
            'slug'        => $this->string()->notNull(),
            'title'       => $this->string(),
            'description' => $this->text(),
            'sort'        => $this->integer()->notNull(),
            'meta_json'   => 'JSON NOT NULL',
        ]);

        $this->createIndex('{{%idx-blog_categories-slug}}', '{{%blog_categories}}', 'slug', true);
    }

    public function down()
    {
        $this->dropTable('{{%blog_categories}}');
    }
}

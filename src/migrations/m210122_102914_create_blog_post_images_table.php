<?php

use becksonq\blog\migrations\Migration;

/**
 * Handles the creation of table `{{%blog_post_images}}`.
 */
class m210122_102914_create_blog_post_images_table extends Migration
{
    protected $table = '{{%blog_post_images}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id'      => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'file'    => $this->string()->notNull(),
            'sort'    => $this->integer()->notNull(),
        ]);

        $this->createIndex('{{%idx-post_images-post_id}}', $this->table, 'post_id');

        $this->addForeignKey('{{%fk-post_images-post_id}}', $this->table, 'post_id', '{{%blog_posts}}',
            'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}

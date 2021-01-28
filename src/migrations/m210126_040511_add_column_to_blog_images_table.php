<?php

use becksonq\blog\migrations\Migration;

/**
 * Handles adding columns to table `{{%blog_images}}`.
 */
class m210126_040511_add_column_to_blog_images_table extends Migration
{
    protected $table = '{{%blog_post_images}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'type', $this->integer(1)->after('file')->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'type');
    }
}

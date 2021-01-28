<?php

use becksonq\blog\migrations\Migration;

/**
 * Class m210124_162940_add_column_to_post_categories
 */
class m210124_162940_add_column_to_post_categories extends Migration
{
    protected $table = '{{%blog_categories}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'count',
            $this->integer(5)->defaultValue(0)->comment('Количество постов в категории'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'count');
    }
}

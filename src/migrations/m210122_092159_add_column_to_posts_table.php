<?php

use becksonq\blog\migrations\Migration;

/**
 * Handles adding columns to table `{{%posts}}`.
 */
class m210122_092159_add_column_to_posts_table extends Migration
{
    protected $table = '{{%blog_posts}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'user_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'user_id');
    }
}

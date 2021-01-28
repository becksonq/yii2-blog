<?php

use becksonq\blog\migrations\Migration;

/**
 * Handles adding columns to table `{{%post}}`.
 */
class m210123_165142_add_column_to_post_table extends Migration
{
    protected $table = '{{%blog_posts}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'caption', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'caption');
    }
}

<?php

use becksonq\blog\migrations\Migration;

/**
 * Handles the creation of table `{{%sidebar_banners}}`.
 */
class m201114_131417_create_blog_sidebar_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_sidebar_banner}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string(),
            'script'     => $this->text()->notNull()->comment('Banner script from admitad.ru'),
            'status'     => $this->boolean()->defaultValue(1)->comment('Banners\'s status'),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blog_sidebar_banner}}');
    }
}

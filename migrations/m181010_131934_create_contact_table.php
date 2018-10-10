<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact`.
 */
class m181010_131934_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'phone_number' => $this->string(),
            'address' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('contact');
    }
}

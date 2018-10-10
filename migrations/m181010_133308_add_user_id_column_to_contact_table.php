<?php

use yii\db\Migration;

/**
 * Handles adding user_id to table `contact`.
 */
class m181010_133308_add_user_id_column_to_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('contact', 'user_id', $this->integer());

        $this->createIndex(
            'idx-contact-user_id',
            'contact',
            'user_id'
        );

        $this->addForeignKey(
            'fk-contact-user_id',
            'contact',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-contact-user_id',
            'contact'
        );

        $this->dropIndex(
            'idx-contact-user_id',
            'contact'
        );
        $this->dropColumn('contact', 'user_id');
    }
}

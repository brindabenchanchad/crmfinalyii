<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m220128_093217_create_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person}}', [
            'person_id' => $this->primaryKey(),
            'firstname' => $this->string()->notNull(),
            'middlename' => $this->string(),
            'lastname' => $this->string()->notNull(),
            'contact_no' => $this->integer()->notNull(),
            'email_id' => $this->string()->notNull()->unique(),
            'address_id' => $this->integer(),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-person-address_id',
            'person',
            'address_id',
            'address',
            'address_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person}}');

        $this->dropForeignKey(
            'fk-person-address_id',
            'person'
        );
    }
}

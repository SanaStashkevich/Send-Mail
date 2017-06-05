<?php

use yii\db\Migration;

class m170603_205835_images extends Migration
{
    public function up()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'id_contact' => $this->integer()->notNull(),
            'path' => $this->string(255)->notNull()
        ]);

        $this->addForeignKey('fk-image-id_contact', 'images', 'id_contact', 'contacts', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-image-id_contact',
            'images'
        );
        $this->dropTable('images');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

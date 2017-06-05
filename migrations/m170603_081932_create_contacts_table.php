<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contacts`.
 */
class m170603_081932_create_contacts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('contacts', [
            'id' => $this->primaryKey(),
            'name' => $this->string(160)->notNull(),
            'age'  => $this->integer(3)->notNull(),
            'height' => $this->integer(3)->notNull(),
            'weight' => $this->integer(3)->notNull(),
            'email' => $this->string(160)->notNull(),
            'city' => $this->string(160)->notNull(),
            'equip_rent' => $this->integer(1)->defaultValue(0),
            'level_lang' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contacts');
    }
}

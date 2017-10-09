<?php

use enpii\enpiiCms\libs\override\db\NpMigration as Migration;

/**
 * Class m171009_151508_add_user_profile
 */
class m171009_151508_add_user_profile extends Migration
{
    public $tableNameUserProfile = 'user_profile';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = $this->getTableOptions();

        // Site
        $this->createTable('{{%' . $this->tableNameUserProfile . '}}', [
            'id' => $this->bigPrimaryKey(),
            'email' => $this->string(255)->notNull()->comment('Primary email of the user. Use to recover password, receive notifications.'),
            'first_name' => $this->string(255)->notNull()->comment('First Name.'),
            'middle_name' => $this->string(255)->notNull()->comment('Middle Name.'),
            'last_name' => $this->string(255)->notNull()->comment('Short alias to represent a user.'),
            'phone_number' => $this->string(16)->notNull()->comment('Primary phone number of user. Can be used to recover account, receive notifications or confirm some action.'),
            'birth_date_time' => $this->dateTime()->comment('Date time of birth.'),

        ], $tableOptions);

        $this->addItemCommonFields($this->tableNameUser);

        $this->createIndex($this->tableNameUser . '_' . 'email' . '_idx', '{{%' . $this->tableNameUser . '}}', 'email');
        $this->createIndex($this->tableNameUser . '_' . 'phone_number' . '_idx', '{{%' . $this->tableNameUser . '}}', 'phone_number');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171009_151508_add_user_profile reverting.\n";

        return $this->dropTable('{{%' . $this->tableNameUser . '}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171009_151508_add_user_profile cannot be reverted.\n";

        return false;
    }
    */
}

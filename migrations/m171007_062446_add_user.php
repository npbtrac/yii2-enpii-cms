<?php

use enpii\enpiiCms\libs\override\db\NpMigration as Migration;

/**
 * Class m171007_062446_add_user
 */
class m171007_062446_add_user extends Migration
{
    public $tableNameUser = 'user';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = $this->getTableOptions();

        // Site
        $this->createTable('{{%' . $this->tableNameUser . '}}', [
            'id' => $this->bigPrimaryKey(),
            'email' => $this->string(255)->notNull()->comment('Primary email of the user. Use to recover password, receive notifications.'),
            'username' => $this->string(32)->notNull()->comment('Short alias to represent a user.'),
            'hashed_password' => $this->string()->notNull()->comment('Hashed password of a user.'),
            'first_name' => $this->string(255)->notNull()->comment('First Name.'),
            'middle_name' => $this->string(255)->comment('Middle Name.'),
            'last_name' => $this->string(255)->notNull()->comment('Family Name of user.'),
            'phone_number' => $this->string(16)->notNull()->comment('Primary phone number of user. Can be used to recover account, receive notifications or confirm some action.'),
            'last_logged_in_date_gmt' => $this->dateTime()->comment('Date when user logged in the last time in GMT.'),
        ], $tableOptions);

        $this->addItemCommonFields($this->tableNameUser);

        $this->createIndex($this->tableNameUser . '_' . 'email' . '_idx', '{{%' . $this->tableNameUser . '}}', 'email');
        $this->createIndex($this->tableNameUser . '_' . 'username' . '_idx', '{{%' . $this->tableNameUser . '}}', 'username');
        $this->createIndex($this->tableNameUser . '_' . 'phone_number' . '_idx', '{{%' . $this->tableNameUser . '}}', 'phone_number');

        $this->insert('{{%' . $this->tableNameUser . '}}', [
            'email' => 'npbtrac@yahoo.com',
            'username' => 'appadmin',
            'hashed_password' => Yii::$app->security->generatePasswordHash('Admin@123'),
            'first_name' => 'Admin',
            'middle_name' => 'Super',
            'last_name' => 'App',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171007_062446_add_user reverting.\n";

        $this->dropTable('{{%' . $this->tableNameUser . '}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171007_062446_add_user cannot be reverted.\n";

        return false;
    }
    */
}

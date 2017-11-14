<?php

use enpii\enpiiCms\libs\override\db\NpMigration as Migration;

/**
 * Class m171026_092240_add_user_group
 */
class m171026_092240_add_user_group extends Migration {
	public $tableNameUser = 'user';
	public $tableNameUserProfile = 'user_profile';
	public $tableNameUserGroup = 'user_group';
	public $tableNameUserUserGroupRelation = 'user_user_group_relation';

	/**
	 * @inheritdoc
	 */
	public function safeUp() {
		$tableOptions = $this->getTableOptions();

		// User Group
		$this->createTable( '{{%' . $this->tableNameUserGroup . '}}', [
			'id'                => $this->bigPrimaryKey(),
			'name'              => $this->string( 255 )->notNull()->comment( 'Name of the group.' ),
			'permission_weight' => $this->bigInteger()->notNull()->defaultValue( 1 )->comment( 'Number to present power of the group, negative number for backend and positive number for frontend. Higher value means more power. Administrator value is -1 and Standard Member is 1.' ),
		], $tableOptions );
		$this->addCode( $this->tableNameUserGroup );
		$this->addItemCommonFields( $this->tableNameUserGroup );

		// User - User Group Relation
		$this->createTable( '{{%' . $this->tableNameUserUserGroupRelation . '}}', [
			'id'            => $this->bigPrimaryKey(),
			'user_id'       => $this->bigInteger()->notNull()->comment( 'ID of the user.' ),
			'user_group_id' => $this->bigInteger()->notNull()->comment( 'ID of the user group.' ),
		], $tableOptions );

		$this->addForeignKey( $this->tableNameUserUserGroupRelation . '_' . 'user_id' . '_fk', '{{%' . $this->tableNameUserUserGroupRelation . '}}', 'user_id', '{{%' . $this->tableNameUser . '}}', 'id' );
		$this->addForeignKey( $this->tableNameUserUserGroupRelation . '_' . 'user_group_id' . '_fk', '{{%' . $this->tableNameUserUserGroupRelation . '}}', 'user_group_id', '{{%' . $this->tableNameUserGroup . '}}', 'id' );
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown() {
		echo "m171026_092240_add_user_group reverting.\n";

		$this->dropTable( '{{%' . $this->tableNameUserUserGroupRelation . '}}' );
		$this->dropTable( '{{%' . $this->tableNameUserGroup . '}}' );

		return true;
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m171026_092240_add_user_group cannot be reverted.\n";

		return false;
	}
	*/
}

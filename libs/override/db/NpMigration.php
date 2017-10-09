<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/11/17 11:54 AM
 */

namespace enpii\enpiiCms\libs\override\db;


use yii\db\Migration;

/**
 * Class NpMigration
 * @package enpii\enpiiCms\libs\override\db
 */
class NpMigration extends Migration
{
    public function addItemCommonFields($tableName)
    {
        $this->addCreatedDate($tableName);
        $this->addUpdatedDate($tableName);
        $this->addPublishedDate($tableName);
        $this->addCreatorID($tableName);
        $this->addIsDeleted($tableName);
        $this->addOrderingWeight($tableName);
        $this->addStatus($tableName);
        $this->addParams($tableName);
    }

    /**
     * Add and put index to `code` column
     * Use if identity an item alternatively to ID
     * @param $tableName
     */
    public function addCode($tableName, $columnName = 'code')
    {
        $this->addColumn('{{%' . $tableName . '}}', $columnName,
            $this->string(32)->comment('Code for this item, used identifying when needed. Another criteria to replace ID because ID is auto-increment'));
        $this->createIndex($tableName . '_' . $columnName . '_idx', '{{%' . $tableName . '}}', $columnName);
    }

    /**
     * Add and put Index to created_at column
     * Store the datetime the record has been created (should be stored in GMT 0)
     * @param $tableName
     * @param string $columnName Name of the column
     */
    public function addCreatedDate($tableName, $columnName = 'created_date_gmt')
    {
        $this->addColumn('{{%' . $tableName . '}}', $columnName,
            $this->dateTime()->comment('Date and time this record created (in GMT)'));
        $this->createIndex($tableName . '_' . $columnName . '_idx', '{{%' . $tableName . '}}', $columnName);
    }

    /**
     * Add and put Index to updated_at column
     * Store the datetime the record has been updated (should be stored in GMT 0)
     * @param $tableName
     * @param string $columnName Name of the column
     */
    public function addUpdatedDate($tableName, $columnName = 'updated_date_gmt')
    {
        $this->addColumn('{{%' . $tableName . '}}', $columnName,
            $this->dateTime()->comment('Date and time this record updated (in GMT)'));
        $this->createIndex($tableName . '_' . $columnName . '_idx', '{{%' . $tableName . '}}', $columnName);
    }

    /**
     * Add and put Index to published_at column
     * Store the datetime the record has been published to public (should be stored in GMT 0, may be
     * a scheduled time in the future)
     * @param $tableName
     */
    public function addPublishedDate($tableName, $columnName = 'published_at_gmt')
    {
        $this->addColumn('{{%' . $tableName . '}}', $columnName,
            $this->dateTime()->comment('Date and time this record published (in GMT)'));
        $this->createIndex($tableName . '_' . $columnName . '_idx', '{{%' . $tableName . '}}',
            $columnName);
    }

    /**
     * Add and put Index to creator_id column
     * Store id of user who create this record
     * @param $tableName
     */
    public function addCreatorID($tableName, $columnName = 'creator_id')
    {
        $this->addColumn('{{%' . $tableName . '}}', $columnName,
            $this->bigInteger()->comment('ID of user who created this item'));
        $this->createIndex($tableName . '_' . $columnName . '_idx', '{{%' . $tableName . '}}', $columnName);
    }

    /**
     * Add and put Index to is_deleted column
     * This flag (0 or 1) for putting it to trash without completely delete it off the database
     * @param $tableName
     */
    public function addIsDeleted($tableName, $columnName = 'is_deleted')
    {
        $this->addColumn('{{%' . $tableName . '}}', $columnName,
            $this->boolean()->defaultValue(0)->comment('Mark an item is deleted (in trash) or not'));
        $this->createIndex($tableName . '_' . $columnName . '_idx', '{{%' . $tableName . '}}', $columnName);
    }

    /**
     * Add and put Index to is_enabled column
     * This flag (0 or 1) for allowing it to be displayed in the frontend or not
     * @param $tableName
     */
    public function addIsEnabled($tableName, $columnName = 'is_enabled')
    {
        $this->addColumn('{{%' . $tableName . '}}', $columnName,
            $this->boolean()->defaultValue(1)->comment('Mark an item is allowed on frontend query or not'));
        $this->createIndex($tableName . '_' . $columnName . '_idx', '{{%' . $tableName . '}}', $columnName);
    }

    /**
     * Add and put Index to ordering_weight column
     * For custom order in sorting to be displayed in the frontend
     * @param $tableName
     */
    public function addStatus($tableName, $columnName = 'status')
    {
        $this->addColumn('{{%' . $tableName . '}}', $columnName,
            $this->smallInteger()->notNull()->defaultValue(1)->comment('Status of this item, 0: draft, not publised, 1: published '));
        $this->createIndex($tableName . '_' . $columnName . '_idx', '{{%' . $tableName . '}}', $columnName);
    }

    /**
     * Add and put Index to ordering_weight column
     * For custom order in sorting to be displayed in the frontend
     * @param $tableName
     */
    public function addOrderingWeight($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'ordering_weight',
            $this->bigInteger()->defaultValue(0)->comment('An extra index for custom sorting'));
        $this->createIndex($tableName . '_ordering_weight' . '_idx', '{{%' . $tableName . '}}', 'ordering_weight');
    }

    /**
     * Add params column
     * For storing extra data such as caching info.... Should be stored using json
     * @param $tableName
     */
    public function addParams($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'params',
            $this->text()->comment('Contain custom params for this item'));
    }

    /**
     * Options for SQL tables
     * @return null|string
     */
    public function getTableOptions()
    {
        $tableOptions = null;
        if ($this->db->getDriverName() == 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        return $tableOptions;
    }
}

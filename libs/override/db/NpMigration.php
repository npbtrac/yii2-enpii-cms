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
        $this->addCreatedAt($tableName);
        $this->addUpdatedAt($tableName);
        $this->addPublishedAt($tableName);
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
    public function addCode($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'code',
            $this->string(32)->comment('Code for this item, used identifying when needed. Another criteria to replace ID because ID is auto-increment'));
        $this->createIndex($tableName . '_code' . '_idx', '{{%' . $tableName . '}}', 'code');
    }

    /**
     * Add and put Index to created_at column
     * Store the datetime the record has been created (should be stored in GMT 0)
     * @param $tableName
     */
    public function addCreatedAt($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'created_at_gmt',
            $this->dateTime()->comment('Date and time this record created (in GMT)'));
        $this->createIndex($tableName . '_' . 'created_at_gmt' . '_idx', '{{%' . $tableName . '}}', 'created_at_gmt');
    }

    /**
     * Add and put Index to updated_at column
     * Store the datetime the record has been updated (should be stored in GMT 0)
     * @param $tableName
     */
    public function addUpdatedAt($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'updated_at_gmt',
            $this->dateTime()->comment('Date and time this record updated (in GMT)'));
        $this->createIndex($tableName . '_' . 'updated_at_gmt' . '_idx', '{{%' . $tableName . '}}', 'updated_at_gmt');
    }

    /**
     * Add and put Index to published_at column
     * Store the datetime the record has been published to public (should be stored in GMT 0, may be
     * a scheduled time in the future)
     * @param $tableName
     */
    public function addPublishedAt($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'published_at_gmt',
            $this->dateTime()->comment('Date and time this record published (in GMT)'));
        $this->createIndex($tableName . '_' . 'published_at_gmt' . '_idx', '{{%' . $tableName . '}}',
            'published_at_gmt');
    }

    /**
     * Add and put Index to creator_id column
     * Store id of user who create this record
     * @param $tableName
     */
    public function addCreatorID($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'creator_id',
            $this->bigInteger()->comment('ID of user who created this item'));
        $this->createIndex($tableName . '_' . 'creator_id' . '_idx', '{{%' . $tableName . '}}', 'creator_id');
    }

    /**
     * Add and put Index to is_deleted column
     * This flag (0 or 1) for putting it to trash without completely delete it off the database
     * @param $tableName
     */
    public function addIsDeleted($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'is_deleted',
            $this->boolean()->defaultValue(0)->comment('Mark an item is deleted (in trash) or not'));
        $this->createIndex($tableName . '_is_deleted' . '_idx', '{{%' . $tableName . '}}', 'is_deleted');
    }

    /**
     * Add and put Index to is_enabled column
     * This flag (0 or 1) for allowing it to be displayed in the frontend or not
     * @param $tableName
     */
    public function addIsEnabled($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'is_enabled',
            $this->boolean()->defaultValue(1)->comment('Mark an item is allowed on frontend query or not'));
        $this->createIndex($tableName . '_is_enabled' . '_idx', '{{%' . $tableName . '}}', 'is_enabled');
    }

    /**
     * Add and put Index to ordering_weight column
     * For custom order in sorting to be displayed in the frontend
     * @param $tableName
     */
    public function addStatus($tableName)
    {
        $this->addColumn('{{%' . $tableName . '}}', 'status',
            $this->smallInteger()->notNull()->defaultValue(1)->comment('Status of this item, 0: draft, not publised, 1: published '));
        $this->createIndex($tableName . '_status' . '_idx', '{{%' . $tableName . '}}', 'status');
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

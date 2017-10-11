<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/10/17 11:13 PM
 */

namespace enpii\enpiiCms\libs\override\db;


use yii\db\ActiveQuery;
use enpii\enpiiCms\libs\override\db\NpActiveRecord as ActiveRecord;

/**
 * Class NpActiveQuery
 * @package enpii\enpiiCms\libs\override\db
 * For overriding Yii methods
 */
class NpActiveQuery extends ActiveQuery
{
    /**
     * Determine a record is active or not
     * A working record means is_deleted = 0 and is_enabled = 1
     * @return $this
     */
    public function isWorking()
    {
        return $this->andWhere(['status' > ActiveRecord::_STATUS_DISABLED]);
    }

    /**
     * @return $this
     */
    public function notDeleted()
    {
        return $this->andFilterWhere(['is_deleted' => 0]);
    }
}
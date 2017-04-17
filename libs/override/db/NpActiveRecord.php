<?php

/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 4/17/17 4:35 PM
 */
namespace enpii\enpiiCms\libs\override\db;

use yii;
use yii\db\ActiveRecord;

class NpActiveRecord extends ActiveRecord
{
    const _STATUS_DISABLED = 0;
    const _STATUS_PUBLISHED = 1;

    public $datetimeFormat = 'H:i:s d-m-Y';
    public $timezone = 'Asia/Ho_Chi_Minh';

    /**
     * Set default timezone and datetime format for model
     */
    public function init()
    {
        parent::init();

        $this->datetimeFormat = (empty(Yii::$app->params['site']->datetimeFormat)) ? $this->datetimeFormat : Yii::$app->params['site']->datetimeFormat;
        $this->timezone = (empty(Yii::$app->params['site']->timezone)) ? $this->timezone : Yii::$app->params['site']->timezone;
    }

    /**
     * Put an item to trash meaning set is_deleted = 1
     * @return bool
     */
    public function putToTrash()
    {
        $this->is_deleted = 1;
        return $this->save(true, array('is_deleted'));
    }

    public static function findByID($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Display datetime from the result retrieve from database (stored by GMT datetime
     * @param $input
     * @param null $format
     * @param null $timezone
     * @return bool|string
     */
    public function getDisplayDateTime($input, $format = null, $timezone = null)
    {
        return \enpii\enpiiCms\helpers\DateTimeHelper::fromDbFormat($input,
            ($format === null ? $this->datetimeFormat : $format),
            ($timezone === null ? $this->timezone : $timezone));
    }

    /**
     * Display create_at datetime
     * @param null $format
     * @param null $timezone
     * @return bool|string
     */
    public function getCreatedAt($format = null, $timezone = null)
    {
        return $this->getDisplayDateTime($this->created_at, $format, $timezone);
    }

    /**
     * Display updated_at datetime
     * @param null $format
     * @param null $timezone
     * @return bool|string
     */
    public function getUpdatedAt($format = null, $timezone = null)
    {
        return $this->getDisplayDateTime($this->updated_at, $format, $timezone);
    }

    /**
     * Display published_at datetime
     * @param null $format
     * @param null $timezone
     * @return bool|string
     */
    public function getPublishedAt($format = null, $timezone = null)
    {
        return $this->getDisplayDateTime($this->published_at, $format, $timezone);
    }

    /**
     * Temporary upload path
     * @return bool|string
     */
    public function getUploadTmpPath()
    {
        $path = Yii::getAlias('@root' . '/' . Yii::$app->params['uploads']['folderName'] . '/' . 'tmp');
        if (!file_exists($path)) {
            FileHelper::createDirectory($path, 0777);
        }
        return $path;
    }

    /**
     * Temporary upload url
     * @return bool|string
     */
    public function getUploadTmpUrl()
    {
        /* @var $app NpWebApplication */
        $app = Yii::$app;
        return $app->getRootUrl() . '/uploads/tmp';
    }
}
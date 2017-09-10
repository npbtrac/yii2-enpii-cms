<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/9/17 1:05 PM
 */

namespace enpii\enpiiCms\libs\override\web;


use yii\web\AssetManager;

/**
 * Class NpAssetManager
 * @package enpii\enpiiCms\libs\override\web
 * Override the AssetManager for managing css, js, images...
 * In case you want to put resources to remote host, you might have methods to copy them to CDN, another FTP or AWS
 */
class NpAssetManager extends AssetManager
{

}
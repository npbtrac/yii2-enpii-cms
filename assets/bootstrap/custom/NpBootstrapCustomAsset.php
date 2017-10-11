<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 10/11/17 1:27 PM
 */

namespace enpii\enpiiCms\assets\bootstrap\custom;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class NpBootstrapCustomAsset
 * @package enpii\enpiiCms\assets\bootstrap\custom
 */
class NpBootstrapCustomAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $js = [
        'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
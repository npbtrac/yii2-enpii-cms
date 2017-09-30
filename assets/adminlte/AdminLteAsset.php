<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/29/17 2:25 PM
 */

namespace enpii\enpiiCms\assets\adminlte;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class AdminLteAsset
 * @package enpii\enpiiCms\assets\adminlte
 * Manage css, js, fonts for AdminLte theme
 * https://github.com/almasaeed2010/AdminLTE
 */
class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@enpii/enpiiCms/assets/adminlte/dist';
    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
        'css/adminlte-custom.css',
    ];

    public $js = [
        'js/adminlte.min.js'
    ];
    public $depends = [
    ];
}

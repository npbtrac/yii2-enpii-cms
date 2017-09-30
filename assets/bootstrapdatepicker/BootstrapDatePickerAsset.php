<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:52 PM
 */

namespace enpii\enpiiCms\assets\bootstrapdatepicker;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package enpii\enpiiCms
 * Manage date picker resources using bootstrap
 */
class BootstrapDatePickerAsset extends AssetBundle
{
	public $sourcePath = '@enpii/enpiiCms/assets/bootstrapdatepicker/dist';
	public $css = [
		'css/bootstrap-datepicker.min.css'
	];
    public $js = [
	    'js/bootstrap-datepicker.min.js'
	];
	public $depends = [
	    'yii\bootstrap\BootstrapAsset'
	];
}
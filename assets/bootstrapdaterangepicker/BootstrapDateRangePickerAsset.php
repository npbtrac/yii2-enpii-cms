<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:52 PM
 */

namespace enpii\enpiiCms\assets\bootstrapdaterangepicker;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package enpii\enpiiCms
 * Manage date picker resources using bootstrap
 */
class BootstrapDateRangePickerAsset extends AssetBundle
{
	public $sourcePath = '@enpii/enpiiCms/assets/bootstrapdaterangepicker/dist';
	public $css = [
		'daterangepicker.css'
	];
    public $js = [
	    'daterangepicker.js'
	];
	public $depends = [
	    'enpii\enpiiCms\assets\bootstrapdatepicker\BootstrapDatePickerAsset'
	];
}
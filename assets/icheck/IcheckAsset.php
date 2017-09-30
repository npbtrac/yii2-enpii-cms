<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:52 PM
 */

namespace enpii\enpiiCms\assets\icheck;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package enpii\enpiiCms
 * Manage iCheck resources
 */
class IcheckAsset extends AssetBundle
{
	public $sourcePath = '@enpii/enpiiCms/assets/icheck/dist';
	public $css = [
		'square/blue.css'
	];

	public $js = [
	    'icheck.min.js'
	];
	public $depends = [
	];
}
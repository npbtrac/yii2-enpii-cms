<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:52 PM
 */

namespace enpii\enpiiCms\assets\ionicons;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class IoniconsAsset
 * @package enpii\enpiiCms
 * Manage css for Ionicons fonts
 * http://ionicons.com/
 */
class IoniconsAsset extends AssetBundle
{
	public $sourcePath = '@enpii/enpiiCms/assets/ionicons/dist';
	public $css = [
		'css/ionicons.min.css'
	];

	public $js = [
	];
	public $depends = [
	];
}
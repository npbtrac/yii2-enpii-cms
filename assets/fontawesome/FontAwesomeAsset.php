<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:52 PM
 */

namespace enpii\enpiiCms\assets\fontawesome;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package enpii\enpiiCms
 * Manage Font Awesome resources
 */
class FontAwesomeAsset extends AssetBundle
{
	public $sourcePath = '@enpii/enpiiCms/assets/fontawesome/dist';
	public $css = [
		'css/font-awesome.min.css'
	];

	public $js = [
	];
	public $depends = [
	];
}
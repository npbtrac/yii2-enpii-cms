<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:52 PM
 */

namespace enpii\enpiiCms\assets\morrisjs;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package enpii\enpiiCms
 * Manage morris.js assets for chart drawing
 */
class MorrisJsAsset extends AssetBundle
{
	public $sourcePath = '@enpii/enpiiCms/assets/morrisjs/dist';
	public $css = [
		'morris.css'
	];

	public $js = [
	    'morris.min.js'
	];
	public $depends = [
	];
}
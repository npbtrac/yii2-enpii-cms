<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:52 PM
 */

namespace enpii\enpiiCms\assets\jvectormap;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class FontAwesomeAsset
 * @package enpii\enpiiCms
 * Manage jVectorMap http://jvectormap.com/
 */
class JvectorMapAsset extends AssetBundle
{
	public $sourcePath = '@enpii/enpiiCms/assets/jvectormap/dist';
	public $css = [
	    'jquery-jvectormap.css'
	];

	public $js = [
	    'jquery-jvectormap.js'
	];
	public $depends = [
	    'yii\web\JqueryAsset'
	];
}
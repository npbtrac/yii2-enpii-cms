<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:29 PM
 */

namespace enpii\enpiiCms\assets\jquerymaskedinput;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class JqueryPluginsAsset
 * @package enpii\enpiiCms\assets\jquerymaskedinput
 * Handle masked input
 * http://digitalbush.com/projects/masked-input-plugin/
 */
class JqueryMaskedInputAsset extends AssetBundle
{
	public $sourcePath = '@enpii/enpiiCms/assets/jquerymaskedinput/dist';
	public $css = [
	];

	public $js = [
	    'jquery.maskedinput.js',
	];
	public $depends = [
		// Need YiiAsset and BootstrapAsset to be loaded first
		'yii\web\JqueryAsset',
	];
}
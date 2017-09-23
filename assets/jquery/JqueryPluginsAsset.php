<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 11:29 PM
 */

namespace enpii\enpiiCms\assets\jquery;

use enpii\enpiiCms\libs\override\web\NpAssetBundle as AssetBundle;

/**
 * Class JqueryPluginsAsset
 * @package enpii\enpiiCms\assets\jquery
 * Handle all jQuery plugins use in this Enpii CMS
 */
class JqueryPluginsAsset extends AssetBundle
{
	public $sourcePath = '@enpiiCms/assets/jquery/web';
	public $css = [
	];

	public $js = [
	];
	public $depends = [
		// Need YiiAsset and BootstrapAsset to be loaded first
		'yii\web\JqueryAsset',
	];
}
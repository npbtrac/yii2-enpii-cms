<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/9/17 12:54 PM
 */

namespace enpii\enpiiCms\libs\override\web;


use yii\web\View;

/**
 * Class NpView
 * @package enpii\enpiiCms\libs\override\web
 * Override the View class for web application
 */
class NpView extends View
{
	/**
	 * @property string $description Description for a web page
	 */
	protected $description = '';

	/**
	 * @property string $keywords Keywords for web page
	 */
	protected $keywords = '';

	/**
	 * @property string $bodyClass CSS Class for web page
	 */
	protected $bodyClass = '';

	/**
	 * @return string
	 */
	public function getKeywords()
	{
		return $this->keywords;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function getBodyClass()
	{
		return $this->bodyClass;
	}

}
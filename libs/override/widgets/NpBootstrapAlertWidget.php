<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/21/17 4:59 PM
 */

namespace enpii\enpiiCms\libs\override\widgets;


use enpii\enpiiCms\libs\override\base\NpBootstrapWidget;

class NpBootstrapAlertWidget extends NpBootstrapWidget
{
	/**
	 * @var array the alert types configuration for the flash messages.
	 * This array is setup as $key => $value, where:
	 * - $key is the name of the session flash variable
	 * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
	 */
	public $alertTypes = [
		'error' => 'alert-danger',
		'danger' => 'alert-danger',
		'success' => 'alert-success',
		'info' => 'alert-info',
		'warning' => 'alert-warning'
	];

	/**
	 * @var array fonts awesome icon
	 */
	public $faIcons = [
		'error' => '<i class="fa fa-ban" aria-hidden="true"></i> &nbsp;&nbsp;',
		'danger' => '<i class="fa fa-minus-circle" aria-hidden="true"></i> &nbsp;&nbsp;',
		'success' => '<i class="fa fa-check-circle-o" aria-hidden="true"></i> &nbsp;&nbsp;',
		'info' => '<i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp;&nbsp;',
		'warning' => '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;&nbsp;'
	];

	/**
	 * @var array the options for rendering the close button tag.
	 */
	public $closeButton = [];

	public function init()
	{
		parent::init();
	}

	static public function widget($config = [])
	{
		$session = \Yii::$app->session;
		$flashes = $session->getAllFlashes();

		$thisObj = new static();

		$objOptions = (empty($thisObj->options)) ? [] : $thisObj->options;
		$appendCss = isset($objOptions['class']) ? ' ' . $objOptions['class'] : '';

		$strMessage = '';

		foreach ($flashes as $type => $data) {
			if (isset($thisObj->alertTypes[$type])) {
				$data = (array)$data;
				foreach ($data as $i => $message) {
					/* initialize css class for each alert box */
					$objOptions['class'] = $thisObj->alertTypes[$type] . $appendCss;

					/* assign unique id to each alert box */
					$objOptions['id'] = 'alert-' . $thisObj->getId() . '-' . $type . '-' . $i;

					$strMessage .= \yii\bootstrap\Alert::widget([
						'body' => (empty($thisObj->faIcons[$type]) ?: $thisObj->faIcons[$type]) . $message,
						'closeButton' => $thisObj->closeButton,
						'options' => $objOptions,
					]);
				}

				$session->removeFlash($type);
			}
		}
		$strMessage = empty($strMessage) ? '' : '<div id="alert-' . $thisObj->getId().'" class="np-alert">' . $strMessage . '</div>';
		return $strMessage;
	}
}
<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/9/17 12:54 PM
 */

namespace enpii\enpiiCms\libs\override\web;

use yii;
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
    public function getBodyClass()
    {
        return $this->bodyClass;
    }

    public function getHtmlHead()
    {
        $strHtmlHead = '';
        $strHtmlHead .= '<title>' . $this->getHtmlTitle() . '</title>';
        $strHtmlHead .= '<meta name="keywords" content="' . $this->getHtmlTitle() . '"/>';
        $strHtmlHead .= '<meta name="description" content="' . $this->getHtmlDescription() . '"/>';
        return $strHtmlHead;
    }

    public function getHtmlTitle()
    {
        return $this->title;
    }

    public function getHtmlKeywords()
    {
        return $this->keywords;
    }

    public function getHtmlDescription()
    {
        return $this->description;
    }

    /**
     * Put javascript for base url to head
     */
    public function addBaseUrlScript()
    {
        // Add base Url and absolute base Url to the head
        $arrJsPosHEad = empty($this->js[static::POS_HEAD]) ? [] : $this->js[static::POS_HEAD];
        array_unshift($arrJsPosHEad,
            "var absoluteBaseUrl = \"" . Yii::$app->urlManager->createAbsoluteUrl('site/index') . "\";");
        array_unshift($arrJsPosHEad, "var baseUrl = \"" . Yii::$app->urlManager->baseUrl . "\";");
        $this->js[static::POS_HEAD] = $arrJsPosHEad;
    }

    /**
     * Set title for browser with prefix
     * @param $title
     * @param bool $isFrontend
     * @param string $prefix
     */
    public function setBrowserTitle($title, $isFrontend = true, $prefix = 'Backend')
    {
        $strResult = ($isFrontend ? $title : $prefix . ' :: ' . $title);
        $this->title = $strResult;
    }
}
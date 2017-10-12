<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 8/17/16 5:27 PM
 */

namespace enpii\enpiiCms\widgets;

use enpii\enpiiCms\libs\override\helpers\NpArrayHelper as ArrayHelper;
use yii;
use kartik\select2\Select2;
use yii\web\JsExpression;

class NpDataRelationInput extends Select2
{
    public $targetClass;

    public $urlRelationList = '';
    public $urlView = '';
    public $textPlaceholder = '';
    public $textErrorLoading = '';
    public $textView = '';
    public $itemsPerPage = 20;
    public $quietInterval = 3000;
    public $maximumSelectionLength = 0;
    public $minimumInputLength = 0;

    public static $defaultConfig = [];

    public function init() {
        $this->textErrorLoading = Yii::t(_NP_TEXT_CATE, 'Waiting for results').'...';
        $this->textView = Yii::t(_NP_TEXT_CATE, 'View');


        $this->language = Yii::$app->language;
        $this->maintainOrder = true;

        $arrOptions = [
            'multiple' => true,
            'placeholder' => $this->textPlaceholder,
        ];
        $this->options = ArrayHelper::merge($arrOptions, $this->options);

        $arrPluginEvents = [];

        if (empty($this->data)) {
            $arrPluginOptions = [
                'language' => Yii::$app->language,
                'enoughRoomAbove' => true,
                'allowClear' => true,
                'minimumInputLength' => $this->minimumInputLength,
                'maximumSelectionLength' => $this->maximumSelectionLength,
                'cache' => true,
                'ajax' => [
                    'url' => $this->urlRelationList,
                    'dataType' => 'json',
                    'quietMillis' => $this->quietInterval,
                    'cache' => true,
                    'data' => new JsExpression('function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    }'),
                    'processResults' => new JsExpression('function (data, params) {
                        params.page = params.page || 1;
                        return { 
                            results: data.items,
                            pagination: {
                              more: (params.page * ' . $this->itemsPerPage . ') < data.total_count	
                            }
                        };
                    }'),

                ],
                'escapeMarkup' => new JsExpression('function (markup) { 
                    return markup; 
                }'),
                'templateResult' => new JsExpression('function(item) {
                    return item.text;
                }'),
                'templateSelection' => new JsExpression('function (item) {
                    var viewUrl = "' . ($this->urlView ? $this->urlView : '') . '";
                    var viewText = "' . $this->textView . '";
                    return (typeof(item.id) != "undefined" && item.id) ? item.text +" " + (viewUrl ? "<a class=\'colorbox iframe\' href=\'"+ viewUrl.replace("--id--", item.id) +"\'>" + viewText + "</a>" : "") : item.text;
                }'),
                'dropdownCssClass' => "bigdrop",
            ];

            $className = $this->targetClass;
            $initValue = $className::getSelect2Data($this->model->{$this->attribute});

            if (!empty($initValue)) {
                $strSelectedElements = '';
                foreach ($initValue as $key => $row) {
                    // Option tags for selected values
                    $strSelectedElements .= '<option value=\''.$row['id'].'\' selected>'.$row['text'].'</option>';
                }
                $this->pluginOptions['initSelection'] = new JsExpression('function (element, callback) {
                element.html("");
                element.append("'.$strSelectedElements.'");
                
                callback('. yii\helpers\Json::encode($initValue) .');    
            }');
            }
        } else {
            $arrPluginOptions = [
                'language' => Yii::$app->language,
                'enoughRoomAbove' => true,
                'allowClear' => true,
                'minimumInputLength' => $this->minimumInputLength,
                'maximumSelectionLength' => $this->maximumSelectionLength,
            ];
        }

        if ((isset($this->options['multiple']) && !$this->options['multiple']) || (isset($arrPluginOptions['multiple']) && !$arrPluginOptions['multiple'])) {
            $arrPluginEvents = [
                "select2:unselect" => 'function (e) { 
                        jQuery(e.target).find(\'option\').remove();
                        jQuery(e.target).append(\'<option value="" selected></option>\');
                    }'
            ];
        }

        $this->pluginOptions = ArrayHelper::merge($arrPluginOptions, $this->pluginOptions);
        $this->pluginEvents = ArrayHelper::merge($arrPluginEvents, $this->pluginEvents);

        parent::init();
    }
}
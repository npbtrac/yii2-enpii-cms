<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>
use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "enpii\\enpiiCms\\libs\\gridview\\NpGridView" : "enpii\\enpiiCms\\libs\\listview\\NpListView" ?>;
use enpii\enpiiCms\libs\NpActiveForm;
use enpii\enpiiCms\helpers\ArrayHelper;

/* @var $this enpii\enpiiCms\libs\NpView */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var Yii::$app->request \enpii\enpiiCms\libs\NpRequest */

$pageTitle = <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Management') ?>;
$this->setBrowserTitle($pageTitle, 0);
$this->params['breadcrumbs'][] = $pageTitle;

$queryParams = Yii::$app->request->getQueryParams();
$bulkQueryParams = ArrayHelper::merge([0 => 'bulk'], $queryParams);
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

    <h3 class="page-title">
        <?= "<?= " ?>Html::encode(<?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Management') ?>) ?>
    </h3>
    <div class="portlet light bordered">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-green-sharp bold uppercase">
                                <?= '<?=' ?> <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass)).' Listing') ?> ?>
                            </span>

                        </div>
                        <div class="actions">
                            <?= "<?= " ?>Html::a('<i class="fa fa-plus"></i> <span class="hidden-480">'.
                            <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
                            ['create'],
                            ['class' => 'btn blue btn-outline']) ?>
                        </div>
                    </div>

                    <?= '<?=' ?> $this->render('_search', ['model'  => $searchModel ])?>
                    <div class="portlet-body">
                    <?= '<?php' ?>
                    // Hidden Form and link action's form must have save ID
                    $formID = 'bulk-actions';
                    $gridID = 'main-list';

                    $this->registerJs(<<<JSCODE
                        jQuery('input[name="selection[]"]').click(function(){
                            if (jQuery('#{$formID}').find('input[name="selection[]"]').length > 0) {
                                jQuery('#{$formID}').find('input[name="selection[]"]').val(jQuery('#main-list').yiiGridView('getSelectedRows'));
                            } else {
                                jQuery('#{$formID}').append($('<input/>').attr({type: 'hidden', name: 'selection[]', value: jQuery('#{$gridID}').yiiGridView('getSelectedRows')}));
                            }
                        });
JSCODE
                    );

                    // Put a hidden form here
                    NpActiveForm::begin(
                        [
                            'options' => [
                                'id' => $formID,
                            ],
                        ]
                    );
                    NpActiveForm::end();

                    <?php if ($generator->indexWidgetType === 'grid'): ?>
                    echo NpGridView::widget([
                        'id' => $gridID,
                        'tableOptions' => ['class' => 'kv-grid-table table table-hover table-bordered table-striped table-condensed kv-table-wrap table-common-listing'],
                        'containerOptions'=>['style'=>'overflow: auto;'],
                        'headerRowOptions'=>['class'=>'table-heading'],
                        'filterRowOptions'=>['class'=>'table-filter'],
                        'bordered' => true,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'hover' => true,
                        'pjax' => false, // pjax is set to always true for this demo
                        // set your toolbar
                        'toolbar' => [
                            [
                                'content' => Html::a('<i class="fa fa-repeat"></i> '. <?= $generator->generateString('Reset') ?>, ['index'], [
                                    'data-pjax' => 0,
                                    'class' => 'btn btn-default',
                                    'title' => <?= $generator->generateString('Reset all params') ?>])
                                . ' '
                                . Html::a('<i class="fa fa-trash"></i> '. <?= $generator->generateString('Delete') ?>, $bulkQueryParams, [
                                     'class' => 'btn btn-danger',
                                     'title' => <?= $generator->generateString('Bulk Delete') ?>,
                                     'data' => [
                                         'confirm' => <?= $generator->generateString('Are you sure you want to delete?') ?>,
                                         'form' => $formID,
                                         'method' => 'post',
                                         'params' => [
                                             'bulk-option' => 'delete',
                                         ],
                                     ],
                                ])
                            ],
                        ],
                        'panel' => [
                            'heading' => false,
                        ],
                        'resizableColumns' => true,
                        'resizeStorageKey' => '<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>'.Yii::$app->user->id . '-' . date("d"),

                        'persistResize' => true,
                        'dataProvider' => $dataProvider,
                        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n'columns' => [\n" : "'columns' => [\n"; ?>
                            <?= "[
                                'class' => 'enpii\\enpiiCms\\libs\\gridview\\NpCheckBoxColumn',
                                'headerOptions' => [
                                    'class' => 'common-column-heading'
                                ],
                                'checkboxOptions' => ['class' => 'default-checkbox'],
                            ], "?>
                            <?= "[
                                'class' => 'enpii\\enpiiCms\\libs\\gridview\\NpSerialColumn',
                                'contentOptions' => ['class' => 'serial-column'],
                                'width' => '1%',
                                'vAlign' => 'middle',
                                'hAlign' => 'right',
                            ], "?>

                            <?php
                            $count = 0;
                            if (($tableSchema = $generator->getTableSchema()) === false) {
                                foreach ($generator->getColumnNames() as $name) {
                                    if (++$count < 6) {
                                        echo "            '" . $name . "',\n";
                                    } else {
                                        echo "            // '" . $name . "',\n";
                                    }
                                }
                            } else {
                                foreach ($tableSchema->columns as $column) {
                                    $format = $generator->generateColumnFormat($column);
                                    if (++$count < 6) {
                                        echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                    } else {
                                        echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                    }
                                }
                            }
                            ?>

                            ['class' => 'enpii\\enpiiCms\\libs\\gridview\\NpActionColumn',
                                'viewOptions' => [
                                    'title' => <?= $generator->generateString('View this item') ?>,
                                    'data-original-title' => <?= $generator->generateString('View this item') ?>,
                                    'data-container' => 'body',
                                    'class' => 'tooltips',
                                    'data-toggle' => 'tooltip'
                                ],
                                'updateOptions' => [
                                    'title' => <?= $generator->generateString('Edit this item') ?>,
                                    'data-original-title' => <?= $generator->generateString('Edit this item') ?>,
                                    'data-container' => 'body',
                                    'class' => 'tooltips',
                                    'data-toggle' => 'tooltip'
                                ],
                                'deleteOptions' => [
                                    'title' => <?= $generator->generateString('Delete this item') ?>,
                                    'data-original-title' => <?= $generator->generateString('Delete this item') ?>,
                                    'data-container' => 'body',
                                    'class' => 'tooltips',
                                    'data-toggle' => 'tooltip'
                                ],
                                'headerOptions' => ['class' => 'np-action-column'],
                            ],
                        ]
                    ]);
                    ?>
                    <?php else: ?>
                        <?= "<?= " ?>ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                        },
                        ]) ?>
                    <?php endif; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use enpii\enpiiCms\libs\override\helpers\NpHtml as Html;
use enpii\enpiiCms\libs\override\widgets\NpActiveForm as ActiveForm;
use enpii\enpiiCms\libs\override\web\NpView as View;
use <?= ltrim($generator->searchModelClass, '\\') ?> as <?= StringHelper::basename($generator->modelClass) ?>;

/* @var View $this */
/* @var <?= StringHelper::basename($generator->modelClass) ?> $model */
/* @var ActiveForm $form */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search margin-bottom-10">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="input-group">

        <?= '<?=' ?> $form->field($model, 'globalSearch', [
            'options' => [
                'tag' => false,
            ],
        ])->textInput([
            'placeholder' => <?= $generator->generateString('Search') ?>.'...',
            'class' => 'form-control'
        ])->label(false); ?>

        <span class="input-group-btn">
            <?= '<?=' ?> Html::submitButton(<?= $generator->generateString('Search') ?> . ' <i class="m-icon-swapright m-icon-white"></i>', ['class' => 'btn green-haze']) ?>
        </span>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>

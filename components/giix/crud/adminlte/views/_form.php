<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

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

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption font-green-sharp bold uppercase">
                    <span class="caption-subject bold uppercase"><?= "<?= " ?>Html::encode($pageTitle) ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

                    <?= "<?php " ?>$form = ActiveForm::begin(['options' => ['class'=> 'single-form', 'role' => 'form']]); ?>

                    <div class="form-body">

                <?php foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes)) {
                        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
                    }
                } ?>
                    </div>

                    <div class="form-actions">
                        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?= "<?php " ?>ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

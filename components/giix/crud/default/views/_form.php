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

use yii\helpers\Html;
use enpii\enpiiCms\libs\NpActiveForm;

/* @var $this enpii\enpiiCms\libs\NpView */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form enpii\enpiiCms\libs\NpActiveForm */
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

                    <?= "<?php " ?>$form = NpActiveForm::begin(['options' => ['class'=> 'single-form', 'role' => 'form']]); ?>

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

                    <?= "<?php " ?>NpActiveForm::end(); ?>

                </div>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>

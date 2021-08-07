<?php

/**
 * @var $this      yii\web\View
 * @var $formModel app\models\forms\UrlRecordForm
 */

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="url-record-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?php if ($formModel::SCENARIO_CREATE == $formModel->scenario): ?>
        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($formModel, 'full_url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-xs-6">
            <?= $form->field($formModel, 'expired_at', ['options' => ['class' => 'form-group required']])
                ->widget(DateTimePicker::class, [
                    'options'       => [
                        'placeholder'  => Yii::t('app', 'Select date'),
                        'autocomplete' => 'off',
                    ],
                    'layout'        => '{input}{remove}{picker}',
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format'         => 'php:Y-m-d H:i:s',
                        'todayHighlight' => true,
                        'minDate'        => 0,
                        'startDate'      => date("Y-m-d H:i:s"),
                    ],
                ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['#'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

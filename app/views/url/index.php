<?php

/**
 * @var $this         yii\web\View
 * @var $searchModel  app\models\UrlRecordSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $formModel    app\models\forms\GoToForm;
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'Urls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-record-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
                <?= Html::a('Create minimized url', ['create'], ['class' => 'btn btn-success']) ?>
            </div>

            <div class="col-xs-8">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => false,
                    'action'                 => ['/url/index'],
                    'options'                => [
                        'class' => 'form-inline',
                    ],
                ]); ?>

                    <?= $form->field($formModel, 'go_to')
                        ->textInput(['maxlength' => true, 'placeholder' => 'go to short url'])->label(false) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Go to', ['class' => 'btn btn-primary']) ?>
                        <div class="help-block"></div>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <br><br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'full_url',
            'short_url',
            'counter',
            [
                'attribute' => 'expired_at',
                'format'    => ['date', 'Y-M-d H:i:s'],
            ],
            [
                'attribute' => 'created_at',
                'format'    => ['date', 'Y-M-d H:i:s'],
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

</div>

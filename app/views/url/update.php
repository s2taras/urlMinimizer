<?php

/**
 * @var $this      yii\web\View
 * @var $formModel app\models\forms\UrlRecordForm
 */

use yii\helpers\Html;

$this->title = 'Update Url';
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="url-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'formModel' => $formModel,
    ]) ?>

</div>

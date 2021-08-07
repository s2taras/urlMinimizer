<?php

/**
 * @var $this      yii\web\View
 * @var $formModel app\models\forms\UrlRecordForm
 */

use yii\helpers\Html;

$this->title = 'Create Url';
$this->params['breadcrumbs'][] = 'Create';
?>
<div class="url-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'formModel' => $formModel,
    ]) ?>

</div>

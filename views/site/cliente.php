<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ClienteForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Cliente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cliente">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($msg): ?>
        <div class="alert alert-success">
            <h3><?= $msg ?></h3>
        </div>
    <?php endif ?>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                "method" => "post",
                'enableClientValidation' => true,
            ]); ?>

            <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'cedula') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'telefono') ?>

            <?= $form->field($model, 'genero') ?>

            <div class="form-group">
                <?= Html::submitButton('Continuar', ['class' => 'btn btn-primary', 'name' => 'cliente-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
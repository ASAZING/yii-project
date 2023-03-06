<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ConfirmarForm $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

$this->title = 'Confirmar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-confirmar">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Html::encode($clienteId)): ?>
        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin([
                    "method" => "post",
                    'enableClientValidation' => true,
                ]); ?>

                <?= $form->field($model, 'comprar')->label('¿Desea realizar una compra?')->radioList(array(true => "Si", false => "No"))?>

                <div class="form-group">
                    <?= Html::submitButton('Continuar', ['class' => 'btn btn-primary ', 'name' => 'confirmar-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    <?php else :?>
        <div>Accion no permitida</div>
    <?php endif ?>
</div>
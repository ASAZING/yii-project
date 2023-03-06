<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ConfirmarForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
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
                <?php if(Html::encode($comprar)): ?>
                    <?php $productos = ['Pc' => 'Pc', 'Monitor' => 'Monitor', 'Teclado' => 'Teclado', 'Mouse' => 'Mouse' ]; ?>
                    <?= $form->field($model, 'articulo')->dropDownList($productos, ['prompt' => '-- Seleccione una opcion --']);  ?>
                    <?= $form->field($model, 'precio') ?>
                    <?= $form->field($model, 'medio_pago') ?>
                <?php else: ?>
                    <?php $negatividad = ['Muy caro' => 'Muy caro', 'Se lo piensa mejor' => 'Se lo piensa mejor', 'No interesa' => 'No interesa' ]; ?>
                    <?= $form->field($model, 'negatividad')->label('¿Porque no quiere realizar una compra?')->dropDownList($negatividad, ['prompt' => '-- Seleccione una opcion --']);  ?>
                <?php endif ?>

                <div class="form-group">
                    <?= Html::submitButton('Comprar', ['class' => 'btn btn-primary ', 'name' => 'confirmar-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    <?php else :?>
        <div>Acción no permitida</div>
    <?php endif ?>
</div>
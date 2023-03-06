<?php

namespace app\models;

use yii\base\Model;

class ConfirmarForm extends Model
{
    public $comprar;
    
    public function rules()
    {
        return [
            ['comprar', 'required', 'message' => 'Campo requerido']
        ];
    }
}
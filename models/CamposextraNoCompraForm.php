<?php

namespace app\models;

use yii\base\Model;

class CamposextraNoCompraForm extends Model
{
    public $negatividad;
    
    public function rules()
    {
        return [
            [['negatividad'], 'required', 'message' => 'Campo requerido'],
        ];
    }
}
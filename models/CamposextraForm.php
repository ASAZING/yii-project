<?php

namespace app\models;

use yii\base\Model;

class CamposextraForm extends Model
{
    public $articulo;
    public $precio;
    public $medio_pago;
    
    public function rules()
    {
        return [
            [['articulo', 'precio', 'medio_pago'], 'required', 'message' => 'Campo requerido'],
            ['articulo','match', 'pattern' => '/^.{1,100}$/', 'message' => 'Mínimo 1 máximo 100 caracteres'],
            ['precio', 'number', 'message' => 'Sólo números'],
            ['precio', 'match', 'pattern' => '/^[0-9]+$/u', 'message' => 'Solo numeros']
        ];
    }
}
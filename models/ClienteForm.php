<?php

namespace app\models;

use yii\base\Model;

class ClienteForm extends Model
{
    public $nombre;
    public $cedula; 
    public $telefono; 
    public $email;
    public $genero;
    
    public function rules()
    {
        return [
            [['cedula', 'nombre', 'telefono', 'email', 'genero'], 'required', 'message' => 'Campo requerido'],
            ['email', 'email'],
            ['email','match', 'pattern' => '/^.{1,250}$/', 'message' => 'Mínimo 1 máximo 250 caracteres'],
            [['telefono', 'cedula'], 'number', 'message' => 'Sólo números'],
            ['telefono', 'match', 'pattern' => '/^.{1,50}$/', 'message' => 'Mínimo 1 máximo 50 caracteres'],
            [['genero','nombre'], 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras'],
            ['nombre', 'match', 'pattern' => '/^.{1,250}$/', 'message' => 'Mínimo 1 máximo 250 caracteres'],
            ['genero', 'match', 'pattern' => '/^.{1,10}$/', 'message' => 'Mínimo 1 máximo 10 caracteres'],
            [['telefono', 'cedula'], 'match', 'pattern' => '/^[0-9]+$/u', 'message' => 'Solo numeros']
        ];
    }
}
<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clientes}}`.
 */
class m230305_152932_create_clientes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('clientes', [
            'id' => $this->primaryKey(),
            'cedula' => $this->string(20)->notNull(),
            'nombre' => $this->string(250)->notNull(),
            'email' => $this->string(250)->notNull(),
            'telefono' => $this->string(50)->notNull(),
            'genero' => $this->string(10)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('clientes');
    }
}

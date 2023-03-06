<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%camposextra}}`.
 */
class m230305_153227_create_camposextra_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('camposextra', [
            'id' => $this->primaryKey(),
            'articulo' => $this->string(100),
            'precio' => $this->decimal(),
            'medio_pago' => $this->string(50),
            'negatividad' => $this->string(20),
            'id_externo' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('id_externo_camposextra_fk', 'camposextra', 'id_externo', 'clientes', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('camposextra');
    }
}

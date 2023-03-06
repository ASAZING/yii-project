CREATE DATABASE yii2basic;

use yii2basic;

create table clientes (  
    id int NOT NULL AUTO_INCREMENT,  
    cedula varchar (20) NOT NULL,
    nombre varchar(250) NOT NULL,  
    email varchar(250) NOT NULL,  
    telefono varchar(50) NOT NULL,  
    genero varchar(10) NOT NULL,
    PRIMARY KEY (id)  
); 

create table camposextra (  
    id int NOT NULL AUTO_INCREMENT,  
    id_externo int NOT NULL,
    articulo varchar(100),  
    precio decimal,  
    medio_pago varchar(50),  
    negatividad varchar(20),
    PRIMARY KEY (id),
    CONSTRAINT fk_id_externo FOREIGN KEY (id_externo)
    REFERENCES clientes(id)
); 

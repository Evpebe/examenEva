<?php

use PHPUnit\Framework\TestCase;

include './src/Enana.php';

class EnanaTest extends TestCase
{

    public function testCreandoEnana()
    {
        #Se probará la creación de enanas vivas, muertas y en limbo y se comprobará tanto la vida como el estado
        // Arrange
        $nombre = "Enana1";
        $puntosVida = 50;

        // Act
        $enana = new Enana($nombre, $puntosVida);

        // Assert
        $this->assertEquals($nombre, $enana->getNombre());
        $this->assertEquals($puntosVida, $enana->getPuntosVida());
        $this->assertEquals("muerta", $enana->getSituacion());
    }
    public function testHeridaLeveVive()
    {
        #Se probará el efecto de una herida leve a una Enana con puntos de vida suficientes para sobrevivir al ataque
        #Se tendrá que probar que la vida es mayor que 0 y además que su situación es viva
        // Arrange
        $nombre = "Enana1";
        $puntosVida = 30; // Suficientes puntos de vida para sobrevivir al ataque
        $enana = new Enana($nombre, $puntosVida);

        // Act
        $enana->heridaLeve();

        // Assert
        $this->assertGreaterThan(0, $enana->getPuntosVida()); // Vida mayor que 0
        $this->assertEquals("viva", $enana->getSituacion()); // Situación es "viva"

    }

    public function testHeridaLeveMuere()
    {
        #Se probará el efecto de una herida leve a una Enana con puntos de vida insuficientes para sobrevivir al ataque
        #Se tendrá que probar que la vida es menor que 0 y además que su situación es muerta
        // Arrange
        $nombre = "Enana1";
        $puntosVida = 10; // Insuficientes puntos de vida para sobrevivir al ataque
        $enana = new Enana($nombre, $puntosVida);

        // Act
        $enana->heridaLeve();

        // Assert
        $this->assertLessThan(0, $enana->getPuntosVida()); // Vida menor que 0
        $this->assertEquals("muerta", $enana->getSituacion()); // Situación es "muerta"
    }

    public function testHeridaGrave()
    {
        #Se probará el efecto de una herida grave a una Enana con una situación de viva.
        #Se tendrá que probar que la vida es 0 y además que su situación es limbo
         // Arrange
         $nombre = "Enana1";
         $puntosVida = 50; // Suficientes puntos de vida para sobrevivir al ataque
         $enana = new Enana($nombre, $puntosVida);
 
         // Act
         $enana->heridaGrave();
 
         // Assert
         $this->assertEquals(0, $enana->getPuntosVida()); // Vida es 0
         $this->assertEquals("limbo", $enana->getSituacion()); // Situación es "limbo"
    }

    public function testPocimaRevive()
    {
        #Se probará el efecto de administrar una pócima a una Enana muerta pero con una vida mayor que -10 y menor que 0
        #Se tendrá que probar que la vida es mayor que 0 y que su situación ha cambiado a viva
        // Arrange
        $nombre = "Enana1";
        $puntosVida = -5; // Vida mayor que -10 y menor que 0
        $enana = new Enana($nombre, $puntosVida);

        // Act
        $enana->pocima();

        // Assert
        $this->assertGreaterThan(0, $enana->getPuntosVida()); // Vida mayor que 0
        $this->assertEquals("viva", $enana->getSituacion()); // Situación es "viva"

    }

    public function testPocimaNoRevive()
    {
        #Se probará el efecto de administrar una pócima a una Enana en el libo
        #Se tendrá que probar que la vida y situación no ha cambiado
        // Arrange
        $nombre = "Enana1";
        $puntosVida = 0;
        $situacionInicial = "limbo";
        $enana = new Enana($nombre, $puntosVida);
        $enana->setSituacion($situacionInicial);

        // Act
        $enana->pocima();

        // Assert
        $this->assertEquals(0, $enana->getPuntosVida()); // Vida no cambia
        $this->assertEquals($situacionInicial, $enana->getSituacion()); // Situación no cambia

    }

    public function testPocimaExtraLimbo()
    {
        #Se probará el efecto de administrar una pócima Extra a una Enana en el limbo.
        #Se tendrá que probar que la vida es 50 y la situación ha cambiado a viva.
        // Arrange
        $nombre = "Enana1";
        $puntosVida = 0;
        $situacionInicial = "limbo";
        $enana = new Enana($nombre, $puntosVida);
        $enana->setSituacion($situacionInicial);

        // Act
        $enana->pocimaExtra();

        // Assert
        $this->assertEquals(50, $enana->getPuntosVida()); // Vida es 50
        $this->assertEquals("viva", $enana->getSituacion()); // Situación es "viva"
    }
}

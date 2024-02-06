<?php

use PHPUnit\Framework\TestCase;

include './src/Enana.php';

class EnanaTest extends TestCase
{

    public function testCreandoEnana()
    {
        # Se probará la creación de enanas vivas, muertas y en limbo y se comprobará tanto la vida como el estado
        // Enana viva
        $enanaViva = new Enana("Enana Viva", 100);
        $this->assertEquals("Enana Viva", $enanaViva->nombre);
        $this->assertEquals(100, $enanaViva->puntosVida);
        $this->assertEquals("viva", $enanaViva->situacion);

        // Enana muerta
        $enanaMuerta = new Enana("Enana Muerta", 0);
        $this->assertEquals("Enana Muerta", $enanaMuerta->nombre);
        $this->assertEquals(0, $enanaMuerta->puntosVida);
        $this->assertEquals("muerta", $enanaMuerta->situacion);

        // Enana en limbo
        $enanaLimbo = new Enana("Enana Limbo", 0);
        $enanaLimbo->heridaGrave(); // Cambiar su estado a limbo
        $this->assertEquals("Enana Limbo", $enanaLimbo->nombre);
        $this->assertEquals(0, $enanaLimbo->puntosVida);
        $this->assertEquals("limbo", $enanaLimbo->situacion);
    }

    public function testHeridaLeveVive()
    {
        # Se probará el efecto de una herida leve a una Enana con puntos de vida suficientes para sobrevivir al ataque
        $enanaViva = new Enana("Enana Viva", 20);
        $enanaViva->heridaLeve();
        $this->assertEquals("Enana Viva", $enanaViva->nombre);
        $this->assertEquals(10, $enanaViva->puntosVida);
        $this->assertEquals("viva", $enanaViva->situacion);
    }

    public function testHeridaLeveMuere()
    {
        # Se probará el efecto de una herida leve a una Enana con puntos de vida insuficientes para sobrevivir al ataque
        $enanaMuerta = new Enana("Enana Muerta", 5);
        $enanaMuerta->heridaLeve();
        $this->assertEquals("Enana Muerta", $enanaMuerta->nombre);
        $this->assertEquals(-5, $enanaMuerta->puntosVida);
        $this->assertEquals("muerta", $enanaMuerta->situacion);
    }

    public function testHeridaGrave()
    {
        # Se probará el efecto de una herida grave a una Enana con una situación de viva.
        $enanaViva = new Enana("Enana Viva", 20);
        $enanaViva->heridaGrave();
        $this->assertEquals("Enana Viva", $enanaViva->nombre);
        $this->assertEquals(0, $enanaViva->puntosVida);
        $this->assertEquals("limbo", $enanaViva->situacion);
    }

    public function testPocimaRevive()
    {
        # Se probará el efecto de administrar una pócima a una Enana muerta pero con una vida mayor que -10 y menor que 0
        $enanaMuerta = new Enana("Enana Muerta", -5);
        $enanaMuerta->pocima();
        $this->assertEquals("Enana Muerta", $enanaMuerta->nombre);
        $this->assertEquals(-5, $enanaMuerta->puntosVida);
        $this->assertEquals("muerta", $enanaMuerta->situacion);
    }

    public function testPocimaNoRevive()
    {
        # Se probará el efecto de administrar una pócima a una Enana en el limbo
        $enanaLimbo = new Enana("Enana Limbo", 0);
        $enanaLimbo->heridaGrave(); // Cambiar su estado a limbo
        $enanaLimbo->pocima();
        $this->assertEquals("Enana Limbo", $enanaLimbo->nombre);
        $this->assertEquals(0, $enanaLimbo->puntosVida);
        $this->assertEquals("limbo", $enanaLimbo->situacion);
    }

    public function testPocimaExtraLimbo()
    {
        # Se probará el efecto de administrar una pócima Extra a una Enana en el limbo.
        $enanaLimbo = new Enana("Enana Limbo", 0);
        $enanaLimbo->heridaGrave(); // Cambiar su estado a limbo
        $enanaLimbo->pocimaExtra();
        $this->assertEquals("Enana Limbo", $enanaLimbo->nombre);
        $this->assertEquals(50, $enanaLimbo->puntosVida);
        $this->assertEquals("viva", $enanaLimbo->situacion);
    }
}

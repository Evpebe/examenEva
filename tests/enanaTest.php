<?php

use PHPUnit\Framework\TestCase;
//
include './src/Enana.php';

class EnanaTest extends TestCase
{
  public function testCreandoEnana()
  {
    $enanaViva = new Enana("EnanaViva", 10);
    $this->assertEquals("viva", $enanaViva->getSituacion());
    $this->assertEquals(10, $enanaViva->getPuntosVida());

    $enanaMuerta = new Enana("EnanaMuerta", -10);
    $this->assertEquals("muerta", $enanaMuerta->getSituacion());
    $this->assertEquals(-10, $enanaMuerta->getPuntosVida());

    $enanaLimbo = new Enana("EnanaLimbo", 0);
    $this->assertEquals("limbo", $enanaLimbo->getSituacion());
    $this->assertEquals(0, $enanaLimbo->getPuntosVida());
  }

  public function testHeridaLeveVive()
  {
    $enana = new Enana("EnanaViva", 20);
    $enana->heridaLeve();
    $this->assertEquals("viva", $enana->getSituacion());
    $this->assertEquals(10, $enana->getPuntosVida());
  }

  public function testHeridaLeveMuere()
  {
    $enana = new Enana("EnanaMuerta", 5);
    $enana->heridaLeve();
    $this->assertEquals("muerta", $enana->getSituacion());
    $this->assertEquals(-5, $enana->getPuntosVida());
  }

  public function testHeridaGrave()
  {
    $enana = new Enana("EnanaViva", 15);
    $enana->heridaGrave();
    $this->assertEquals("limbo", $enana->getSituacion());
    $this->assertEquals(0, $enana->getPuntosVida());
  }

  public function testPocimaRevive()
  {
    $enana = new Enana("EnanaMuerta", -5);
    $enana->pocima();
    $this->assertEquals("viva", $enana->getSituacion());
    $this->assertGreaterThan(0, $enana->getPuntosVida());
  }

  public function testPocimaNoRevive()
  {
    $enana = new Enana("EnanaLimbo", 0);
    $vidaInicial = $enana->getPuntosVida();
    $enana->pocima();
    $this->assertEquals("limbo", $enana->getSituacion());
    $this->assertEquals($vidaInicial, $enana->getPuntosVida());
  }

  public function testPocimaExtraLimbo()
  {
    $enana = new Enana("EnanaLimbo", 0);
    $enana->pocimaExtra();
    $this->assertEquals("viva", $enana->getSituacion());
    $this->assertEquals(50, $enana->getPuntosVida());
  }
}
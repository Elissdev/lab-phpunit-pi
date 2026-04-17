<?php

use PHPUnit\Framework\TestCase;

class ValidadorNotaFiscalTest extends TestCase
{
    private ValidadorNotaFiscal $validador;

    protected function setUp(): void
    {
        $this->validador = new ValidadorNotaFiscal();
    }

    public function testCalcularImpostoRetidoParaMEIRetornaZero()
    {
        $resultado = $this->validador->calcularImpostoRetido(1000.0, 'MEI');
        $this->assertEquals(0.0, $resultado);
    }

    public function testCalcularImpostoRetidoParaLTDA()
    {
        $resultado = $this->validador->calcularImpostoRetido(1000.0, 'LTDA');
        $this->assertEquals(50.0, $resultado); // 5% de 1000
    }

    public function testCalcularImpostoRetidoParaLTDAComValorDecimal()
    {
        $resultado = $this->validador->calcularImpostoRetido(1234.56, 'LTDA');
        $this->assertEquals(61.728, $resultado); // 5% de 1234.56 = 61.728
    }

    public function testCalcularImpostoRetidoLancaExcecaoParaValorZero()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Valor do serviço deve ser positivo.');
        $this->validador->calcularImpostoRetido(0.0, 'MEI');
    }

    public function testCalcularImpostoRetidoLancaExcecaoParaValorNegativo()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Valor do serviço deve ser positivo.');
        $this->validador->calcularImpostoRetido(-100.0, 'LTDA');
    }

    public function testCalcularImpostoRetidoLancaExcecaoParaTipoEmpresaInvalido()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Tipo de empresa inválido. Use "MEI" ou "LTDA".');
        $this->validador->calcularImpostoRetido(1000.0, 'SA');
    }
}
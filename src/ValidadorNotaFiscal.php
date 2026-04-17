<?php

class ValidadorNotaFiscal
{
    /**
     * Calcula o imposto retido com base no valor do serviço e tipo de empresa.
     *
     * @param float $valorServico Valor do serviço prestado (deve ser positivo)
     * @param string $tipoEmpresa Tipo da empresa ('MEI' ou 'LTDA')
     * @return float Imposto retido
     * @throws Exception Se o valor for zero ou negativo
     */
    public function calcularImpostoRetido(float $valorServico, string $tipoEmpresa): float
    {
        if ($valorServico <= 0) {
            throw new Exception('Valor do serviço deve ser positivo.');
        }

        if ($tipoEmpresa === 'MEI') {
            return 0.0;
        }

        if ($tipoEmpresa === 'LTDA') {
            return $valorServico * 0.05;
        }

        // Se o tipo não for reconhecido, podemos lançar uma exceção? 
        // O enunciado só menciona MEI ou LTDA, então assumimos que apenas esses são válidos.
        // Vou lançar uma exceção para tipo inválido.
        throw new Exception('Tipo de empresa inválido. Use "MEI" ou "LTDA".');
    }
}
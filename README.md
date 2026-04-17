# Laboratório de Automação de Backend com PHPUnit (PI)

Este laboratório demonstra a criação de uma classe de validação de nota fiscal com testes unitários usando PHPUnit, com foco em garantir regras de negócio e compliance fiscal. O exemplo implementa cálculos de impostos retidos para diferentes tipos de empresa (MEI e LTDA), além de validações de valores inválidos e tratamento de exceções.

## Contexto de Compliance Fiscal

Emissão de notas fiscais requer precisão nos cálculos tributários e aderência às regras fiscais brasileiras. Este laboratório simula um cenário real onde:

- **MEI (Microempreendedor Individual)**: isento de imposto retido sobre serviços.
- **LTDA (Sociedade Limitada)**: retém 5% do valor do serviço como imposto.
- **Validações**: valores de serviço devem ser positivos, e apenas tipos de empresa conhecidos são aceitos.

A automação de testes unitários garante que essas regras sejam aplicadas corretamente, evitando erros manuais e multas por descumprimento fiscal.

## Estrutura do projeto

- `src/ValidadorNotaFiscal.php` – Classe que implementa a regra de negócio
- `tests/ValidadorNotaFiscalTest.php` – Testes unitários para a classe
- `composer.json` – Configuração do projeto e dependências
- `exemplo.php` – Exemplo de uso da classe
- `vendor/` – Dependências do Composer (não versionada)

## Regras de negócio implementadas

A classe `ValidadorNotaFiscal` possui um método `calcularImpostoRetido` que:

1. Recebe dois parâmetros:
   - `float $valorServico` – valor do serviço prestado (deve ser positivo)
   - `string $tipoEmpresa` – tipo da empresa (`'MEI'` ou `'LTDA'`)

2. Retorna o imposto retido:
   - Para `'MEI'`: imposto retido é `0`
   - Para `'LTDA'`: imposto retido é `5%` do valor do serviço

3. Lança uma exceção `Exception` se:
   - O valor do serviço for zero ou negativo
   - O tipo de empresa não for `'MEI'` ou `'LTDA'`

## Passo a passo para execução dos testes localmente via Composer

1. **Certifique‑se de ter o PHP (>=8.1) e o Composer instalados**  
   Verifique com `php --version` e `composer --version`.

2. **Clone o repositório (se aplicável) e entre no diretório do projeto**  
   ```bash
   cd lab-phpunit-pi
   ```

3. **Instale as dependências (PHPUnit)**  
   ```bash
   composer install
   ```

4. **Execute a suíte de testes**  
   ```bash
   ./vendor/bin/phpunit tests/ValidadorNotaFiscalTest.php
   ```

5. **Verifique a saída**  
   Se todos os testes passarem, você verá uma saída semelhante a:
   ```
   PHPUnit 10.5.63 by Sebastian Bergmann and contributors.

   Runtime:       PHP 8.1.2-1ubuntu2.23

   ......                                                              6 / 6 (100%)

   Time: 00:00.004, Memory: 6.00 MB

   OK (6 tests, 9 assertions)
   ```

## Exemplo de uso

```php
<?php
require_once 'vendor/autoload.php';

$validador = new ValidadorNotaFiscal();

try {
    $imposto = $validador->calcularImpostoRetido(1500.0, 'MEI');
    echo "Imposto MEI: " . $imposto; // 0.0
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
```

Execute o exemplo com:

```bash
php exemplo.php
```

## Cenários de teste implementados

1. **MEI retorna zero** – valor positivo, tipo MEI → imposto 0
2. **LTDA calcula 5%** – valor positivo, tipo LTDA → imposto = 5% do valor
3. **LTDA com valor decimal** – cálculo correto com casas decimais
4. **Valor zero lança exceção** – valor 0 → exceção com mensagem adequada
5. **Valor negativo lança exceção** – valor negativo → exceção com mensagem adequada
6. **Tipo de empresa inválido lança exceção** – tipo desconhecido → exceção

## Tecnologias utilizadas

- PHP 8.1+
- Composer 2.2+
- PHPUnit 10.5+

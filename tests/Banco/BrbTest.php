<?php

namespace Tests\OpenBoleto\Banco;

use OpenBoleto\Banco\Brb;
use PHPUnit\Framework\TestCase;


class BrbTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstantiateWithoutArgumentsShouldWork()
    {
        $this->assertInstanceOf(\OpenBoleto\Banco\Brb::class, new Brb());
    }

    /**
     * @return void
     */
    public function testInstantiateShouldWork()
    {
        $instance = new Brb(
            array(
                // Parâmetros obrigatórios
                'dataVencimento' => new \DateTime('2013-01-01'),
                'valor' => 10.50,
                'sequencial' => 758964, // Até 6 dígitos
                'agencia' => 172, // Até 3 dígitos
                'carteira' => 1, // 1 ou 2
                'conta' => 0403005, // Até 7 dígitos
            )
        );

        $this->assertInstanceOf(\OpenBoleto\Banco\Brb::class, $instance);
        $this->assertEquals('07090.00178 20132.613173 58964.070286 3 55650000001050', $instance->getLinhaDigitavel());
        $this->assertSame('175896407028', (string) $instance->getNossoNumero());
    }
}

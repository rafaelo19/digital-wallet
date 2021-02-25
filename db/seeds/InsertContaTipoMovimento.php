<?php


use Phinx\Seed\AbstractSeed;

class InsertContaTipoMovimento extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $dataConta = [
            [
                "nome"    => "Persona 1",
                "saldo"    => 0,
                "status" => true,
            ],
            [
                "nome"    => "Persona 2",
                "saldo"    => 5000,
                "status" => true,
            ]
        ];

        $conta = $this->table("dw.conta");
        $conta->insert($dataConta)
            ->saveData();

        $dataTipoMovimento = [
            [
                "cod"    => "DEP",
                "descricao" => "Depósito"
            ],
            [
                "cod"    => "SQE",
                "descricao" => "Saque"
            ],
            [
                "cod"    => "TRS",
                "descricao" => "Transferência"
            ],
        ];
        $tipoMovimento = $this->table("dw.tipo_movimento");
        $tipoMovimento->insert($dataTipoMovimento)
            ->saveData();
    }
}

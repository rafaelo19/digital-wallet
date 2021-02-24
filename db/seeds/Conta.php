<?php


use Phinx\Seed\AbstractSeed;

class Conta extends AbstractSeed
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
        $data = [
            [
                'id'    => '1',
                'nome'    => 'Persona 1',
                'saldo'    => 0,
                'status' => true,
            ],
            [
                'id'    => '2',
                'nome'    => 'Persona 2',
                'saldo'    => 5000,
                'status' => true,
            ]
        ];

        $posts = $this->table('dw.contas');
        $posts->insert($data)
            ->saveData();
    }
}

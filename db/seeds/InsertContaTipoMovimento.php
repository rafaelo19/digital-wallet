<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class InsertContaTipoMovimento extends AbstractSeed
{
    public function run(): void
    {
        $usuario = $this->fetchRow('select id from dw.usuario order by id asc limit 1');

        if (!$usuario) {
            $this->table('dw.usuario')
                ->insert([
                    [
                        'email' => 'rafael@digitalwallet.local',
                        'senha' => password_hash('123456', PASSWORD_BCRYPT),
                        'status' => true,
                    ],
                ])
                ->saveData();

            $usuario = $this->fetchRow('select id from dw.usuario order by id asc limit 1');
        }

        $idUsuario = (int) ($usuario['id'] ?? 0);

        if ((int) ($this->fetchRow('select count(*) as total from dw.conta')['total'] ?? 0) === 0) {
            $this->table('dw.conta')
                ->insert([
                    [
                        'nome' => 'Persona 1',
                        'id_usuario' => $idUsuario,
                        'saldo' => 0,
                        'status' => true,
                    ],
                    [
                        'nome' => 'Persona 2',
                        'id_usuario' => $idUsuario,
                        'saldo' => 5000,
                        'status' => true,
                    ],
                ])
                ->saveData();
        }

        if ((int) ($this->fetchRow('select count(*) as total from dw.tipo_movimento')['total'] ?? 0) > 0) {
            return;
        }

        $this->table('dw.tipo_movimento')
            ->insert([
                [
                    'cod' => 'DEP',
                    'descricao' => 'Deposito',
                ],
                [
                    'cod' => 'SQE',
                    'descricao' => 'Saque',
                ],
                [
                    'cod' => 'TRS',
                    'descricao' => 'Transferencia',
                ],
            ])
            ->saveData();
    }
}

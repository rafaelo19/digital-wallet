<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CriacaoTabelaUsuario extends AbstractMigration
{
    public function up(): void
    {
        $usuarios = $this->table('dw.usuario');
        $usuarios->addColumn('email', 'string')
            ->addColumn('senha', 'string')
            ->addColumn('status', 'boolean')
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }

    public function down(): void
    {
        $this->table('dw.usuario')->drop()->save();
    }
}

<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class VinculoUsuarioConta extends AbstractMigration
{
    public function up(): void
    {
        $totalContas = (int) ($this->fetchRow('select count(*) as total from dw.conta')['total'] ?? 0);
        $usuarios = $this->fetchAll('select id from dw.usuario order by id asc');

        if ($totalContas > 0 && count($usuarios) !== 1) {
            throw new \RuntimeException(
                'Nao foi possivel vincular contas existentes automaticamente. ' .
                'Mantenha exatamente um usuario cadastrado ou execute um backfill manual antes desta migracao.'
            );
        }

        $contas = $this->table('dw.conta');
        $contas->addColumn('id_usuario', 'integer', ['null' => true, 'after' => 'id'])
            ->addForeignKey('id_usuario', 'dw.usuario', ['id'], ['constraint' => 'fk_conta_usuario_id'])
            ->update();

        if ($totalContas > 0) {
            $idUsuario = (int) $usuarios[0]['id'];
            $this->execute("update dw.conta set id_usuario = {$idUsuario} where id_usuario is null;");
        }
    }

    public function down(): void
    {
        $contas = $this->table('dw.conta');
        $contas->dropForeignKey('id_usuario')
            ->removeColumn('id_usuario')
            ->update();
    }
}

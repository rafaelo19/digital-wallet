<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CriacaoTabelas extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */


    public function change(): void
    {
        /**
         * Coluna id com auto incremento é criado automatico, sem necessidade de definição na migration.
         */
        $contas = $this->table("dw.conta");
        $contas->addColumn("nome", 'string')
            ->addColumn("saldo", 'decimal')
            ->addColumn("status", 'boolean')
            ->create();

        $tipo_movimentos = $this->table("dw.tipo_movimento");
        $tipo_movimentos->addColumn("cod","string")
            ->addColumn("descricao","string")
            ->create();

        $movimentos = $this->table("dw.movimento");
        $movimentos->addColumn("id_tipo_movimento","integer")
            ->addColumn("id_conta_origem","integer")
            ->addColumn("id_conta_destino","integer")
            ->addColumn("descricao","string")
            ->addColumn("datahora","datetime")
            ->addForeignKey("id_tipo_movimento", "dw.tipo_movimento", ["id"], ['constraint' => 'fk_tipimovimento_id'])
            ->addForeignKey("id_conta_origem", "dw.conta", ["id"], ['constraint' => 'fk_contas_origem_id'])
            ->addForeignKey("id_conta_destino", "dw.conta", ["id"], ['constraint' => 'fk_contas_destino_id'])
            ->create();
    }
}

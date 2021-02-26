<?php

declare(strict_types=1);

namespace App\Sqls;

class SelectMoviments
{
    public const SELECT_MOVIMENTS_ACCOUNT = "
    select
        m.id_conta_origem as id,
        c.nome,
        to_char(date (m.datahora), 'dd/mm/YYYY') as data,
        m.descricao || '-' || tm.cod || '-' || tm.descricao as descricao,
        case when tm.cod = 'DEP' then m.valor else -1 * m.valor end as valor
    from dw.movimento m
    inner join dw.conta c on c.id = m.id_conta_origem
    inner join dw.tipo_movimento tm on tm.id = m.id_tipo_movimento
    where c.id = :id_conta
    order by m.datahora asc";
}
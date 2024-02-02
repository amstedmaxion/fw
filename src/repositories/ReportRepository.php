<?php

namespace src\repositories;

use PDO;
use src\database\Database;
use src\database\models\Item;

class ReportRepository extends BaseRepository
{
  function __construct(Item $item = null)
  {
    $this->setModel($item ?? (new Item));
  }

  function listReserves()
  {
    $bd = (new Database(LOGIX_PROD))->connect();

    $list = "SELECT 
            a.num_reserva AS reserva_sup5740, 
            b.num_req AS requisicao_max0465, 
            b.dt_usua_re AS data_requisicao, 
            b.nom_usua_re AS matricula_requisicao, 
            e.nom_funcionario AS nome_requisicao, 
            b.sit_req, 
            d.cod_item, 
            d.qtd_solic 
          FROM 
            mx_req_matseg_compl a 
            JOIN mx_req_matseg b ON b.cod_empresa = a.cod_empresa 
            AND b.num_req = a.num_req 
            AND b.sit_req = 'R' 
            JOIN mx_req_matsegit d ON d.cod_empresa = a.cod_empresa 
            AND d.num_req = a.num_req 
            JOIN funcionario e ON e.cod_empresa = b.cod_empresa 
            AND e.num_matricula = b.nom_usua_re 
            LEFT JOIN estoque_loc_reser c ON c.cod_empresa = a.cod_empresa 
            AND a.num_reserva = c.num_reserva 
          WHERE 
            a.cod_empresa = '09' 
            AND c.num_reserva IS NULL INTO TEMP t_1;
          SELECT 
            a.num_docum AS reserva_sup5740, 
            b.requisicao_max0465 AS requisicao_max0465, 
            b.data_requisicao, 
            b.matricula_requisicao, 
            b.nome_requisicao, 
            b.cod_item, 
            b.qtd_solic, 
            a.dat_movto, 
            a.nom_usuario, 
            c.nom_funcionario 
          FROM 
            estoque_trans a, 
            t_1 b, 
            funcionario c 
          WHERE 
            a.cod_empresa = '09' 
            AND a.num_docum = b.reserva_sup5740 
            AND c.cod_empresa = a.cod_empresa 
            AND c.num_matricula = a.nom_usuario INTO TEMP t_2;
          INSERT INTO t_2 
          SELECT 
            a.num_docum AS reserva_sup5740, 
            b.requisicao_max0465 AS requisicao_max0465, 
            b.data_requisicao, 
            b.matricula_requisicao, 
            b.nome_requisicao, 
            b.cod_item, 
            b.qtd_solic, 
            a.dat_movto, 
            a.nom_usuario, 
            c.nom_funcionario 
          FROM 
            h_estoque_trans a, 
            t_1 b, 
            funcionario c 
          WHERE 
            a.cod_empresa = '09' 
            AND a.num_docum = b.reserva_sup5740 
            AND c.cod_empresa = a.cod_empresa 
            AND c.num_matricula = a.nom_usuario
        ";

    $queries = explode(";", $list);
    foreach ($queries as $key => $query) {
      $stmt = $bd->prepare($query);
      $stmt->execute();
    }

    $listMaxNotInSUP = $bd->query("SELECT * FROM t_1")->fetchAll(PDO::FETCH_ASSOC);
    $listLoweredStock = $bd->query("SELECT * FROM t_2 ORDER BY dat_movto")->fetchAll(PDO::FETCH_ASSOC);

    return  [
      "listMaxNotInSUP" => $listMaxNotInSUP,
      "listLoweredStock" => $listLoweredStock
    ];
  }
}

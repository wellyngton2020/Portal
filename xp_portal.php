<?php

$hostname = "localhost";
$bancodedados = "gclar";
$usuario = "root";
$senha = "";

$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);
if($conexao->connect_errno){
   echo "Falha ao conectar: (" . $conexao->connect_errno . ") " . $conexao->connect_error;
}

if($_POST["op"] == 1) {

  $dataI = "'" . $_POST["dataI"] . "'";
  $dataF = "'" . $_POST["dataF"] . "'";
  $loja = "'" . $_POST["loja"] . "'";
  $status = "'" . $_POST["status"] . "'";

  echo $dataI;
 
  if(isset($_POST["textoProcurado"])){
    echo '
      <!-- input pesquisar pedido da grid -->
      <table id="tabresultHeader" class="table table-success table-striped table-hover" style="height:100px;align="center";overflow:scroll;overflow-x:hidden;width:auto;border:0pt none !important;">
      <thead>
      <tr>
        <th scope="col" style="display:none">ID</th>
        <th scope="col">Pedido</th>
        <th scope="col">Marketplace</th>
        <th scope="col">Finalizado</th>
        <th scope="col" >Link Etiqueta</th>
        <th scope="col">Data Envio</th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody>';

          // select da grid
          $sql = "
          SELECT 
            ID, 
            PEDIDO, 
            CASE 
              WHEN ID_MARKETPLACE = 1 THEN 'Magazine Luiza'
              WHEN ID_MARKETPLACE = 2 THEN 'Mercado Livre'
              ELSE 'Shopee'
            END AS MARKETPLACE, 
            CASE 
              WHEN DTH_ENVIO IS NOT NULL THEN 'SIM'
              ELSE 'NÃO'
            END AS FINALIZADO, 
            LINK_ETIQUETA, 
            DATE_FORMAT(dth_inclusao, '%d/%m/%Y') AS DTH_INCLUSAO 
          FROM PEDIDOS
          WHERE
            PEDIDO LIKE " . "'%" . $_POST["textoProcurado"] .  "%'" . "
          ";		
          $result = $conexao->query($sql);
          
          $linhas = mysqli_num_rows($result);


      while($user_data = mysqli_fetch_assoc($result)){
                  echo "<tr>";
                  echo "<td id='id_pedido' style='display:none'>" . $user_data["ID"]."</td>";
                  echo "<td id='pedido'>" . $user_data["PEDIDO"]."</td>";
                  echo "<td id='id_marketplace'>" . $user_data["MARKETPLACE"]."</td>";
                  echo "<td id='finalizado'>" . $user_data["FINALIZADO"]."</td>";
                  echo "<td id='link_etiqueta'> <a class='btn btn-sm btn-primary' href='" . $user_data["LINK_ETIQUETA"] .  "' target='_blank'>" . $user_data["LINK_ETIQUETA"] . "</a></td>";
                  echo "<td id='dth_envio'>" .  $user_data["DTH_INCLUSAO"] ."</td>";
                  if($user_data["FINALIZADO"] == 'SIM'){
                    echo "<td> 
                    <a class='btn btn-sm btn-primary' id='linkEditar'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                      <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                      <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                      </svg>
                    </a>
                    </td>
                    </tr>";            
                  }else
                  echo "<td> 
                    <a class='btn btn-sm btn-primary' id='linkEditar'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                      <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                      <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                      </svg>
                    </a>                  
                    <a class='btn btn-sm bg-success text-white' id='linkFinalizar'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>
                      <path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>
                      </svg>
                    </a>
                    </td>
                  </tr>";
                  echo  '</td></tr>';     
              }
              echo '
              <td id="contagemPedidos" colspan="7"> Total de pedidos: '  . $linhas . '</td>	
            </tbody>
          </table>
        </div>
        ';

  }else{
    echo '
      <!-- input pesquisar pedido da grid -->
      <table id="tabresultHeader" class="table table-success table-light table-striped table-hover" style="height:100px;align="center";overflow:scroll;overflow-x:hidden;width:auto;border:0pt none !important;">
      <thead>
      <tr>
        <th scope="col" style="display:none">ID</th>
        <th scope="col">Pedido</th>
        <th scope="col">Marketplace</th>
        <th scope="col">Finalizado</th>
        <th scope="col" >Link Etiqueta</th>
        <th scope="col">Data Envio</th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody>';

          // select da grid
          $sql = "
          SELECT 
            ID, 
            PEDIDO, 
            CASE 
              WHEN ID_MARKETPLACE = 1 THEN 'Magazine Luiza'
              WHEN ID_MARKETPLACE = 2 THEN 'Mercado Livre'
              ELSE 'Shopee'
            END AS MARKETPLACE, 
            CASE 
              WHEN DTH_ENVIO IS NOT NULL THEN 'SIM'
              ELSE 'NÃO'
            END AS FINALIZADO,  
            LINK_ETIQUETA, 
            DATE_FORMAT(dth_inclusao, '%d/%m/%Y') AS DTH_INCLUSAO 
          FROM PEDIDOS
          WHERE
            DTH_INCLUSAO BETWEEN "  . $dataI . " and " . $dataF . " and
            (FINALIZADO = " . $status . " or " . $status . " = " . "0" . ")" . " and
            (id_loja = " . $loja . " or " . $loja . " = " . "0" . ")" . "
          
          ";
           		
          $result = $conexao->query($sql);

          echo $sql;
          
          $linhas = mysqli_num_rows($result);

      while($user_data = mysqli_fetch_assoc($result)){
                  echo "<tr>";
                  echo "<td id='id_pedido' style='display:none'>" . $user_data["ID"]."</td>";
                  echo "<td id='pedido'>" . $user_data["PEDIDO"]."</td>";
                  echo "<td id='id_marketplace'>" . $user_data["MARKETPLACE"]."</td>";
                  echo "<td id='finalizado'>" . $user_data["FINALIZADO"]."</td>";
                  echo "<td id='link_etiqueta'> <a class='btn btn-sm btn-primary' href='" . $user_data["LINK_ETIQUETA"] .  "' target='_blank'>" . $user_data["LINK_ETIQUETA"] . "</a></td>";
                  echo "<td id='dth_envio'>" .  $user_data["DTH_INCLUSAO"] ."</td>";
                  if($user_data["FINALIZADO"] == 'SIM'){
                    echo "<td> 
                    <a class='btn btn-sm btn-primary' id='linkEditar'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                      <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                      <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                      </svg>
                    </a>
                    </td>
                    </tr>";            
                  }else
                  echo "<td> 
                    <a class='btn btn-sm btn-primary' id='linkEditar'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                      <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                      <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                      </svg>
                    </a>                  
                    <a class='btn btn-sm bg-success text-white' id='linkFinalizar'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>
                      <path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>
                      </svg>
                    </a>
                    </td>
                  </tr>";
                  echo  '</td></tr>';     
              }

              echo '
              <td id="contagemPedidos" colspan="7"> Total de pedidos: '  . $linhas . '</td>		
            </tbody>
          </table>
        </div>
        ';

    }
}

if($_POST["op"] == 2) {
  
  $id = $_POST["id"];
  $pedido = $_POST["pedido"];
  $marketplace = $_POST["marketplace"];
  $link_etiqueta = $_POST["link_etiqueta"];
  $id_loja = $_POST["id_loja"];

  if($id != ''){
    $sql="
      update pedidos
        set 
          pedido = " . "'" . $pedido . "'" . ",
          id_marketplace = " . "'" .  $marketplace . "'" . ",
          id_loja = " . "'" .  $id_loja . "'" . ",
          link_etiqueta = " . "'" . $link_etiqueta . "'" . "
        where
          id =" . $id . "
    ";
    $result = $conexao->query($sql);  
    echo $ret = 'Pedido editado com sucesso!';  
  }else {

    $sql="
      insert into pedidos
      (
        pedido,
        id_marketplace,
        link_etiqueta,
        id_loja,
        finalizado
      )values(
      "."'".$pedido."'".",
      "."'".$marketplace."'".",
      "."'".$link_etiqueta."'".",
      "."'".$id_loja."'".",
      "."'".'2'."'"."
      )
    ";
    $result = $conexao->query($sql); 
    echo $ret = 'Pedido registrado com sucesso!';
  }

}

if($_POST["op"] == 3) {

  $login = $_POST["login"];
  $senha = $_POST["senha"];

  $sql="
    select 
      a.login as login,
      a.nome as nome,
      a.senha as senha
    from usuarios a
    where
      a.login = " . "'" . $login . "'" . " and
      a.senha = " . "'" . $senha . "'" . "
  ";
  $result = $conexao->query($sql); 

  while($user_data = mysqli_fetch_assoc($result)){
    //echo $user_data["nome"];
    echo $user_data["nome"];
  }

}

if($_POST["op"] == 4) {

  $pedido = "'" . $_POST["pedido"] . "'";

  $sql="
  update pedidos
    set 
      dth_envio = " . "'" . date('Y/m/d') . "'" . "
    where
      pedido =" . $pedido . "
  ";
  $result = $conexao->query($sql);  

  echo $sql;
}

?>


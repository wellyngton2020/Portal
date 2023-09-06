<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="imagex/png" href="./img/icon2.ico">
  <title>Portal de serviços</title>
</head>

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<!-- jquery local -->
<!-- <link rel="stylesheet" href="/portal_gc_lar_novo/jquery/fancybox/jquery.fancybox.css" type="text/css" media="screen" /> -->
<link rel="stylesheet" type="text/css" href="/portal_gc_lar_novo/jquery/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="/portal_gc_lar_novo/jquery/jquery.multiselect.filter.css" />
<link type="text/css" rel="stylesheet" href="/portal_gc_lar_novo/jquery/jquery.ui.checkbox.css" />
<link rel="stylesheet" type="text/css" href="/portal_gc_lar_novo/estilos/chosen-0.9.14.css" />
<script type="text/javascript" language="javascript" src="/portal_gc_lar_novo/jquery/jquery.upload-1.0.2.js"></script>
<script type="text/javascript" language="javascript" src="/portal_gc_lar_novo/jquery/jquery.tablesorter.min.js"></script>
<script type="text/javascript" language="javascript" src="/portal_gc_lar_novo/jquery/jquery.fp.gridSorter.js"></script>
<script type="text/javascript" language="javascript" src="/portal_gc_lar_novo/jquery/jquery.price_format.min.js"></script>
<!-- <script type="text/javascript" language="javascript" src="/portal_gc_lar_novo/jquery/jquery.ui.checkbox.js"></script> -->
<script type="text/javascript" language="javascript" src="/portal_gc_lar_novo/jquery/chosen.jquery-0.9.14.js"></script>
<script type="text/javascript" src="/portal_gc_lar_novo/jquery/jquery.multiselect.js"></script>
<script type="text/javascript" src="/portal_gc_lar_novo/jquery/jquery.multiselect.filter.js"></script>

<!-- bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- css local -->
<link rel="stylesheet" href="style.css">

<!-- js -->
<script type="text/javascript" language="javascript" charset="utf-8" src="funcoes.js?<?php echo uniqid();?>"></script>

<!-- Alertas de erros, sucesso -->
<script src="notify.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">

<!-- header -->
<div class="header">
    <div class="logo">
         <img src="img/logo_portal2.png" alt="">
         <label id="msgBemVindo" for="">
          <?php
            $usuario = explode("?", $_GET['usuario']);
            $loja = str_replace("loja=","",$usuario[1]);
            
            echo '<b>' . $usuario[0] . '</b>' . ' • ';
            
            if($loja == 1){
              echo 'GC Lar';
            }

            if($loja == 2){
              echo 'Elegan';
            }

            if($loja == 3){
              echo 'Bemake';
            }

          ?>
         </label>
         <a class='btn btn-sm btn-danger' id='linkLogout' href="./login.php">
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
         <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
        </svg>
        </a>    
    </div>
</div>

<!-- menu teste -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Home</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Cadastros</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#" id="navCadPeidos">Pedidos</a></li>
      <li><a class="dropdown-item" href="#">Produtos</a></li>
      <li><a class="dropdown-item" href="#">Lojas</a></li>
    </ul>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Relatórios</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Vendas</a></li>
      <li><a class="dropdown-item" href="#">Vendas mensais</a></li>
      <li><a class="dropdown-item" href="#">Vendas por loja</a></li>
    </ul>
  </li>
</ul>

<!-- div pesquisa -->
<div class="formularios">  
      <form>
        <label for="lname">Data inicial</label>
        <input type="date" id="dataI" value="" name="dataI">
        <label for="lname" >Data Final</label>
        <input type="date" id="dataF" value="" name="dataF">
        <label for="lname">Loja</label>
        <select id="cbLoja" name="cbLoja">
          <option value="0" selected>Todos</option>
          <option value="1">GC Lar</option>
          <option value="2">GC Modas</option>
          <option value="3">Beemake</option>
        </select>
        <label for="lname">Status</label>
        <select id="cbStatus" name="cbStatus">
          <option value="0" selected>Todos</option>
          <option value="1">Em aberto</option>
          <option value="2">Finalizado</option>
        </select>  
        <input type="button" value="Pesquisar" id="btnPesquisar" class="btn btn-secondary">
        <!-- <button id="btnCadastrar" class="btn btn-primary">Cadastrar Pedido</button></td>    -->
        <a class="btn btn-primary" id='btnCadastrar'>Cadastrar Pedido</a>
        <hr>
      </form>
</div>

<div class="box-search" style="display:none;">
  <input type="search" class="form-control w-25" placeholder="Pesquisar" id="searchData">      
</div>

<!-- grid pedidos -->
<div id="divOrcamentos"></div>

<!-- modal editar/cadastrar pedido -->
<div id="divPedidos" title="Pedidos">
  <form class="row g-3">
    <div class="col-md-6">
      <input type="text" id="txtID" class="form-control" placeholder="ID" disabled="true" style="display:none;">
    </div>
    <select class="form-select" aria-label="Default select example" id="cbMarketplace">
      <option value="0">Escolha um marketplace...</option>
      <option value="1">Magazine Luiza</option>
      <option value="2">Mercado livre</option>
      <option value="3">Shopee</option>
    </select>
    <select class="form-select" aria-label="Default select example" id="cbloja2">
      <option value="0">Escolha uma loja...</option> 
      <option value="1">GC Lar</option>
      <option value="2">GC Modas</option>
      <option value="3">Beemake</option>
    </select>
    <div class="form-label">
      <input type="text" class="form-control" id="txtPedido" placeholder="Pedido...">
    </div>
    <div class="form-label">
      <input type="email" class="form-control" id="txtlinkEtiqueta" placeholder="Link da etiqueta...">
    </div>  
  </form>
</div>





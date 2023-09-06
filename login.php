<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="./img/icon2.ico">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- css local -->
    <link rel="stylesheet" href="login.css">

    <!-- js -->
    <script type="text/javascript" language="javascript" charset="utf-8" src="funcoes.js?<?php echo uniqid();?>"></script>
    <title>Login</title>

    <!-- Alertas de erros, sucesso -->
    <script src="notify.min.js"></script>

</head>
<body>
    <!-- div login -->
        <div id="login">
            <h1>Login</h1>
            <input type="text" placeholder="Usuário ou e-mail..." id="txtLogin" required>
            <br><br>
            <input type="password" placeholder="Senha..." id="txtSenha" required>
            <br><br>
            <select id="cbLoja">
            <option value="1">GC Lar</option>
            <option value="2">GC Modas</option>
            <option value="3">Beemake</option>
            </select>
            <br><br>
            <button type="submit" id="btnLogar">Entrar</button>
        </div>
</body>
</html>





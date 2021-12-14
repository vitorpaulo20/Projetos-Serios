<?php
session_start();
include_once('config.php');

// print_r($_SESSION);
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}
$logado = $_SESSION['email'];


$dtInicial = $_POST['data_inicial1'];
$dtFinal = $_POST['data_final1'];


//Converte data de padrão br para padrão americano 
$data = implode("-", array_reverse(explode("/", $dtInicial)));

$data = implode("-", array_reverse(explode("/", $_POST['data_inicial1'])));

$dataAjuste = trim($data);

$dataAjustada = "'" . $dataAjuste . "'";



$dataF = implode("-", array_reverse(explode("/", $_POST['data_final1'])));

$dataAjusteF = trim($dataF);

$dataAjustadaF = "'" . $dataAjusteF . "'";


$sql = "SELECT * FROM relatorios WHERE faturamento BETWEEN $dataAjustada AND $dataAjustadaF";
$result = $conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="imagex/png" href="../sistema-cadastro-php/Imagens/dafonteLogo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>SISTEMA | PV</title>
    
    <style>
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
        }

        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        #data_inicial{
            border-radius: 10px;
        }

        #data_final{
            border-radius: 10px;
        }

        .btn-info{
height: 47px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SISTEMA DO PV</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <br>
    <?php
    echo "<h1>Bem vindo <u>$logado</u></h1>";
    ?>
    <br>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col" width="10%">Data</th>
                    <th scope="col" width="15%">CNPJ</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Lojas</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
//converte em data pt br pesquisa do banco dedados 

                    $dataEnd = implode("/",array_reverse(explode("-",$user_data['faturamento'])));


if(strlen($user_data['valor']) == 3 or strlen($user_data['valor']) == 4){
    $valorEditado = str_replace (".",",",$user_data['valor']);
  
}else{

    $valorEditado = (float)$user_data['valor'];
}

                   

                    echo "<tr>";
                    echo "<td>" . $dataEnd . "</td>";
                    echo "<td>" . $user_data['cnpj'] . "</td>";
                    echo "<td>" . $user_data['nome'] . "</td>";
                    echo "<td>" . $user_data['cidade'] . "</td>";
                    echo "<td>" . $user_data['estado'] . "</td>";
                    echo "<td>" . $user_data['quantidade'] . "</td>";
                    echo "<td>" . $user_data['valor'] . "</td>";
                    echo "<td>" . $user_data['loja'] . "</td>";
                    echo "</tr>";
                    echo "<td></td>";
                    echo "</tr>";
                }

                //../sistema-cadastro-php/gerar_planilha.php

                ?>

 <nav class="navbar navbar-expand-lg  shadow text-center navbarMenu">
 <div class=" collapse navbar-collapse" id="navbarSupportedContent">
                <form action="../sistema-cadastro-php/sistema.php" method="POST" id="form1">

                    <?php


                    ?>


                    <label><b>'Listar Informação: '</b></label>

                    <input type="date" name="data_inicial1" id="data_inicial">
                    "até"
                    <input type="date" name="data_final1" id="data_final">

                    <button type="submit" class="btn btn-info">Listar</button>

                    <br>

                </form>
 </div>               
 </nav>
 <nav class="navbar navbar-expand-lg  shadow text-center navbarMenu">
 <div class=" collapse navbar-collapse" id="navbarSupportedContent">

                <form action="../sistema-cadastro-php/gerar_planilha.php" method="POST" id="form2">
                    <label><b>'Range do relatorio :'</b></label>

                    <input type="date" name="data_inicial" id="data_inicial">
                    "até"
                    <input type="date" name="data_final" id="data_final">

                    <button type="submit" class="btn btn-info">Relatorio</button>


                </form>
 </div>
 </nav>

            </tbody>
        </table>
    </div>
</body>

</html>
<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$arquivo = 'rltvendas.xls';
$html = '';
$html .='<table border="1">';
$html .='<tr>';
$html .= '<td colspan="4">Planilha de Vendas</tr>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>NOME</td>';
$html .= '<td>NUMERO VENDA</td>';
$html .= '<td>VALOR VENDA</td>';
$html .= '<td>DATA</td>';
$html .= '</tr>';

// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
// Envia o conteúdo do arquivo


echo $html;
		
exit;?>



    
</body>
</html>
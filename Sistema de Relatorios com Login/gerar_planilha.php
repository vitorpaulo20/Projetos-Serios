<!--**
 * @author Cesar Szpak - Celke -   cesar@celke.com.br
 * @pagina desenvolvida usando framework bootstrap,
 * o código é aberto e o uso é free,
 * porém lembre -se de conceder os créditos ao desenvolvedor.
 *-->
 <?php
    session_start();
    include_once('config.php');
    // print_r($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['email'];


    $dtInicial=$_POST['data_inicial'];
    $dtFinal=$_POST['data_final'];


//Converte data de padrão br para padrão americano 
    $data = implode("-",array_reverse(explode("/",$dtInicial)));

$data = implode("-",array_reverse(explode("/",$_POST['data_inicial'])));

$dataAjuste = trim($data);

$dataAjustada ="'".$dataAjuste."'";



$dataF = implode("-",array_reverse(explode("/",$_POST['data_final'])));

$dataAjusteF = trim($dataF);

$dataAjustadaF ="'".$dataAjusteF."'";


	$sql = "SELECT * FROM relatorios WHERE faturamento BETWEEN $dataAjustada AND $dataAjustadaF";
    $result = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Contato</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'arquivo.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td><b>Data</b></td>';
		$html .= '<td><b>CNPJ</b></td>';
		$html .= '<td><b>Nome</b></td>';
		$html .= '<td><b>Cidade</b></td>';
		$html .= '<td><b>Estado</b></td>';
		$html .= '<td><b>Quantidade</b></td>';
		$html .= '<td><b>Valor</b></td>';
		$html .= '<td><b>Loja</b></td>';
		$html .= '</tr>';
		
	
		

		while($user_data = mysqli_fetch_assoc($result)) {
			
			
			$html .= "<tr>";
			$html .= "<td>".$user_data['faturamento']."</td>";
			$html .=  "<td>".$user_data['cnpj']."</td>";
			$html .=  "<td>".$user_data['nome']."</td>";
			$html .=  "<td>".$user_data['cidade']."</td>";
			$html .=  "<td>".$user_data['estado']."</td>";
			$html .=  "<td>".$user_data['quantidade']."</td>";
			$html .=  "<td>".$user_data['valor']."</td>";
			$html .=  "<td>".$user_data['loja']."</td>";
			$html .="</tr>";
		}
		

		

				// Configurações header para forçar o download
				header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
				header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
				header ("Cache-Control: no-cache, must-revalidate");
				header ("Pragma: no-cache");
				header ("Content-type: application/x-msexcel");
				header ("Content-Disposition: attachment; filename=\"arquivo.xls\"" );
				header ("Content-Description: PHP Generated Data" );
			
		// Envia o conteúdo do arquivo
		echo "$html";
		exit;?>
	</body>
</html>
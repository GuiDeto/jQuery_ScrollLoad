<?php require_once"modulos/MySqlCon.class.php";

$numero_pagina 		= filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

if(!is_numeric($numero_pagina)){
    header('HTTP/1.1 500 Invalid page number!');
    exit();
}

// echo "<div id='load_$numero_pagina'>$numero_pagina pagina</div>";

$dados_por_pagina 	= 50;
$posicao 			= (($numero_pagina-1) * $dados_por_pagina);

$loadData = MySqlCon::fetchAll("SELECT * FROM nwcon893_coopmil.coop_dep LIMIT $posicao, $dados_por_pagina;");

foreach ($loadData as $key => $value) {
	echo $value['idCoopDep'];
	echo "<br />";
}
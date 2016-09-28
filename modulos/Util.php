<?php 
	/**	*****************************************	***
	**			Criado por Guilherme Milanez		***
	**			 Utilitarios para sistemas			***
	**				   21/06/2011					***
	**												***
	**				    Criptografia				***
	**				Inverção de Strings				***
	**			Inclusão de Imagens com logo		***
	**												***
	**	*****************************************	***/
/*
	acentuar($Palavra_Acentuada)
	retira_acentos($texto)
	converteData($data, $se, $ss)
	mask($val, $mask)
	CopiaDir($DirFont, $DirDest)
	Limpa_String($String)
	Inverte($Txt_Inverter)
	Cript_Str($Txt_Cript)
	Contar_Palavras($Txt_Contar)
	gerarAlfa($l)
	calc_idade($data_nasc)
 	extenso($valor = 0, $maiusculas = false)
	Data_Atual($Cid)
	removerSimbolos($str)
	removerSimbolosSpace($str)
	removerSibolosNumeros($str)
	removerletrasSimbolos($str)
*/


	class Util{

		protected  $converterData, $Inverter_Str, $Criptografar, $Foto_M, $Foto_P, $Foto_G, $Foto_GG, $Transparencia, $Altura_M, $Altura_P, $Altura_G, $Altura_GG, $Largura_M, $Largura_P, $Largura_G, $Largura_GG, $Marca_M, $Marca_P, $Marca_G, $Marca_GG, $verifica_tipo, $Limpa, $Sql_X, $Alterar_Codificacao;

		public static function acentuar($Palavra_Acentuada)
		{

			$Acentuados  = array("Á", "á", "Â", "â", "À ", "à", "Ã ", "ã", "É", "é", "Ê ", "ê", "È", "è", "Í", "í", "Î", "î", "Ì", "ì", "Ó", "ó", "Ô", "ô", "Ò", "ò", "Ø ", "ø", "Õ", "õ", "Ú", "ú", "Û", "û", "Ù", "ù");
			$Codificados = array("&Aacute;", "&aacute;", "&Acirc;", "&acirc;", "&Agrave;", "&agrave;", "&Atilde;", "&atilde;", "&Eacute;", "&eacute;", "&Ecirc;", "&ecirc;", "&Egrave;", "&egrave;", "&Iacute;", "&iacute;", "&Icirc;", "&icirc;", "&Igrave;", "&igrave;", "&Oacute;", "&oacute;", "&Ocirc;", "&ocirc;", "&Ograve;", "&ograve;", "&Oslash;", "&oslash;", "&Otilde;", "&otilde;", "&Uacute;", "&uacute;", "&Ucirc;", "&ucirc;", "&Ugrave;", "&ugrave;");

			$Alterar_Codificacao = str_replace($Acentuados, $Codificados, $Palavra_Acentuada);	
			return $Alterar_Codificacao;

		}

		public static function randColor(){
			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			return $rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
		}

		/******************************************
		**** 		  Remover Acentos 		    ***
		*******************************************/
		public static function sqlPassword($input) {
			$pass = strtoupper(
				sha1(
					sha1($input, true)
					)
				);
			$pass = '*' . $pass;
			return $pass;
		}

		/******************************************
		**** 		  Remover Acentos 		    ***
		*******************************************/
		public static function retira_acentos($texto){
			return strtr($texto, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC");
		}

		public static function removerAcentos($texto){
			return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$texto);
		}

		
		/******************************************
		**** 		  Converter Data 		    ***
		*******************************************/
		
		public static function converteData($data, $se, $ss){
			return  implode($ss, array_reverse(explode($se, $data)));
		}

		/**********************************************************************
		**  Copia o Diretório Fonte dado com todos seus sub-diretórios e 
		**  arquivos para o Diretório Destino indicado:
		**  Obs.:   - Função recursiva;
		**          - Montada para Linux (Separador "/");
		**          - $DirDest deverá ser completo, com o nome do
		**            diretório a ser criado.
		************************************************************************/
		public static function CopiaDir($DirFont, $DirDest){
			if(!is_dir($DirDest))mkdir($DirDest);
			if ($dd = opendir($DirFont)) {
				while (false !== ($Arq = readdir($dd))) {
					if($Arq != "." && $Arq != ".."){
						$PathIn = "$DirFont/$Arq";
						$PathOut = "$DirDest/$Arq";
						if(is_dir($PathIn)){
							self::CopiaDir($PathIn, $PathOut);
						}elseif(is_file($PathIn)){
							copy($PathIn, $PathOut);
						}
					}
				}
				closedir($dd);
			}
		}

		# Removing symbols
		public static function removerSimbolos($str){
			return preg_replace("/[^a-zA-Z0-9\s]/", "", $str);
		}
		# Remove symbols, including spaces
		public static function removerSimbolosSpace($str){
			return preg_replace("/[^a-zA-Z0-9]/", "", $str);
		}
		# Removing symbols and numbers
		public static function removerSibolosNumeros($str){
			return preg_replace("/[^a-zA-Z\s]/", "", $str);
		}
		# Removing letters and symbols
		public static function removerletrasSimbolos($str){
			return preg_replace("/[^0-9\s]/", "", $str);
		}
		public static function limparCPF($str){
			$str = str_replace('.', '', $str);
			$str = str_replace('-', '', $str);
			return $str;
		}

		public static function seo_friendly_url($string){
			$string = str_replace(array('[\', \']'), '', $string);
			$string = preg_replace('/\[.*\]/U', '', $string);
			$string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
			$string = htmlentities($string, ENT_COMPAT, 'utf-8');
			$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
			$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
			return strtolower(trim($string, '-'));
		}

		public static function cleanString($text) {
			$utf8 = array(
				'/[áàâãªä]/u'   =>   'a',
				'/[ÁÀÂÃÄ]/u'    =>   'A',
				'/[ÍÌÎÏ]/u'     =>   'I',
				'/[íìîï]/u'     =>   'i',
				'/[éèêë]/u'     =>   'e',
				'/[ÉÈÊË]/u'     =>   'E',
				'/[óòôõºö]/u'   =>   'o',
				'/[ÓÒÔÕÖ]/u'    =>   'O',
				'/[úùûü]/u'     =>   'u',
				'/[ÚÙÛÜ]/u'     =>   'U',
				'/ç/'           =>   'c',
				'/Ç/'           =>   'C',
				'/ñ/'           =>   'n',
				'/Ñ/'           =>   'N',
		        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
		        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
		        '/[“”«»„]/u'    =>   ' ', // Double quote
		        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
		        );
			return preg_replace(array_keys($utf8), array_values($utf8), $text);
		}

		public static function toAscii($str) {
			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
			$clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_| -]+/", '-', $clean);

			return $clean;
		}

		/******************************************
		**** 		CRIAR MASCARA    		    ***
		echo mask($cnpj,'##.###.###/####-##');
		echo mask($cpf,'###.###.###-##');
		echo mask($cep,'#####-###');
		echo mask($data,'##/##/####');
		*******************************************/

		public static function mask($val, $mask)
		{
			$maskared = '';
			$k = 0;
			for($i = 0; $i<=strlen($mask)-1; $i++)
			{
				if($mask[$i] == '#')
				{
					if(isset($val[$k]))
						$maskared .= $val[$k++];
				}
				else
				{
					if(isset($mask[$i]))
						$maskared .= $mask[$i];
				}
			}
			return $maskared;
		}


		/******************************************
		**** 		  Limpar String    		    ***
		*******************************************/

		public static function Limpa_String($String){

			$Limpa = addslashes($String);
			$Limpa = preg_replace('/\s\s+/',' ', $Limpa);
			$Limpa = str_replace('%','', $Limpa);
			$Limpa = str_replace('_','', $Limpa);
			$Limpa = str_replace("'","", $Limpa);
			// $Limpa = preg_replace("/[^a-zA-Z0-9\s]/", "", $Limpa);
			$Limpa = trim($Limpa);
		 	$Limpa = strip_tags($Limpa);//tira tags html e php
		 	return $Limpa;	
		 }

		 public static function cleanInput($input) {

		 	$search = array(
						    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
						    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
						    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
						    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
						    );

		 	$output = preg_replace($search, '', $input);
		 	return $output;
		 }

		 public static function sanitize($input) {
		 	if (is_array($input)) {
		 		foreach($input as $var=>$val) {
		 			$output[$var] = sanitize($val);
		 		}
		 	}
		 	else {
		 		if (get_magic_quotes_gpc()) {
		 			$input = stripslashes($input);
		 		}
		 		$input  = self::cleanInput($input);
		 		$output = mysql_real_escape_string($input);
		 	}
		 	return $output;
		 }



		/******************************************
		**** 		   INVERTER STRINGS   		***
		*******************************************/
		
		public static function Inverte($Txt_Inverter){
			$Inverter_Str = "";
			for ($c = strlen($Txt_Inverter)-1; $c >= 0; $c--)
				$Inverter_Str .= $Txt_Inverter[$c];
			return $Inverter_Str;
		}

	  /******************************************
	  ***			CRIPTOGRAFAR 				***
	  *******************************************/	
	  
	  public static function Cript_Str($Txt_Cript){
	  	
	  	$Criptografar = "";
	  	$Criptografar = md5(base64_encode(pack('H*', sha1($Txt_Cript))));
	  	$Criptografar = self::Inverte($Criptografar);
	  	return $Criptografar;
	  }

	  /******************************************
	  ***			Contar Palavras 		  ***
	  *******************************************/	
	  
	  public static function Contar_Palavras($Txt_Contar){
	  	$frase2 = explode(" ", $Txt_Contar);
	  	return count($frase2);
	  }

	  /**************************************************************************************
	  ***		Gerar ID AlfaNumÃ©rico geraAlfa("30";   ***
	  ***************************************************************************************/	

	  public static function gerarAlfa($l) {

	  	$s = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	  	$geraAlfa = null;
	  	$loop = false;

	  	while (strlen($geraAlfa) < $l){
	  		$geraAlfa .= $s[mt_rand( 0, (strlen($s) - 1) )];
	  	}
	  	return $geraAlfa;
	  }
	  
	  public static function valida_CPF($cpf){
  // determina um valor inicial para o digito $d1 e $d2
  // pra manter o respeito ;)
	  	$d1 = 0;
	  	$d2 = 0;
	  	$cpf = preg_replace ("@[./-]@", "", $cpf);
  // remove tudo que não seja número
	  	$cpf = preg_replace("/[^0-9]/", "", $cpf);
  // lista de cpf inválidos que serão ignorados
	  	$ignore_list = array(
	  		'00000000000',
	  		'01234567890',
	  		'11111111111',
	  		'22222222222',
	  		'33333333333',
	  		'44444444444',
	  		'55555555555',
	  		'66666666666',
	  		'77777777777',
	  		'88888888888',
	  		'99999999999'
	  		);
  // se o tamanho da string for dirente de 11 ou estiver
  // na lista de cpf ignorados já retorna false
	  	if(strlen($cpf) != 11 || in_array($cpf, $ignore_list)){
	  		return false;
	  	} else {
    // inicia o processo para achar o primeiro
    // número verificador usando os primeiros 9 dígitos
	  		for($i = 0; $i < 9; $i++){
      // inicialmente $d1 vale zero e é somando.
      // O loop passa por todos os 9 dígitos iniciais
	  			$d1 += $cpf[$i] * (10 - $i);
	  		}
    // acha o resto da divisão da soma acima por 11
	  		$r1 = $d1 % 11;
    // se $r1 maior que 1 retorna 11 menos $r1 se não
    // retona o valor zero para $d1
	  		$d1 = ($r1 > 1) ? (11 - $r1) : 0;
    // inicia o processo para achar o segundo
    // número verificador usando os primeiros 9 dígitos
	  		for($i = 0; $i < 9; $i++) {
      // inicialmente $d2 vale zero e é somando.
      // O loop passa por todos os 9 dígitos iniciais
	  			$d2 += $cpf[$i] * (11 - $i);
	  		}
    // $r2 será o resto da soma do cpf mais $d1 vezes 2
    // dividido por 11
	  		$r2 = ($d2 + ($d1 * 2)) % 11;
    // se $r2 mair que 1 retorna 11 menos $r2 se não
    // retorna o valor zeroa para $d2
	  		$d2 = ($r2 > 1) ? (11 - $r2) : 0;
    // retona true se os dois últimos dígitos do cpf
    // forem igual a concatenação de $d1 e $d2 e se não
    // deve retornar false.
	  		return (substr($cpf,-2)==$d1.$d2)?1:0;
	  	}
	  }

	/**************************************************
	** 			       MARCA D'AGUA           		***
	**	*****************************************	***
	**				CHAMAR A FUNÇÃO					***
	**	*****************************************	***
	**												***		
	**	if(!empty($_FILES)){						***
	**												***
	** $Foto_Tmp = $_FILES["Foto"]["tmp_name"];		***
	** $Foto_Nome = $_FILES["Foto"]["name"];		***
	**												***
	** $Criar_Img = new Util();						***
	** $Criar_Img->Dados_Img($Foto_Tmp,$Foto_Nome); ***
	**												***
	**	}											***
	***************************************************	
	public function Dados_Img($Pict_Tmp, $Nome_Img){
		
		if(!function_exists("ImageCreateTrueColor")) // GD versão 2.*
		{
			if(!function_exists("ImageCreate")) // GD versão 1.*
			{
				echo "Você não possui a biblioteca GD carregada no PHP!";
				exit;
			}
		}
		//$Foto_Convertida = explode(".", $Pict_Name);
		//$Foto_Convertida = $Foto_Convertida[0].".jpg";
		$Foto_Convertida = $Nome_Img;
		
		copy($Pict_Tmp, "fotop/".$Foto_Convertida);
		copy($Pict_Tmp, "fotom/".$Foto_Convertida);
		copy($Pict_Tmp, "fotog/".$Foto_Convertida);
		copy($Pict_Tmp, "fotogg/".$Foto_Convertida);		

		$Transparencia="10";
		
		$Foto_P  = "fotop/$Foto_Convertida";
		$Foto_M  = "fotom/$Foto_Convertida";
		$Foto_G  = "fotog/$Foto_Convertida";
		$Foto_GG = "fotogg/$Foto_Convertida";

		$Largura_P = 30;
		$Altura_P = 30;

		$Largura_M = 128;
		$Altura_M = 128;
		
		$Largura_G = 400;
		$Altura_G = 400;

		$Largura_GG = 1280;
		$Altura_GG = 1024;

		$Marca_P = "images/MarcaDaqua/M_p.jpg";
		$Marca_M = "images/MarcaDaqua/M_m.jpg";
		$Marca_G = "images/MarcaDaqua/M_g.jpg";
		$Marca_GG = "images/MarcaDaqua/M_gg.jpg";
		
		self::Gravar_Img($Foto_P,$Largura_P,$Altura_P, $Marca_P, $Transparencia);
		self::Gravar_Img($Foto_M,$Largura_M,$Altura_M, $Marca_M, $Transparencia); 
		self::Gravar_Img($Foto_G,$Largura_G,$Altura_G, $Marca_G, $Transparencia);	
		self::Gravar_Img($Foto_GG,$Largura_GG,$Altura_GG, $Marca_GG, $Transparencia);	

	}

	public function Gravar_Img($Img,$x,$y,$Marc,$trans){
		$posicao = 0;
		//$imagem_gerada = explode(".", $Img);
		//$imagem_gerada = $imagem_gerada[0].".jpg";
		$imagem_orig = ImageCreateFromJPEG($Img);
		$pontoX = ImagesX($imagem_orig);
		$pontoY = ImagesY($imagem_orig);
		$imagem_fin = ImageCreateTrueColor($x,$y);
		ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $x+1, $y+1, $pontoX, $pontoY);
		ImageJPEG($imagem_fin, $Img, 100);
		self::gera($Img, $Marc, $Img, $posicao, $trans);
	}
	
	public function gera($imagemfonte, $marcadagua, $imagemdestino, $pos, $Transp)
	{
		$funcao = $verifica_tipo($marcadagua, "abrir");
		$marcadagua_id = $funcao($marcadagua);
		$funcao = $verifica_tipo($imagemfonte, "abrir");
		$imagemfonte_id = $funcao($imagemfonte);
		$imagemfonte_data = getimagesize($imagemfonte);
		$marcadagua_data = getimagesize($marcadagua);
		$imagemfonte_largura = $imagemfonte_data[0];
		$imagemfonte_altura = $imagemfonte_data[1];
		$marcadagua_largura = $marcadagua_data[0];
		$marcadagua_altura = $marcadagua_data[1];
		$dest_x = ( $imagemfonte_largura) - ( $marcadagua_largura);
		$dest_y = ( $imagemfonte_altura) - ( $marcadagua_altura);
		imageCopyMerge($imagemfonte_id, $marcadagua_id, $dest_x, $dest_y, 0, 0, $marcadagua_largura, $marcadagua_altura, $Transp);
	
		$funcao = $verifica_tipo($imagemdestino, "salvar");
		$funcao($imagemfonte_id, $imagemdestino, 100);
				
	}

	public function verifica_tipo($nome, $acao)
	{
		if(preg_match("/(jpeg|jpg)/i", $nome))
		{
			if($acao == "abrir")
			{
				return "imageCreateFromJPEG";
			}
			else
			{
				return "imagejpeg";
			}
		}
		elseif(preg_match("/(png)/i", $nome))
		{
			if($acao == "abrir")
			{
				return "imageCreateFromPNG";
			}
			else
			{
				return "imagepng";
			}
		}
		else
		{
			echo "Formato de Imagem Inválido!<br>A imagem deve ser JPG!";
			echo "$nome";
			die;
		}
	}

	*/
	public static function calc_idade($data_nasc){//21-09-1983 nesse formato

		$data_nasc = explode("-", $data_nasc);
		$data=date("d/m/Y");
		$data=explode("/",$data);
		$anos=$data[2]-$data_nasc[2];
		if ($data_nasc[1] > $data[1]) {
			return $anos-1;
		} if ($data_nasc[1] == $data[1]) {
			if ($data_nasc[0] <= $data[0]) {
				return $anos;
				// break;
			} else {
				return $anos-1;
				// break;
			}
		} if ($data_nasc[1] < $data[1]) {
			return $anos;
		}
		
	} 

	
	  /********************************************************
	  ***			Valor por extenso		  				***
	  ***													***	  
	  ***	$ObjValor = new Util();               			***
	  ***	$dim = $ObjValor->extenso("5689");    			***
	  ***	$dim = str_replace(" E "," e ",ucwords($dim));  ***
	  ***													***
	  ********************************************************/		
	  public static function extenso($valor = 0, $maiusculas = false) { 

	  	$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"); 
	  	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", 
	  		"quatrilhões"); 

	  	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos", 
	  		"quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"); 
	  	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", 
	  		"sessenta", "setenta", "oitenta", "noventa"); 
	  	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", 
	  		"dezesseis", "dezesete", "dezoito", "dezenove"); 
	  	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis", 
	  		"sete", "oito", "nove"); 

	  	$z = 0; 
	  	$rt = "";

	  	$valor = number_format($valor, 2, ".", "."); 
	  	$inteiro = explode(".", $valor); 
	  	for($i=0;$i<count($inteiro);$i++) 
	  		for($ii=strlen($inteiro[$i]);$ii<3;$ii++) 
	  			$inteiro[$i] = "0".$inteiro[$i]; 

	  		$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2); 
	  		for ($i=0;$i<count($inteiro);$i++) { 
	  			$valor = $inteiro[$i]; 
	  			$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]]; 
	  			$rd = ($valor[1] < 2) ? "" : $d[$valor[1]]; 
	  			$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : ""; 

	  			$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && 
	  				$ru) ? " e " : "").$ru; 
	  			$t = count($inteiro)-1-$i; 
	  			$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : ""; 
	  			if ($valor == "000")$z++; elseif ($z > 0) $z--; 
	  			if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t]; 
	  			if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && 
	  				($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r; 
	  		} 
	  	if(!$maiusculas){ 
	  		return($rt ? $rt : "zero"); 
	  	} else { 
	  		if ($rt) $rt=strtolower($rt);
	  		return (($rt) ? ($rt) : "Zero"); 
	  	} 

	  } 
	  /******************************************
	  ***			DATA PT-BR  			  ***
	  *******************************************/		
	  public static function Data_Atual($Cid){
	  	$dia = date('d');
	  	$mes = date('m');
	  	$ano = date('Y');
	  	$semana = date('w');
	  	$cidade = $Cid;
	  	switch ($mes){
	  		case 1: $mes = "Janeiro"; break;
	  		case 2: $mes = "Fevereiro"; break;
	  		case 3: $mes = "Março"; break;
	  		case 4: $mes = "Abril"; break;
	  		case 5: $mes = "Maio"; break;
	  		case 6: $mes = "Junho"; break;
	  		case 7: $mes = "Julho"; break;
	  		case 8: $mes = "Agosto"; break;
	  		case 9: $mes = "Setembro"; break;
	  		case 10: $mes = "Outubro"; break;
	  		case 11: $mes = "Novembro"; break;
	  		case 12: $mes = "Dezembro"; break;
	  	}
	  	switch ($semana){
	  		case 0: $semana = "Domingo"; break;
	  		case 1: $semana = "Segunda Feira"; break;
	  		case 2: $semana = "Ter&ccedil;a Feira"; break;
	  		case 3: $semana = "Quarta Feira"; break;
	  		case 4: $semana = "Quinta Feira"; break;
	  		case 5: $semana = "Sexta Feira"; break;
	  		case 6: $semana = "S&aacute;bado"; break;
	  	}
	  	return $cidade.", ".$semana.", ".$dia." de ".$mes." de ".$ano;
	  }

##################################################################Caululo por Frete#########################################################################								
##	define("PAC", "41106");sem contrato
##	define("SEDEX","40010");sem contrato
##	define("SEDEX_COBRAR","40045");sem contrato
##	define("SEDEX10","40215");sem contrato
/*				
public function calculaFrete($cod_servico,$cep_origem,$cep_destino,$peso,$retorno,$altura='2',$largura='11',$comprimento='16',$valor_declarado='0.50')
{
$correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";
	$xml = simplexml_load_file($correios);
	if($xml->cServico->Erro == '0'){
		return $xml->cServico->$retorno;
		//$xml->cServico->PrazoEntrega;
	}else{
		return false;
	}
  }//Chamar o codigo: echo "<br><Br>Cálculo de FRETE PAC: ". calculaFrete(PAC,'71710030','96825150','0.5')."<br>";
}//FECHA A CLASSE

*/
public static function limitarTexto($texto, $limite = 400){

			// substr(urldecode($texto), 0, $limite);
	$texto 			= strip_tags( $texto );
	$texto 			= urldecode( $texto );
	$contador 		= mb_strlen( $texto );
	if ( $contador >= $limite ) {
		$texto 		= mb_substr($texto, 0, mb_strrpos(mb_substr($texto, 0, $limite), ' '), 'UTF-8') . '...';
		return $texto;
	}
	else{
		return $texto;
	}
}
}
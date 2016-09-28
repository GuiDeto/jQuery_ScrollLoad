<?php

class abrirUrl{
	public static function trocarURL($url){
		if(empty($url)){
			$url = include_once"posts.php";
		}else{

			if (file_exists( $url.".php" )) {

				include_once( $url.".php" );
				
			} else {

				echo "A página $url não encontrada!";

			}
		}
	}
}

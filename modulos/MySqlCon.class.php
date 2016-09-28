<?php

define("HOST", "localhost");
define("USR", "root");
define("PWD", "");
define("DB", "teste");

class MySqlCon{

    protected static $hostname = HOST, $username = USR, $password = PWD , $database = DB, $connect, $status;

    private static function setStatus( $status ){
        self::$status = $status;
    }

    public static function getStatus(){
        return self::$status;
    }

    public static function connect(){
        try {
            self::$connect = mysqli_connect( self::$hostname, self::$username, self::$password, self::$database );
            mysqli_set_charset(self::$connect,"utf8");
            return self::$connect;
        } catch (Exception $e) {
            echo "Erro ao tentar se conectar: " . $e();
        }
    }

    public static function fetch($sql){
        $qryftc         = self::query( $sql );  
        
        if ( $qryftc ) {
            return (object)mysqli_fetch_assoc($qryftc);
        } else {
            return null;
        }
    }
    
    public static function fetchAll($sql){
        $qryftc         = self::query($sql);
        $i              = 0;
        $retornar       = array();
        if ( sizeof( $qryftc ) > 0 ) {
            while($linha = mysqli_fetch_assoc($qryftc)){
                foreach($linha as $key => $val){
                    $retornar[$i][$key] = $val;
                }
                $i++;
            }
        }
        return (object)$retornar;
    }

    public static function insert($fields, $tabela)
    {
        if( sizeof($fields) > 0 ){
            $campos     = '';
            $valor      = '';
            foreach($fields as $chave => $valores){
                $campos .= "`".$chave."`,";
                $valor  .= "'".$valores."',"; 
            }
            $x          = "INSERT INTO $tabela (".substr($campos, 0,-1).") VALUES (".substr($valor, 0,-1).");";
            return self::query( $x );
        }else{
            return "Preencha corretamente os campos!";
        }
    }

    public static function update($fields, $tabela, $idTabela, $cdgUpdate)
    {
        if( sizeof($fields) > 0 ){
            $atualiza     = '';
            foreach($fields as $chave => $valores){
                $atualiza .= "`".$chave."` = '$valores',";
            }
            $x          = "UPDATE $tabela SET ".substr($atualiza, 0,-1)." WHERE $idTabela = '$cdgUpdate';";
            return self::query($x);
        // echo        "<pre><code>$x</code></pre>";
        }else{
            return "Preencha corretamente os campos!";
        }
    }

    public static function teste( $fields, $tabela=NULL, $idTabUp=NULL, $cdgUp=NULL ){
        if( $cdgUp != null ){
            foreach($fields as $chave => $valores){
                $atualiza .= "`<b style='color:#4F94CD'>".$chave."</b>` = '$valores',";
            }
            $x   = "<b style='color:#00f'>UPDATE</b> <b style='color:#008B00'>$tabela</b> <b style='color:#00f'>SET</b> ".substr($atualiza, 0,-1)." <b style='color:#00f'>WHERE</b> <b style='color:#4F94CD'>$idTabUp</b> = '<b style='color:#B8860B'>$cdgUp</b>';";

            echo "<pre><code>$x</code></pre>";
        }else{
            if( is_array($fields) ){
                if( sizeof($fields) > 0 ){
                    $campos      = '';
                    $valor       = '';
                    foreach($fields as $chave => $valores){
                        $campos .= "`<b>".$chave."</b>`,";
                        $valor  .= "'".$valores."',"; 
                    }
                    $x   = "<b style='color:#00f'>INSERT</b> INTO <b style='color:#00f'>$tabela</b> (".substr($campos, 0,-1).") <b style='color:#00f'>VALUES</b> (".substr($valor, 0,-1).");";
                    echo "<pre><code>$x</code></pre>";
                }else{
                    echo "Preencha corretamente os campos!";
                }
            }else{
                $x   = $fields;
                echo "<pre><code>$x</code></pre>";
            }
        }
    }

    public static function query($query){
        $execSQL    = mysqli_query( self::connect(), $query );
        $Resp       = ($execSQL)?1:0;

        self::setStatus( $Resp );

        return $execSQL;
        

        mysqli_free_result($execSQL);
        self::disconnect();
    }

    public static function PegarCampo($SqlGet){
        $PegarLinha = self::query($SqlGet);
        return mysqli_fetch_assoc($PegarLinha);
    }

    public static function rows($query){
        $rowsQr = self::query($query);
        $Trows = @mysqli_num_rows($rowsQr);
        return ($Trows)? $Trows : "0" ;
    }

    public static function disconnect(){
        mysqli_close(self::$connect);
        return $this;
    }
}
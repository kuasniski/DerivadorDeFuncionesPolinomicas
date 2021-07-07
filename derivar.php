<?php
$funcion = $_POST['funcion'];
session_start();
if($funcion != ''){
    $funcionArray = recolectarDatos($funcion);
    $Variable = getVariable($funcionArray);
    $derivada = derivar($funcionArray);
    $resultado = renderizarFuncion($derivada,$Variable);
    $_SESSION['derivada']= $resultado;
}else{
    $_SESSION['error'] = "Ningun dato ingresado";
}

function recolectarDatos($funcion){
    $j = 0;
    $primerValor = true;
    $elevadoAlaN = false;
    $funcionArray = array();
    for($i = 0;$i <= strlen($funcion)-1;$i++){
        
        if(esNumerico($funcion[$i])){
            if($primerValor){
                $funcionArray[$j]['numero'] = $funcion[$i];
                $primerValor = false;
            }elseif(!$elevadoAlaN){
                $funcionArray[$j]['numero'] = $funcionArray[$j]['numero'].$funcion[$i];
            }
            if($elevadoAlaN){
                $funcionArray[$j]['potencia'] = $funcion[$i];
                $elevadoAlaN = false;
            }
        }else{
            if(esVariable($funcion[$i])){
                $funcionArray[$j]['variable'] = $funcion[$i];
                $Variable = $funcion[$i];
            }else{
                if(esNegativo($funcion[$i]) || esPositivo($funcion[$i])){
                    if($primerValor){
                        $funcionArray[$j]['numero'] = $funcion[$i];
                        $primerValor = false;
                    }else{
                        $j++;
                        $funcionArray[$j]['numero'] = $funcion[$i];
                    }
                }
                $siEsPotencia = esPotencia($funcion[$i]);
                if($siEsPotencia == '^'){
                    $elevadoAlaN = true;
                    $primerValor = false;
                    continue;
                }else{
                    $funcionArray[$j]['potencia'] = $siEsPotencia; 
                }
            }
            
        }
    }
    
    return $funcionArray;
}
function getVariable($funcion){
    return $funcion[0]['variable'];
}
function derivar($funcion){
    for($i = 0; $i <= count($funcion)-1;$i++){
        if(isset($funcion[$i]['numero'])){
            if($funcion[$i]['numero'] == '-'){
                $funcion[$i]['numero'] = -1;
            }
        }else{
            $funcion[$i]['numero'] = 1;
        }
        if(!isset($funcion[$i]['variable'])){
            $funcion[$i]['numero']='';
        }
        if( isset($funcion[$i]['potencia']) && $funcion[$i]['potencia']){
            $funcion[$i]['numero'] = intval($funcion[$i]['numero']) * intval($funcion[$i]['potencia']);
            $funcion[$i]['potencia'] = $funcion[$i]['potencia'] - 1;
        }else{
            $funcion[$i]['potencia']=0;
        }
        
        if($funcion[$i]['potencia'] <= 0){
            $funcion[$i]['variable'] = '';
        }
        if($funcion[$i]['potencia'] <= 1){
            $funcion[$i]['potencia']= '';
        }
    }
    
    return $funcion;
}
function renderizarFuncion($funcion,$variable){
    $resultado = "ƒ'(".$variable.") = ";
    $primerValor = true;
    for($i=0;$i <= count($funcion)-1; $i++){
        if(gettype($funcion[$i]['numero']) != 'string' && abs($funcion[$i]['numero'])/$funcion[$i]['numero'] != -1){
            if(!$primerValor){
                $resultado .= '+';
            } 
        }
        $resultado .= $funcion[$i]['numero'].$funcion[$i]['variable'];
        if($funcion[$i]['potencia'] != ''){
            $resultado .= '^'.$funcion[$i]['potencia'];  
        }
        $primerValor = false;
    }
    return $resultado;
}
function esNumerico($valor){
    $res = is_numeric($valor);
    return $res;
} 

function esVariable($valor){
    $res = false;
    
    for($i = 97; $i <= 122; $i++){
        if($valor == chr($i)){
            $res = true;
            break;
        }
    }
    for($i = 65; $i <= 90; $i++){
        if($valor == chr($i)){
            $res = true;
            break;
        }
    }

    return $res;
}
function esNegativo($valor){
    $res = false;
    if($valor == chr(45)){
        $res = true;
    }
    return $res;
}

function esPositivo($valor){
    $res = false;
    if($valor == chr(43)){
        $res = true;
    }
    return $res; 
}

function esPotencia($valor){
    $res = false;
    if(ord($valor) == 194){
        $res = 2;
    }elseif($valor == chr(252)){
        $res = 3;
    }elseif($valor == chr(94)){
        $res = chr(94);
    }
    switch(ord($valor)){
        case 253:
            $res = true;
            break;
        case 252:
            $res = 3;
            break;
        case 94:
            $res = chr(94);
            break; 
    }
    return $res;
}

header("Location: index.php");
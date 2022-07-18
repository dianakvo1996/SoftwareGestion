<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InformacionExtra
 *
 * @author BIOMETRICAL
 */

require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class InformacionExtra {
    private $ide;
    private $ideTipoEquipo;
    private $recomendacionesFabricante;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))$this->cargarAtributos($campo);
            else {
            $cadenaSQL="select * from informacionExtra where $campo=$valor";
            $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
            if (count($resultado)>0)$this->cargarAtributos($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideTipoEquipo=$datos['idetipoequipo'];
        $this->recomendacionesFabricante=$datos['recomendacionesfabricante'];
    }
    
    function getIde() {
        return $this->ide;
    }

    function getIdeTipoEquipo() {
        return $this->ideTipoEquipo;
    }

    function getRecomendacionesFabricante() {
        return $this->recomendacionesFabricante;
    }

    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeTipoEquipo($ideTipoEquipo) {
        $this->ideTipoEquipo = $ideTipoEquipo;
    }

    function setRecomendacionesFabricante($recomendacionesFabricante) {
        $this->recomendacionesFabricante = $recomendacionesFabricante;
    }

    function adicionar() {
        $cadenaSQL="insert into informacionExtra(ideTipoEquipo, recomendacionesFabricante)values({$this->ideTipoEquipo},'{$this->recomendacionesFabricante}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    function modificar() {
        $cadenaSQL="update informacionExtra set recomendacionesFabricante='{$this->recomendacionesFabricante}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    

    function eliminar() {
        $cadenaSQL="delete from informacionExtra where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro, $orden) {
        $cadenaSQL="select * from informacionExtra ";
        if ($filtro!=null)$cadenaSQL.=" where $filtro";
        if ($orden!=null)$cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);        
    }
    
    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= InformacionExtra::getDatos($filtro, $orden);
        $lista=array();
        for ($j = 0; $j < count($datos); $j++) {
            $informacion=new InformacionExtra($datos[$j],null);
            $lista[$j]=$informacion;
        }
        return $lista;
    }
    
	function getRecomendacionesFabricanteListaOrdenada() {
		$recomendaciones=explode('-', $this->recomendacionesFabricante);
		$lista="<p>";
		$item=1;
		for ($i = 1; $i< count($recomendaciones); $i++) {
            $lista.='<strong>'.$item.'.</strong> '.$recomendaciones[$i].'<br>';
            $item++;
        }
        return $lista.'</p>';
    }

    function getRecomendacionMostrar() {
        $recomendacion1= explode('-', $this->recomendacionesFabricante);
        $item=1;
        $recomendaciones='<p>';
        for ($i = 1; $i< count($recomendacion1); $i++) {
            $recomendaciones.='<strong>'.$item.'.</strong> '.$recomendacion1[$i].'</br>';
            $item++;
        }
        return $recomendaciones.'</p>';
    }


    public static function RecomendacionEnRadio($ideTipoEquipo) {
        $recomendaciones = InformacionExtra::getDatosEnObjetos('ideTipoEquipo='.$ideTipoEquipo, 'ide');
        $lista='';
        for ($i = 0; $i < count($recomendaciones); $i++) {
            $recomendacion=$recomendaciones[$i];
            $lista.="<input type='radio' value='{$recomendacion->getIde()}' name='ideRecomendacion' id='{$recomendacion->getIde()}'><label for='{$recomendacion->getIde()}'>{$recomendacion->getRecomendacionMostrar()}</label>";
        }
        return $lista;
    } 

}

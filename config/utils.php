<?php

class Utils
{

   public static function formatDate($date){

    if($date==null){
      return new Date();
    }else{
      $porciones = explode("/", $date);

      return $porciones[2]."-".$porciones[1]."-".$porciones[0];
    }

  }

  public static function validateValue($value){

    if($value !='' && $value!=null){

      return true;

    }else{
      return false;
    }

  }

}

?>

<?php

class Tools{
  public static function startsWith($string, $startString){
    $len = strlen($startString);
    return (substr($string,0,$len) === $startString);
  }
}
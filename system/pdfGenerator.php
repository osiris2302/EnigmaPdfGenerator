<?php

require_once 'tools.php';
require_once 'configs/formats.php';
require_once 'configs/orientations.php';
require_once 'vendor/autoload.php';

class pdfGenerator{
 #region properties
   /**
   * contains the instance created by the library used with composer
   *
   * @var class
   */
  protected $pdfInstance = null;

  /**
   * contains the current string to be displayed in the pdf, contains mostly html
   *
   * @var string
   */
  protected $currentDisplayString = null;

#endregion

#region Constructor

/**
 * constructor
 *
 * @param string $format
 * @param string $orientation
 */
 public function __construct(array $configs = null){
   if(!is_null($configs)){
     $this->createInstance($configs);
   }else{
     $this->createInstance();
   }
 }
#endregion

#region public methods
 public function display(){
   var_dump($this->configs);
 }

 #region Setters
 /**
  * set a single config
  *
  * @param string $configKey
  * @param string $configValue
  * @return void
  */
 public function setSingleConfig(string $configKey, string $configValue){
   $this->configs[$configKey] = $configValue;
 }

 /**
  * set the pdf instance created by the library
  *
  * @param object $instance
  * @return void
  */
 public function setInstance($instance){
   $this->pdfInstance = $instance;
 }

 /**
  * set the display string
  *
  * @param string $displayString
  * @return void
  */
 public function setDisplayString(string $displayString){
   empty($displayString) ? $this->currentDisplayString = $displayString : null;
 }
 #endregion

 #region Getters

 /**
  * returns the value of a specific config
  *
  * @param string $configKey
  * @return void
  */
 public function getSingleConfig(string $configKey){
   return $this->configs[$configKey];
 }

 /**
  * return the current instance of the pdf library
  *
  * @return void
  */
 public function getInstance(){
   return $this->pdfInstance;
 }

 /**
  * returns the current display string
  *
  * @return void
  */
 public function getDisplayString(){
   return $this->currentDisplayString;
 }

 /**
  * output the pdf file to the browser
  *
  * @return void
  */
 public function outputFileToBrowser(){
   return $this->pdfInstance->Output();
 }
 #endregion

 public function createHtml(string $displayString = ""){
  if(!empty($displayString)){
    $this->pdfInstance->writeHTML($displayString);
    $this->currentDisplayString = $displayString;
   }
}

 #endregion

 #region protected functions
 /**
  * grabs the custom constants defined in the global array
  *
  * @return array
  *
  * Note: Not usable, was a good experiment tho.
  */
/*  protected function getCustomConstants(){
   $tempUserConstants = get_defined_constants(true);
   $returnVal = [];

   if(isset($tempUserConstants['user'])){
     $tArray = [];
     foreach($tempUserConstants['user'] as $k => $v){
       if(Tools::startsWith($k,'pdf_')){
         $tArray[substr($k,4)] = $v;
       }
     }
     $returnVal = $tArray;
   }
   return $returnVal;
 } */

 /**
  * create the pdf instance and assign it to the property
  *
  * @return void
  */
 protected function createInstance($configs = null){

  if(!is_null($configs)){
    $i = new \Mpdf\Mpdf($configs);
  }else{
    $i = new \Mpdf\Mpdf();
  }
   $this->setInstance($i);
 }
 #endregion
}
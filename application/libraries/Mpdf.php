<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
include_once APPPATH.'/third_party/mpdf/vendor/autoload.php';
 
class Mpdf {
    public function __construct()
    {
		
        $this->pdf = new \Mpdf\Mpdf();
    }
}
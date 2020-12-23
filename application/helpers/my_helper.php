<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('maskrupiah')){
   function maskrupiah($number){
        $hasil_rupiah = "Rp " . number_format($number,2,',','.');
        return $hasil_rupiah;
       }
   }   

?>
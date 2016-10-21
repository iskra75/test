<?php
class Analyse_addr {
    public $class_id;
    public function __construct($uri) {
        $adresa = explode ('/', $uri);
        $kil_el_adr = count ($adresa) - 1;
        $adr_bez_zap = explode('?', $adresa[$kil_el_adr]);
        if (isset($adresa[$kil_el_adr]) && $adresa[$kil_el_adr] != '') {

            $this->class_id = $adr_bez_zap[0];
        }
        else {
						 $this->class_id = 'index';
				}
				
    }
}
?>
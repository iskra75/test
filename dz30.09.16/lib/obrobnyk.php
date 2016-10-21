<?php

class Obrobnyk {
    static $uri;
    public $class_id;
    public $data_file;
    public $dani;
    public $html_file;
    public function __construct($uri) {
        Obrobnyk::$uri = $uri;
    }
    public function analyse_adr() {
        $nov_analyse = new Analyse_addr(Obrobnyk::$uri);
        $this->class_id = $nov_analyse->class_id;
    }
    public function data_file() {
        $nov_data_file = new Data_file($this->class_id);
				$this->data_file = $nov_data_file->data_file;
		}
    public function dani() {
        $nov_dani = new Dani($this->data_file);
        $this->dani = $nov_dani->dani;
    }
		public function vnesty_rah() {
				$nov_vnes_rah = new Vnesty_rah($_GET, $this->dani, $this->data_file);
				}
    public function html_file() {
        $nov_html_file = new Html_file($this->class_id);
				$this->html_file = $nov_html_file->html_file;
    }

    public function vyvid() {
        $nov_vyvid = new Vyvid($this->dani, $this->html_file);
    }
		
}

?>
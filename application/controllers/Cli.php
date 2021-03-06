<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ob_start();

class Cli extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
    }

    public function index($string = 'World') {
        echo $this->stringToUpperCase($string)."\n";
        echo $this->stringToAlternateCase($string)."\n";
        $this->export_csv($string);
        echo "CSV created!";
    }

    public function stringToUpperCase($string) {
        return strtoupper($string);
    }

    public function stringToAlternateCase($string) {
        return $this->altCaps($string);
    }

    public function test() {
        $string = 'hello world';
        $unitTest_1 = $this->stringToUpperCase($string);
        $unitTest_2 = $this->stringToAlternateCase($string);
        echo $this->unit->run($unitTest_1, 'HELLO WORLD', 'Upper Case');
        echo $this->unit->run($unitTest_2, 'hElLo WoRlD', 'Alternate Case');
    }

    public function altCaps($str) {
        $letter_count = 0;
        $result = '';
        for ($i=0; $i<strlen($str); $i++) {
            if (!preg_match('![a-zA-Z]!', $str[$i])) {
                $result .= $str[$i];
            } else if ($letter_count++ & 1) {
                $result .= strtoupper($str[$i]);
            } else {
                $result .= $str[$i];
            }
        }
        return $result;
    }

    public function export_csv($string) {
        $fp = fopen('file.csv', 'w');
        $arrayOfChars = array(str_split($string));
        foreach ($arrayOfChars as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
    }
}

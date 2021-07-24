<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ob_start();

class Cli extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($string = 'World')
        {
            echo strtoupper($string);
            echo '<br/>';
            echo $this->altCaps($string);

            $this->export_csv();
        }

    public function altCaps($str)
        {
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

        public function export_csv()
        {
            $this->load->helper('csv');
            $export_arr = array();
            $employee_details[] = array('f_name'=> "Nishit", 'l_name'=> "patel", 'mobile'=> "999999999", 'gender'=> "male");

            
            $title = array("Id", "Name", "Email", "Phone", "Created at");
            array_push($export_arr, $title);
            if (!empty($employee_details)) {
                foreach ($employee_details as $employee) {
                    array_push($export_arr, $employee);
                }
            }
            convert_to_csv($export_arr, 'output-' . date('F d Y') . '.csv', ',');
        }
}

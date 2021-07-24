<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['cli/test'] = 'Cli/test';
$route['cli/(:any)'] = 'Cli/index/$1';

// default routing settings by codeigniter
$route['default_controller'] = 'Cli/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

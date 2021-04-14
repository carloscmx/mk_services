<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Vpn_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
    require('API_MK/routeros_api.class.php');
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function create_vpn($usuario, $password)
  {
    $API = new RouterosAPI();

    if ($API->connect('149.56.78.236', 'vpn', 'BlazarVPN2021*', 8728)) {

      $API->write('/ppp/secret/add', false);
      $API->write('=name=' . $usuario . '', false);
      $API->write('=password=' . $password . '', true);
      //$API->write('=profile=default-encription', false);
      //$API->write('=disabled=no', true);

      $READ = $API->read(false);
      $arr_response = $API->parseResponse($READ);

      $API->disconnect();
      return TRUE;
    } else {
      return FALSE;
    }
  }

  // ------------------------------------------------------------------------

}

/* End of file Vpn_model.php */
/* Location: ./application/models/Vpn_model.php */
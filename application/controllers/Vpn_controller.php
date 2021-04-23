<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vpn_controller extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('jseguridad_helper');
    $this->load->model('Vpn_model', 'vpn');
  }

  public function index()
  {
    $data['token']  = $this->vpn->tokenCode();


    $this->load->view('template/Head_view');
    $this->load->view('template/Navbar_view');
    $this->load->view('apps_pages/welcome_message',$data);
    $this->load->view('template/Footer_view');
  }

  public function insert_vpn()
  {
    if ($this->input->is_ajax_request()) {

      $this->load->library('form_validation');

      $rules = [
        [
          'field' => 'usuario',
          'label' => 'Nombre De Usuario',
          'rules' => 'required|callback_unique_vpn',
          'errors' => [
            'required' => '%s requerido',
          ]
        ],
        [
          'field' => 'password',
          'label' => 'Contraseña',
          'rules' => 'required',
          'errors' => [
            'required' => '%s requerido'
          ]
        ]

      ];

      $this->form_validation->set_rules($rules);

      if ($this->form_validation->run()) {
        $usuario = $this->input->post('usuario', TRUE);
        $password = $this->input->post('password', TRUE);

        if ($this->vpn->create_vpn($usuario, $password)) {
          $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode(['message' => 'vpn creada']));
        } else {
          $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode(['message' => 'error interno']));
        }
      } else {
        $usError = (empty(form_error('usuario'))) ? '' : form_error('usuario');
        $passwdError = (empty(form_error('password'))) ? '' : form_error('password');

        $html = '
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <strong>Complete los campos!</strong> ' . $usError . '' . $passwdError . '.
          </div>
        ';
        $this->output->set_status_header(400)->set_content_type('application/json')->set_output(json_encode(['html' => $html]));
      }
    } else {
      $this->output->set_status_header(404);
    }
  }

  public function unique_vpn($str)
  {
    if ($this->vpn->getVPNbyName($str)) {
      $this->form_validation->set_message('unique_vpn', 'El nombre {field} ya esta en uso en otra VPN');
      return false;
    } else {
      return true;
    }
  }
}


/* End of file Vpn_controller.php */
/* Location: ./application/controllers/Vpn_controller.php */
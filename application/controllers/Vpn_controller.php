<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vpn_controller extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view('welcome_message');
  }

  public function insert_vpn()
  {
    $this->load->model('Vpn_model');
    $this->load->library('form_validation');

    $rules = [
      [
        'field' => 'usuario',
        'label' => 'Usuario',
        'rules' => 'required'
      ],
      [
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => 'required'
      ]

    ];

    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run()) {
      $usuario = $this->input->post('usuario', TRUE);
      $password = $this->input->post('password', TRUE);

      if ($this->Vpn_model->create_vpn($usuario, $password)) {
        $this->output->set_status_header(200)->set_content_type('application/json')->set_output('vpn creada');
      } else {
        $this->output->set_status_header(500)->set_content_type('application/json')->set_output('error interno');
      }
    } else {
      $errores = [
        'error_us' => form_error('usuario'),
        'error_pass' => form_error('password')
      ];
      $this->output->set_status_header(400)->set_content_type('application/json')->set_output(json_encode($errores));
    }
  }
}


/* End of file Vpn_controller.php */
/* Location: ./application/controllers/Vpn_controller.php */
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function insert_vpn()
	{
		$this->load->model('vpn_model');
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

			if ($this->vpn_model->create_vpn($usuario, $password)) {
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

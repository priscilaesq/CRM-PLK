<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function index() {
		$this->load->view('index');
	}

	function ver_empleado ($id){
		$data['id'] = $id;
		$this->load->model('Principal_model');
		$data['usuario']  = $this->Principal_model->get_usuario($id);
		
	}

	function maqueta($vista) {
		$data['vista'] = $vista;
		$this->load->view('estructura/templete', $data);
	}
	
	function login() {
		$this->load->model('Principal_model');
		if($_POST != NULL) {
			// VALIDACION 
			$data['usuario'] = $usuario = $this->Principal_model->get_usuario($id);
			$tipo = $usuario[0]->tipo;

			// GUARDAR SESION
			if($tipo == 'admin'){
				redirect('./administrador/');
			}
			else if($tipo == 'vendedor') {
				redirect('./vendedor/');
			}
			else if($tipo == 'cliente') { 
				redirect('./cliente/');
			}
		}
		
		$data['vista'] = 'login';
		$this->load->view('estructura/templete', $data);
	}
}

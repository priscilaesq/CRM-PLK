<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedor extends CI_Controller {

	public function index() {
		$data['vista'] = 'dashboard';
		$this->load->view('estructura/templete', $data);
	}

	function ver_empleado ($id){
		$data['id'] = $id;
		$this->load->model('Principal_model');
		$data['usuario']  = $this->Principal_model->get_usuario($id);
		$this->load->view('ver_empleado', $data);
	}
 

}

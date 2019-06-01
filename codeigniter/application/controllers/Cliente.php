<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function index() {
		$this->load->view('index');
		if($_SESSION['tipo'] != 'admin') redirect('./');

		//MOSTRAR DASHBOARD DE ADMIN
	}

	function ver_empleado ($id){
		$data['id'] = $id;
		$this->load->model('Principal_model');
		$data['usuario']  = $this->Principal_model->get_usuario($id);
		$this->load->view('ver_empleado', $data);
	}
 

}

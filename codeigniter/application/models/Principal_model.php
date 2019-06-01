<?php

  class Principal_model extends CI_Model {
    public function __constructor() {
      parent::__construct();
      $this->load->database();
    }

    function get_usuario($id) {
      $args = array(
        'id' => $id
      );
      return $this->db->get_where('usuario', $args)->result();
    }
    
    public function subir_imagen($index, $nombre, $camino) {
      $name = basename($_FILES[$index]["name"]);
      $tipo = strtolower(pathinfo($name,PATHINFO_EXTENSION));
      if (!is_dir($camino)) {
        mkdir($camino);
      }
      $camino = $camino . $nombre . "." . $tipo;
      if ( move_uploaded_file($_FILES[$index]["tmp_name"], $camino ) ) {
        $status['exito'] = true;
        $status['camino'] = $camino;
      }
      else {
        $status['exito'] = false;
      }
      return $status;
    }

    public function update_imagen($tabla,$id,$index) {
      $condiciones = [
        'id' => $id
      ];
      if($_FILES[$index]['tmp_name'] != '') {
        $url = "./imgs/$tabla/$id/";
        $image = subir_imagen($index, $index, $url);
        if($image) {
          $this->db->update($tabla, $index)->where($condiciones);
        }
        else {
          return false;
        }
      }
    }

    public function eliminar_imagenes($url) {
      if(is_dir($url)){
          $files = glob( $url . '*', GLOB_MARK );
          foreach( $files as $file ){
            eliminar_imagenes( $file );
          }
          rmdir( $url );
      } elseif(is_file($url)) {
          unlink( $url );
      }
    }
  }


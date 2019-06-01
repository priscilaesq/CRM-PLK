<?php

  class Principal_model extends CI_Model {
    public function __constructor() {
      parent::__construct();
      $this->load->database();
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

    public function update($tabla, $id, $args) {
      $primero = true;
      $update = '';
      $condiciones = [
        'id' => $id
      ];
      foreach($args as $index => $value) {
        if($primero) {
          $update .= "$index = '$value'";
          $primero = false;
        }
        else {
          $update .= ", $index = '$value'";
        }
      }
      $this->db->update($tabla, $update)->where($condiciones);
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

    public function get($tabla) {
      $result = $this->db->get($tabla);
      $resultados = [];
      $i = 0;
      if ($result->num_rows > 0) :
          while($row = $result->fetch_assoc()) :
            $resultados[$i] = $row;
            $i++;
          endwhile;
      else :
        $resultados = false;
      endif;
      return $resultados;
    }

    public function single($tabla, $id) {
      $condiciones = [
        'id' => $id
      ];
      $result = $this->db->get_where($tabla, $condiciones);
      if ($result->num_rows > 0) :
          while($row = $result->fetch_assoc()) :
            $resultados = $row;
          endwhile;
      else :
        $resultados = false;
      endif;
      return $resultados;
    }

    public function eliminar($tabla, $id) {
      $condiciones = [
        'id' => $id
      ];
      $result = $this->db->delete($tabla)->where($condiciones);
      $path = "./imgs/$tabla/$id/";
      eliminar_imagenes($path);
      return $result;
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


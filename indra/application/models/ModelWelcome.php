<?php
class ModelWelcome extends CI_Model{

    function getver()
    {
      $fecha   =  date("Y-m-d H:i:s");

      $this->db->select('*');
      $this->db->from('prueba1');
      $rest=$this->db->get();

      return $rest->result();
    }

    function getguardar()
    {
        $num1  = $this->input->post('num1');
        $num2  = $this->input->post('num2');
        $resul = $this->input->post('resul');
        $fecha = date("Y-m-d H:i:s");
        
        $multiplicacion = bcmul($num1 , $num2 );

        $data=array(
            'pr_num1'=>$num1,
            'pr_num2'=>$num2,
            'pr_resultado'=>$multiplicacion,
            'pr_fecha'=>$fecha,
        );
                
        $sql_query=$this->db->insert('prueba1',$data);

        return $multiplicacion;
    
    }

    function getlimpiar()
    {
      $fecha   =  date("Y-m-d H:i:s");

     
      $rest=$this->db->truncate('prueba1');

      return $rest;
    }

}
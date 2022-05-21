<?php
class ModelWelcome2 extends CI_Model{

    function getver()
    {
      $fecha   =  date("Y-m-d H:i:s");

      $resultados = $this->db->query('
      SELECT 
        r.READING_DATE AS fecha,
        t.NAME_TYPE AS tipo,
        t.COD_USER AS idusu,
        e.CUSTOMER_NAME AS nomusu,
        e.SURNAME_1 AS apeusu
          FROM gcgt_re_reading r
            INNER JOIN gcgt_re_measurement_point m on m.ID_MEASURING_POINT = r.ID_MEASURING_POINT
            INNER JOIN gccom_sector_supply s on s.ID_SECTOR_SUPPLY  = m.ID_SECTOR_SUPPLY
            INNER JOIN gccom_contracted_service c on c.ID_SECTOR_SUPPLY  = s.ID_SECTOR_SUPPLY
            INNER JOIN gccom_payment_form f on f.ID_PAYMENT_FORM  = c.ID_PAYMENT_FORM 
            INNER JOIN gccd_relationship e on e.ID_RELATIONSHIP  = f.ID_CUSTOMER 
            INNER JOIN gccc_customer_type t on t.COD_DEVELOP   = e.CUSTOMER_TYPE  
            WHERE r.READING_DATE > DATE_SUB((SELECT  MAX(r.READING_DATE) 
                                                      FROM gcgt_re_reading r
                                                        INNER JOIN gcgt_re_measurement_point m on m.ID_MEASURING_POINT = r.ID_MEASURING_POINT
                                                        INNER JOIN gccom_sector_supply s on s.ID_SECTOR_SUPPLY  = m.ID_SECTOR_SUPPLY
                                                        INNER JOIN gccom_contracted_service c on c.ID_SECTOR_SUPPLY  = s.ID_SECTOR_SUPPLY
                                                        INNER JOIN gccom_payment_form f on f.ID_PAYMENT_FORM  = c.ID_PAYMENT_FORM 
                                                        INNER JOIN gccd_relationship e on e.ID_RELATIONSHIP  = f.ID_CUSTOMER 
                                                        INNER JOIN gccc_customer_type t on t.COD_DEVELOP   = e.CUSTOMER_TYPE  
                                                          WHERE t.COD_USER = 2), 
              INTERVAL 3 MONTH) AND t.COD_USER = 2
              ORDER BY r.READING_DATE DESC
      ');
        return $resultados->result();
    }

    function getguardar()
    {
        $num1  = $this->input->post('num1');
        $num2  = $this->input->post('num2');
        $resul = $this->input->post('resul');
        $fecha = date("Y-m-d H:i:s");
        
        $nuevo = $num1 * $num2;
        $data=array(
            'pr_num1'=>$num1,
            'pr_num2'=>$num2,
            'pr_resultado'=>$nuevo,
            'pr_fecha'=>$fecha,
        );
                
        $sql_query=$this->db->insert('prueba1',$data);

        return $sql_query;
    
    }

    function getlimpiar()
    {
      $fecha   =  date("Y-m-d H:i:s");

     
      $rest=$this->db->truncate('prueba1');

      return $rest;
    }

}
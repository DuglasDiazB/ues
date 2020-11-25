<?php

    class FacturacionModel{
        
        private $db;
        public $factura_id;
        public $cliente_id;
        public $Nombre;
        public $total_pagar;
        public $detalle_id;
        
        public $producto_id;
        public $producto;
        public $precio_unitario;
        public $cantidad;

        
        public function __construct(){

            $this->db = new Sql;
        }

        public function getFactura($id){
            $this->db->query("SELECT factura_id, cliente_id, Nombre, total_pagar  FROM facturacion WHERE factura_id = :id");
            $this->db->bind(':id', $id);

            $row  = $this->db->register();

            if ($row) {
                //transformando los valores a entero
                $row->factura_id = (int)$row->factura_id;
                $row->cliente_id = (int)$row->cliente_id;
                $row->total_pagar = (float)$row->total_pagar;
            }

            return $row;
        }

        
        public function getDetalle($id){
            $this->db->query("SELECT *  FROM facturacion_detalle WHERE factura_id = :id");
            $this->db->bind(':id', $id);

            $rows  = $this->db->registers();
            
            for( $i= 0 ; $i < count($rows) ; $i ++ ){

                $rows[$i]->detalle_id      = (int)$rows[$i]->detalle_id;
                $rows[$i]->producto_id     = (int)$rows[$i]->producto_id;
                $rows[$i]->factura_id      = (int)$rows[$i]->factura_id;
                $rows[$i]->cantidad        = (int)$rows[$i]->cantidad;
                $rows[$i]->precio_unitario = (float)$rows[$i]->precio_unitario;
            }
          
            return $rows;
        }
    }

?>
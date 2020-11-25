<?php

class Facturacion extends MainController
{
	
	function __construct()
	{
        $this->facturacionModel = $this->model('FacturacionModel');
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: aplication/json');
    }

    public function factura($id = null){

        if ($id == null) {
            
            $respuesta = array(
                'error' => TRUE,
                'mensaje' => 'No se recibio el id del cliente',
                
            );
            
            http_response_code(405);
            echo json_encode($respuesta);
            return;

        } 
        
        $factura = $this->facturacionModel->getFactura($id);
        $detalleFactura = $this->facturacionModel->getDetalle($id);

        if (!$factura) {
            
            $respuesta = array(
                'error' => TRUE,
                'mensaje' => 'Ocurrio un error al procesar la consulta',
                
            );
            
            http_response_code(405);
            echo json_encode($respuesta);
            return;

        }
        
        if (!$detalleFactura) {
            
            $respuesta = array(
                'error' => TRUE,
                'mensaje' => 'Ocurrio un error al procesar la consulta',
                
            );
            
            http_response_code(405);
            echo json_encode($respuesta);
            return;

        }
        
        $respuesta = array(
            'error' => FALSE,
            'mensaje' => 'Datos cargados correctamente',
            'factura' => $factura,
            'detalle' => $detalleFactura
            
        );
        
        echo json_encode($respuesta);
       
        


    }
    
}

?>
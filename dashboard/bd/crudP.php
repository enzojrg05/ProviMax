<?php
    include_once ('../bd/conexion.php');
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // Recepción de los datos enviados mediante POST desde el JS   
    $cliente_nombre_p = (isset($_POST['cliente_nombre'])) ? $_POST['cliente_nombre'] : '';
    $producto_p = (isset($_POST['producto'])) ? $_POST['producto'] : '';
    $cantidad_p = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
    $fecha_pedido_p = (isset($_POST['fecha_pedido'])) ? $_POST['fecha_pedido'] : '';
    $opcion_p = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $id_p = (isset($_POST['pedido_id'])) ? $_POST['pedido_id'] : '';

    switch($opcion_p){
        case 1: //alta
            $consulta_p = "INSERT INTO pedidos (cliente_nombre, producto, cantidad, fecha_pedido) VALUES('$cliente_nombre_p', '$producto_p', '$cantidad_p', '$fecha_pedido_p') ";
            $resultado_p = $conexion->prepare($consulta_p);
            $resultado_p->execute(); 

            $consulta_p = "SELECT pedido_id, cliente_nombre, producto, cantidad, fecha_pedido FROM pedidos ORDER BY pedido_id DESC LIMIT 1";
            $resultado_p = $conexion->prepare($consulta_p);
            $resultado_p->execute();
            $data_p=$resultado_p->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2: //modificación
            $consulta_p = "UPDATE pedidos SET cliente_nombre='$cliente_nombre_p', producto='$producto_p', cantidad='$cantidad_p', fecha_pedido='$fecha_pedido_p' WHERE pedido_id='$id_p' ";		
            //print json_encode($consulta_p);
            $resultado_p = $conexion->prepare($consulta_p);
            $resultado_p->execute();        
            
            $consulta_p = "SELECT pedido_id, cliente_nombre, producto, cantidad, fecha_pedido FROM pedidos WHERE pedido_id='$id_p' ";       
            $resultado_p = $conexion->prepare($consulta_p);
            $resultado_p->execute();
            $data_p=$resultado_p->fetchAll(PDO::FETCH_ASSOC);
            break;        
        case 3://baja
            $consulta_p = "DELETE FROM pedidos WHERE pedido_id='$id_p' ";		
            $resultado_p = $conexion->prepare($consulta_p);
            $resultado_p->execute();                           
            break;        
    }

    print json_encode($data_p, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;

?>

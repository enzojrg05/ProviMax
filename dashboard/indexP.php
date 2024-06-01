<?php 

    require_once "vistas/parte_superior.php"?>

    <!--INICIO del cont principal-->
    <div class="container">
        <h1>Controlador de Pedidos</h1>
        
    <?php
    include_once('../bd/conexion.php');

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT pedido_id, cliente_nombre, producto, cantidad, fecha_pedido FROM pedidos";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Importa jQuery, Bootstrap y tu script pedidos.js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="pedidos.js"></script>

<div class="container">
    <div class="row">
        <div class="col-lg-12">            
            <!-- <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCRUD">Nuevo</button> -->
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
        </div>    
    </div>    
</div>    
<br>  
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaPedidos" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th>Id Pedido</th>
                            <th>Nombre del Cliente</th>
                            <th>Producto</th>                                
                            <th>Cantidad</th>  
                            <th>Fecha del Pedido</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                            
                        foreach($data as $dat) {                                                        
                        ?>
                        <tr>
                            <td><?php echo $dat['pedido_id'] ?></td>
                            <td><?php echo $dat['cliente_nombre'] ?></td>
                            <td><?php echo $dat['producto'] ?></td>
                            <td><?php echo $dat['cantidad'] ?></td>
                            <td><?php echo $dat['fecha_pedido'] ?></td>    
                            <td></td>
                        </tr>
                        <?php
                            }
                        ?>                                
                    </tbody>        
                </table>                    
            </div>
        </div>
    </div>  
</div>    

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPedidos">    
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cliente_nombre" class="col-form-label">Nombre del Cliente:</label>
                        <input type="text" class="form-control" id="cliente_nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="producto" class="col-form-label">Producto:</label>
                        <input type="text" class="form-control" id="producto" required>
                    </div>                
                    <div class="form-group">
                        <label for="cantidad" class="col-form-label">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_pedido" class="col-form-label">Fecha del Pedido:</label>
                        <input type="date" class="form-control" id="fecha_pedido" required>
                    </div>            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                </div>
            </form>    
        </div>
    </div>
</div>  

<?php require_once "vistas/parte_inferior.php"?>

$(document).ready(function(){
    tablaPedidos = $("#tablaPedidos").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data": null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
    $("#btnNuevo").click(function(){
        $("#formPedidos").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Pedido");            
        $("#modalCRUD").modal("show");        
        pedido_id = null;
        opcion = 1; // alta
    });

    var fila; // capturar la fila para editar o borrar el registro

    // botón EDITAR
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        pedido_id = parseInt(fila.find('td:eq(0)').text());
        cliente_nombre = fila.find('td:eq(1)').text();
        producto = fila.find('td:eq(2)').text();
        cantidad = parseInt(fila.find('td:eq(3)').text());
        fecha_pedido = fila.find('td:eq(4)').text();
        
        $("#cliente_nombre").val(cliente_nombre);
        $("#producto").val(producto);
        $("#cantidad").val(cantidad);
        $("#fecha_pedido").val(fecha_pedido);
        opcion = 2; // editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Pedido");            
        $("#modalCRUD").modal("show");  
    });

    // botón BORRAR
    $(document).on("click", ".btnBorrar", function(){    
        fila = $(this);
        pedido_id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3; // borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+pedido_id+"?");
        if(respuesta){
            $.ajax({
                // url: "bd/crudP.php?pedido_id=" + pedido_id,
                url: "bd/crudP.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, pedido_id:pedido_id},
                success: function(){
                    tablaPedidos.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });

    $("#formPedidos").submit(function(e){
        e.preventDefault();
        cliente_nombre = $.trim($("#cliente_nombre").val());
        producto = $.trim($("#producto").val());
        cantidad = $.trim($("#cantidad").val());
        fecha_pedido = $.trim($("#fecha_pedido").val());
        
        $.ajax({
            url: "bd/crudP.php",
            type: "POST",
            dataType: "json",
            data: {cliente_nombre: cliente_nombre, producto: producto, cantidad: cantidad, fecha_pedido: fecha_pedido, pedido_id: pedido_id, opcion: opcion },
            success: function(data){
                console.log(data);
                pedido_id = data[0].pedido_id;
                cliente_nombre = data[0].cliente_nombre;
                producto = data[0].producto;
                cantidad = data[0].cantidad;
                fecha_pedido = data[0].fecha_pedido;
                if(opcion == 1){tablaPedidos.row.add([pedido_id, cliente_nombre, producto, cantidad, fecha_pedido]).draw();}
                else{tablaPedidos.row(fila).data([pedido_id, cliente_nombre, producto, cantidad, fecha_pedido]).draw();}            
            }
        });
        $("#modalCRUD").modal("hide");
    });
});

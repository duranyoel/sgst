<div class="box">
    <div class="box-header">
        <h3 class="box-title">Listado de clientes registrados</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php
        echo $this->Html->link(__(' Agregar Registro'), array('action' => 'add'), array('class' => 'btn btn-flat btn-success glyphicon glyphicon-plus pull-right', 'title' => 'Agregar Nuevos Registros'));
        ?>
        <table id="data-table" width="100%" class="table table-bordered table-striped">
            <thead>

                <tr>
                    <th>Id</th>
                    <th>Cedula</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Creado</th>
                    <th>Modificado</th>
                    <th>Opciones</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>


                </tr>

            </tbody>

        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<script>

    $(document).ready(function () {
        $('#data-table').DataTable({
            "processing": true,
            //"serverSide": true,
            "ajax": "<?=
        $this->Html->url([
            'action' => 'ajax_search'
        ])
        ?>",
            "responsive": true,
            "paging": true,
            "ordering": true,
"info": true,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i> ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i> ',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger'
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> ',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-info'
                },
            ],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[0, 'asc']],
            "aoColumnDefs": [
                {
                    "aTargets": [6],
                    "mData": null,
                    "mRender": function (data, type, full) {
                        // definimos los botones como templates con el helper de cake para tener correctamente las url's
                        var _template = '<?php
        echo $this->Html->link(
                $this->Html->tag('i', ' ', array('class' => 'fa fa-pencil')) . $this->Html->tag('span', ' Editar'), 'edit/' . '__id__', array('escape' => false, 'class' => 'btn btn-info btn-xs')) . " " .
        $this->Html->link(
                $this->Html->tag('i', ' ', array('class' => 'fa fa-eye')) . $this->Html->tag('span', ' Ver'), 'view/' . '__id__', array('escape' => false, 'class' => 'btn btn-info btn-xs'));
        ?>';
                        // esto ejecuta para cada fila generando los links correctamente reemplazando el id de cada item
                        return _template.replace(new RegExp('__id__', 'g'), data[0]);
                    }
                }
            ]



        });


    });
</script>



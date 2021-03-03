<div class="box">
    <div class="box-header">
        <h3 class="box-title">Listado de municipios registrados</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Estado</th>

                    <th>Ingresado</th>
                    <th>Actualizado</th>
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
                </tr>

            </tbody>

        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<script>
    $(document).ready(function () {

        var t = $('#data-table').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "ordering": true,
            "info": true,
            "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax": "<?=
$this->Html->url([
    'action' => 'ajax_search'
])
?>",
            "responsive": true,
            "aoColumnDefs": [
                {
                    "aTargets": [5],
                    "mData": null,
                    "mRender": function (data, type, full) {
                        // definimos los botones como templates con el helper de cake para tener correctamente las url's
                        var _template = '<?php
echo $this->Html->link(
        $this->Html->tag('i', ' ', array('class' => 'fa fa-pencil')) . $this->Html->tag('span', ' Editar'), 'edit/' . '__id__', array('escape' => false, 'class' => 'btn btn-info btn-xs')) . " " . $this->Html->link(
        $this->Html->tag('i', ' ', array('class' => 'fa fa-plus')) . $this->Html->tag('span', ' Ver'), 'view/' . '__id__', array('escape' => false, 'class' => 'btn btn-info btn-xs'));
?>';
                        // esto ejecuta para cada fila generando los links correctamente reemplazando el id de cada item
                        return _template.replace(new RegExp('__id__', 'g'), data[0]);
                    }
                }
            ]



        });
           });
</script>



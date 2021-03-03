<label>Lista de respuesto/articulos agregados:</label>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="danger">
                <th>Id</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Costo</th>
                <th>Descripción</th>
                <th class="actions"><?php echo __('Acción'); ?></th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicearticle as $lista): ?>
                <tr>
                    <td><?php echo $lista['ArticleService']['id']; ?>&nbsp;</td>
                    <td><?php echo $lista['Article']['codigo']; ?>&nbsp;</td>
                    <td><?php echo $lista['Article']['nombre']; ?>&nbsp;</td>
                    <td><?php  echo $this->Number->format($lista['Article']['costo'], array(
                                                        'places' => 2,
                                                        'escape' => false,
                                                        'decimals' => '.',
                                                        'thousands' => ','
                                                    ));?>&nbsp;</td>
                    <td><?php echo $lista['ArticleService']['observacion'];?>&nbsp;</td>
                    <td class="actions">
                        <button type="button" class="btn btn-danger btn-sm btn-flat" onCLick="articles.deletearticleservice(<?php echo $lista['ArticleService']['id']; ?>);"><span class="fa fa-trash"></span>&nbsp;Eliminar</button>
                    </td>
                </tr>
            <?php $total = $total + $lista['Article']['costo'];
                                        endforeach; ?>
                                            <tr>
                                                <th colspan="3">Total Servicio</th>
                                                <th>
                                                    <?php
                                                    echo $this->Number->format($total, array(
                                                        'places' => 2,
                                                        'escape' => false,
                                                        'decimals' => '.',
                                                        'thousands' => ','
                                                    ));
                                                    ?>
                                                </th>
                                            </tr>     
        </tbody>

    </table>
</div>
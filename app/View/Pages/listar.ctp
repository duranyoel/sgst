<div class="card">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Estatus</th>
                    <th>Observacion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $value) {
                    ?>
                    <tr>

                        <td><?php echo $value['ServiceStatu']['estatus'] ?></td>
                        <td><?php echo $value['ServiceStatu']['descripcion'] ?></td>
                    </tr>


                <?php }
                ?>


            </tbody>
        </table>
    </div>
</div>
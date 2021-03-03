<?php
echo $this->Form->create('Pages');
?>
<section id="hero">
    <duv class="container">
        <div class="content-center">
            <h1 class="mt-5">Sistema de Gestión De Soporte Técnico</h1>
            <p>Nuestra plataforma te ofrece una manera sencilla, rapida y facil de llevar el control de tu negocio/empresa de soporte técnico.</p>
            <?php
            $thumb_img = $this->Html->image('assets/images/arrow-right.svg', array('class' => 'ml-2'));

            echo $this->Html->link('Registrate' . $thumb_img, array('controller' => 'users', 'action' => 'register'), array('escape' => false, 'class' => 'btn btn-secondary mt-4'));
            ?>

        </div>
    </duv>
</section>

<section id="portfolio">
    <div class="container-fluid">
        <div class="content-center">
            <h2>Galeria de imagenes de nuestra plataforma</h2>
            <p>Aqui te mostramos una pequeña galeria de las pantallas o formularios de nuestro sistema.</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="portfolio-container">
                   
                    <?php echo $this->Html->image('dashboard.png', array('class' => 'img-fluid')); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="portfolio-container">
                   
                    <?php echo $this->Html->image('listadoservicios.png', array('class' => 'img-fluid')); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="portfolio-container">
                    
                    <?php echo $this->Html->image('registroordenes.png', array('class' => 'img-fluid')); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="portfolio-container">
                   
                    <?php echo $this->Html->image('listadoarticulos.png', array('class' => 'img-fluid')); ?>
                </div>
            </div>
        </div>
       
    </div>
</section>

<section id="team" class="bgLightGrey">
    <div class="container">
        <div class="content-center">
            <h2>Conoce nuestra plataforma</h2>
            <p>Un saludo cordial a nuestros visitantes, me llamo Yoel Duran soy el creador de esta plataforma la cual 
                esta en constante crecimiento y evolución.
                Te invito a registrarte y probar nuestra plataforma,tambien te invito a que me hagas llegar tus sugerencias 
                para que la plataforma pueda evolucionar.</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="member-container">
                    <div class="member-details">
                        <h5>Yoel Duran</h5>
                        <span>CEO, Creador y desarrollador</span>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="https://facebook.com/yoel.duran.16752" target="_blank">
                                    <?php echo $this->Html->image('assets/images/instagram.svg', array('class' => 'img-fluid')); ?>

                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://twitter.com/yoel_duran28" target="_blank">
                                    <?php echo $this->Html->image('assets/images/twitter.svg', array('class' => 'img-fluid')); ?>

                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.youtube.com/channel/UCzX8KELuEPI41u-70YxT8vg" target="_blank">
                                    <?php echo $this->Html->image('assets/images/youtube.svg', array('class' => 'img-fluid')); ?>

                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="https://facebook.com/yoel.duran.16752" target="_blank">
                                    <?php echo $this->Html->image('assets/images/facebook.svg', array('class' => 'img-fluid')); ?>

                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php echo $this->Html->image('yoel.jpg', array('class' => 'img-fluid')); ?>

                </div>
            </div>

        </div>
    </div>
</section>
<section id="search" class="bgLightGrey">
    <div class="container">
        <div class="content-center">
            <h2>Eres cliente de alguno de nuestros usuarios</h2>
            <p>Si has recibido un email que te ha traido hasta aca es porque eres cliente de alguno de nuestro usuarios, aqui puedes consultar el estado de 
                tu orden de servicio y ver en que estatus se encuentra tu equipo.</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="telefono">Codigo:</label>
                    <div class="input-group mb-3">
                        <?php
                        echo $this->Form->input('codigo', array('class' =>
                            'form-control', 'placeholder' => '12345678',
                            'label' => false, 'maxlength' => '100',
                            'aria-describedby' => 'button-addon2',
                            'title' => 'Ingrese el codigo de su orden'));
                        ?> 

                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="boton-buscar">Buscar</button>
                        </div>
                    </div>
                </div>
                <div id="resultadobusquedad"></div>
            </div>

        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-4">
                <h3>Si tienes dudas, preguntas o sugerencias.</b></h3>
                <p>Contacta directemente con el administrador de la plataforma llenando este formulario o a traves de los siguientes medios
                </p>
                <p>Email: yoelduran25@gmail.com</p>
                <p>Telefono:+57 3152178418</p>
            </div>
            <div class="col-md-6 mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombres:</label>
                            <?php
                            echo $this->Form->input('nombres', array('class' =>
                                'form-control', 'placeholder' => 'Demo',
                                'label' => false, 'maxlength' => '100',
                                'title' => 'Por Favor Ingrese El nombre'));
                            ?>  
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <?php
                            echo $this->Form->input('apellidos', array('class' =>
                                'form-control', 'placeholder' => 'Demo',
                                'label' => false, 'maxlength' => '100',
                                'title' => 'Por Favor Ingrese su apellido'));
                            ?>  
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <?php
                            echo $this->Form->input('email', array('class' =>
                                'form-control', 'placeholder' => 'Demo',
                                'label' => false, 'maxlength' => '100',
                                'title' => 'Por Favor Ingrese su email'));
                            ?>  
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="telefono">Teléfono(Opcional):</label>
                            <?php
                            echo $this->Form->input('telefono', array('class' =>
                                'form-control', 'placeholder' => '',
                                'label' => false, 'maxlength' => '100',
                                'data-inputmask' => '"mask":"(+99)(999) 999-9999"', 'data-mask',
                                'title' => 'Por Favor Ingrese Su Telefono'));
                            ?>  
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="asunto">Asunto:</label>
                            <?php
                            echo $this->Form->input('asunto', array('class' =>
                                'form-control', 'placeholder' => '',
                                'label' => false, 'maxlength' => '100',
                                'data-inputmask' => '"mask":"(+99)(999) 999-9999"', 'data-mask',
                                'title' => 'Por Favor Ingrese Su Telefono'));
                            ?>  
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <?php
                            echo $this->Form->input('mensaje', array('class' =>
                                'form-control', 'placeholder' => '',
                                'label' => false, 'maxlength' => '100',
                                'title' => '',
                                'type' => 'textarea'));
                            ?>  

                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary full-width">Enviar</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
echo $this->Form->end();
?>

<script>
    $('#boton-buscar').click(function () {
        var articulo = document.getElementById('PagesCodigo').value;

        $.ajax(
                {
                    async: true,
                    data: $("#PagesCodigo").serialize(),
                    dataType: "html",
                    success: function (data, textStatus)
                    {
                        $("#resultadobusquedad").html(data);
                    },
                    type: "post",
                    url: "pages\/listar"
                });
    });

</script>
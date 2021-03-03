<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <?php
        $thumb_img = $this->Html->image('logo1.png', array('alt' => 'yoursite.com', 'class' => 'logo-brand', 'height' => 30));

        echo $this->Html->link($thumb_img, array('action' => 'home'), array('escape' => false, 'class' => 'logo'));
        ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <?php echo $this->Html->image('assets/images/menu.svg'); ?>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">

                    <a class="nav-link" href="#hero">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Galeria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#team">Acerca De</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#search">Busquedad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contacto</a>
                </li>
                <?php
                if ($this->Session->read('Auth.User.id') > 0) {
                    ?>
                    <li class="nav-item">
                        <?php echo $this->Html->link('Administrador', array('controller' => 'dashboard', 'action' => 'index'),'class="nav-link"');?>
                    </li>
                    <li class="nav-item">
                        <?php echo $this->Html->link('Salir', array('controller' => 'users', 'action' => 'logout'),'class="nav-link"');?>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item"><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'),'class="nav-link"'); ?></li>
                    <li class="nav-item"><?php echo $this->Html->link('Registrarse', array('controller' => 'users', 'action' => 'register'),'class="nav-link"'); ?></li>       <?php
                    }
                    ?>
            </ul>
        </div>
    </div>
</nav>
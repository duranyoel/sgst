<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


        </div>


        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><?php echo $this->Html->link('Home', '/'); ?></li>
                <li><?php echo $this->Html->link('Ingresar', '/users/login', 'login'); ?></li>
                <li><?php echo $this->Html->link('Registro', '/users/register', 'registro'); ?></li>


            </ul>

        </div>

        <!--/.navbar-collapse -->
    </div>
</div>
</nav>
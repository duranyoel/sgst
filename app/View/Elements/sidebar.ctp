<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>

            <li class="" id="Dashboard">
                <?php
                echo $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fa fa-dashboard')) .
                        $this->Html->tag('span', 'Dashboard'), '/dashboard', array('escape' => false));
                ?>
            </li>
            <!-- Optionally, you can add icons to the links -->
            <?php
            if ($this->Session->read('role') == "superuser") {
                ?>
                <li>
                    <?php
                    echo $this->Html->link(
                            $this->Html->tag('i', '', array('class' => 'fa fa-map-marker')) . $this->Html->tag('span', 'Estados'), '/estados/', array('escape' => false));
                    ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link(
                            $this->Html->tag('i', '', array('class' => 'fa fa-map-marker')) . $this->Html->tag('span', 'Municipios'), '/municipios/', array('escape' => false));
                    ?>
                </li>
                <li>
                    <?php
                    echo $this->Html->link(
                            $this->Html->tag('i', '', array('class' => 'fa fa-map-marker')) . $this->Html->tag('span', 'Parroquias'), '/parroquias/', array('escape' => false));
                    ?>
                </li>
                <li class="treeview" id="Trademarks">
                    <a href="#">
                        <i class="fa fa-trademark"></i> <span>Marcas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-list')) .
                                    $this->Html->tag('span', 'Listar'), '/trademarks/', array('escape' => false));
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-plus')) .
                                    $this->Html->tag('span', 'Agregar'), '/trademarks/add', array('escape' => false));
                            ?>
                        </li>


                    </ul>
                </li>


                <?php
            }
            ?>
            <li class="treeview" id="Customers">
                <a href="#">
                    <i class="fa fa-user-circle"></i> <span>Clientes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-list')) .
                                $this->Html->tag('span', 'Listar'), '/customers/', array('escape' => false));
                        ?>
                    </li>
                    <li>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-plus')) .
                                $this->Html->tag('span', 'Agregar'), '/customers/add', array('escape' => false));
                        ?>
                    </li>

                </ul>
            </li>
            <li class="treeview" id="Services">
                <a href="#">
                    <i class="fa fa-briefcase"></i> <span>Servicios</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-list')) .
                                $this->Html->tag('span', 'Listar'), '/services/', array('escape' => false));
                        ?>
                    </li>
                    <li>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-plus')) .
                                $this->Html->tag('span', 'Agregar'), '/services/add', array('escape' => false));
                        ?>
                    </li>
                    <li>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-gears')) .
                                $this->Html->tag('span', 'Listado Soporte'), '/services/soporte_lista/', array('escape' => false));
                        ?>
                    </li>
                    <li>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-gears')) .
                                $this->Html->tag('span', 'Equipos Reparados'), '/services/listadoreparados/', array('escape' => false));
                        ?>
                    </li>


                </ul>
            </li>

            <li class="treeview" id="Advances">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Adelantos/Abonos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-list')) .
                                $this->Html->tag('span', 'Listar'), '/advances/', array('escape' => false));
                        ?>
                    </li>
                    <li>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-plus')) .
                                $this->Html->tag('span', 'Agregar'), '/advances/add', array('escape' => false));
                        ?>
                    </li>


                </ul>
            </li>   
            <?php
            if ($this->Session->read('role') == "admin" || $this->Session->read('role') == "superuser") {
                ?>
                <li class="treeview" id="Patterns">
                    <a href="#">
                        <i class="fa fa-cubes"></i> <span>Modelos</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-list')) .
                                    $this->Html->tag('span', 'Listar'), '/patterns/', array('escape' => false));
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-plus')) .
                                    $this->Html->tag('span', 'Agregar'), '/patterns/add', array('escape' => false));
                            ?>
                        </li>


                    </ul>
                </li>
                <li class="treeview" id="Articles">
                    <a href="#">
                        <i class="fa fa-cubes"></i> <span>Articulos</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-list')) .
                                    $this->Html->tag('span', 'Listar'), '/articles/', array('escape' => false));
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-plus')) .
                                    $this->Html->tag('span', 'Agregar'), '/articles/add', array('escape' => false));
                            ?>
                        </li>


                    </ul>
                </li>
                <li class="treeview" id="Users">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Usuarios</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-list')) .
                                    $this->Html->tag('span', 'Listar'), '/users/', array('escape' => false));
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-plus')) .
                                    $this->Html->tag('span', 'Agregar'), '/users/add', array('escape' => false));
                            ?>
                        </li>


                    </ul>
                </li>
                <li class="treeview" id="Officces">
                    <a href="#">
                        <i class="fa fa-building"></i> <span>Taller/Oficinas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-list')) .
                                    $this->Html->tag('span', 'Listar'), '/offices/', array('escape' => false));
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('i', '', array('class' => 'fa fa-plus')) .
                                    $this->Html->tag('span', 'Agregar'), '/offices/add', array('escape' => false));
                            ?>
                        </li>


                    </ul>
                </li>    
                <?php
            }
            ?>
            <li class="" id="Pages">
                <?php
                echo $this->Html->link(
                        $this->Html->tag('i', '', array('class' => 'fa fa-book')) .
                        $this->Html->tag('span', 'Manual'), '/pages/manual', array('escape' => false));
                ?>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
<script>
    $(document).ready(function () {
        var paginatitle = $('#title');
        //console.log(paginatitle.attr('value'));
        var active = paginatitle.attr('value');
        if (active == 'Dashboard') {
            $("#Dashboard").addClass("active");
        } else if (active == 'Services') {
            $("#Services").addClass("active");
        }
        else if (active == 'Advances') {
            $("#Advances").addClass("active");
        } else if (active == 'Users') {
            $("#Users").addClass("active");
        } else if (active == 'Offices') {
            $("#Officces").addClass("active");
        } else if (active == 'Trademarks') {
            $("#Trademarks").addClass("active");
        } else if (active == 'Patterns') {
            $("#Patterns").addClass("active");
        }
        else if (active == 'Articles') {
            $("#Articles").addClass("active");
        }
        else if (active == 'Customers') {
            $("#Customers").addClass("active");
        }
        else if (active == 'Pages') {
            $("#Pages").addClass("active");
        }



    });

</script>
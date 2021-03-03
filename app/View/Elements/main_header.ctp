<header class="main-header">

    <!-- Logo -->
    <!-- Logo -->
    <?php
    $per = $this->requestAction('/users/view/' . $this->Session->read('Auth.User.id'));
    $thumb_img = $this->Html->image('logo1.png', array('alt' => 'yoursite.com', 'class' => 'img-responsive','height'=> 30));

    echo $this->Html->link($thumb_img, array('controller' => 'dashboard', 'action' => 'index'), 
        array('escape' => false, 'class' => 'logo'));
    
    
    ?>


    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                
                <!-- /.messages-menu -->

                <!-- Notifications Menu -->
               
                <!-- Tasks Menu -->
                
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <?php
                        if ($per['User']['imagen'] == 'Ninguna' || $per['User']['imagen'] == null) {
                            echo $this->Html->image('avatar2.png', array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'user-image'));
                        } else {
                            echo $this->Html->image('uploads/users/' . $per['User']['imagen'], array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'user-image'));
                        }
                        ?>

                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><?php
                        if ($per['User']['apellidos'] != null) {
                            echo $per['User']['apellidos'];
                        } else {
                            echo $per['User']['username'];
                        }
                        ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <?php
                            if ($per['User']['imagen'] == 'Ninguna' || $per['User']['imagen'] == null) {
                                echo $this->Html->image('avatar2.png', array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'img-circle'));
                            } else {
                                echo $this->Html->image('uploads/users/' . $per['User']['imagen'], array('alt' => 'Foto Perfil', 'border' => '0', 'class' => 'img-circle'));
                            }
                            ?>
                            <p>
                                <?php
                                echo $per['User']['apellidos'] . ' ' . $per['User']['nombres'] . '<br>';

                                if ($per['User']['cargo'] != null) {
                                    echo $per['User']['cargo'];
                                } else {
                                    echo 'No Posee Cargo';
                                }
                                ?>
                                <small><?php
                                echo 'Usuario desde ' . $this->Time->format('d/m/Y H:i:s', $per['User']['created']);
                                ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php echo $this->Html->link('Perfil', array('controller'=>'users','action'=>'profile'), array('class'=>'btn btn-default btn-flat'))?>
                               
                            </div>
                            <div class="pull-right">
                                <?php echo $this->Html->link('Salir', array('controller'=>'users','action'=>'logout'), array('class'=>'btn btn-default btn-flat'))?>
                                
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>
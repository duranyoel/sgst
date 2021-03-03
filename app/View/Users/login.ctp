<div class="login-box">
  <div class="login-logo">
    <?php echo $this->Html->link(
                      $this->Html->tag('b','SGST'),
                      '/',
                      array('escape'=>false));
                  ?>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresa tus datos de usuario</p>

    <?php echo $this->Form->create('User') ?>
      <div class="form-group has-feedback">
        <?php
          echo $this->Form->input('username', array('type' => 'email',
              'label' => false, 'required', 'class' => 'form-control',
              'placeholder' => 'Email'));
          ?> 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php
          echo $this->Form->input('password', array('type' => 'password',
              'label' => false, 'required', 'class' => 'form-control',
              'placeholder' => 'Password'));
         
          ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat pull-left">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo $this->Form->end() ?>

   
    <!-- /.social-auth-links -->

  <div class="col-md-12">

        <div class="col-md-6"><?php echo $this->Html->link('Registrarse ', '/users/register',array('class' =>'text-center' )); ?>
        </div>
        <div class="col-md-6"><?php echo $this->Html->link('Olvide Mi Clave ', '/users/recover',array('class' =>'text-center' )); ?></div>

  </div> 
   <div class="box-footer">
  </div>
                
    
    
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

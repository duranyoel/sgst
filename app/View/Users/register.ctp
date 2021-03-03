<div class="register-box">
  <div class="register-logo">
  <?php echo $this->Html->link(
                      $this->Html->tag('b','SGST'),
                      '/',
                      array('escape'=>false));
                  ?>
  
    
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Registro nuevos usuarios</p>

    <?php echo $this->Form->create('User') ?>
      <div class="form-group has-feedback">
        <?php
          echo $this->Form->input('apellidos', array('type' => 'text',
              'label' => false, 'required', 'class' => 'form-control',
              'placeholder' => 'Apellidos'));
        ?> 
        
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php
          echo $this->Form->input('nombres', array('type' => 'text',
              'label' => false, 'required', 'class' => 'form-control',
              'placeholder' => 'Nombres'));
        ?> 
        
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php
          echo $this->Form->input('cedula', array('type' => 'text',
              'label' => false, 'required', 'class' => 'form-control',
              'id' => 'cedula',
              'placeholder' => 'Cedula'));
        ?> 
        
        <span class="fas fa-id-card form-control-feedback"></span>
      </div>
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
      <div class="form-group has-feedback">
        <?php
          echo $this->Form->input('reppassword', array('type' => 'password',
              'label' => false, 'required', 'class' => 'form-control',
              'placeholder' => 'Repetir Password'));
        ?> 
        
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>


      
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"><a href="#"> Acepto todos los terminos y condiciones</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo $this->Form->end() ?>

   <div class="box-footer">
  </div>
  <?php echo $this->Html->link('Ya sestoy registrado ', '/users/login',array('class' =>'text-center' )); ?>
  </div>
  <!-- /.form-box -->
</div>
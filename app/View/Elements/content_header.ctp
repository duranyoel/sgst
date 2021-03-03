<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $this->fetch('title'); 
    echo $this->Form->input('title', array('class' =>
                                        'form-control', 'placeholder' => 'Potter',
                                        'label' => false, 'maxlength' => '100',
                                        'type'=>'hidden','value'=>$this->fetch('title'),
                                        'title' => ''));
    ?>
    
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active"><?php echo $this->fetch('title'); ?></li>
  </ol>
</section>  
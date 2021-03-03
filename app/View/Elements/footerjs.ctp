<?php
echo $this->Js->writeBuffer(); // Write cached scripts 
$this->Combinator->add_libs('js', array(
    'bootstrap.min',
    'Controllers/Users',
    'Controllers/Articles',
    
));

//echo $this->Html->script('');
echo $this->Html->script('jquery-slimscroll/jquery.slimscroll.min');
echo $this->Html->script('select2/select2.min');
echo $this->Html->script('input-mask/jquery.inputmask');
echo $this->Html->script('input-mask/jquery.inputmask.date.extensions');
echo $this->Html->script('input-mask/jquery.inputmask.extensions');
echo $this->Html->script('moment/min/moment.min');
echo $this->Html->script('daterangepicker');
echo $this->Html->script('bootstrap-datepicker/js/bootstrap-datepicker');
echo $this->Html->script('bootstrap-colorpicker/js/bootstrap-colorpicker.min');
echo $this->Html->script('timepicker/bootstrap-timepicker.min');
echo $this->Html->script('iCheck/icheck.min');
echo $this->Html->script('morris/morris.min');
echo $this->Html->script('raphael/raphael.min');
echo $this->Html->script('bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min');
echo $this->Html->script('adminlte.min');
echo $this->Html->script('jquery.maskedinput.min');
//echo $this->Html->script('demo');
//echo $this->Html->script('datatablesnet/jquery.dataTables.min');
//echo $this->Html->script('datatablesnet-bs/dataTables.bootstrap.min');




echo $this->Combinator->scripts('js'); // Output Javascript files
//echo $this->Html->script('controllers/images');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" integrity="sha256-JG6hsuMjFnQ2spWq0UiaDRJBaarzhFbUxiUTxQDA9Lk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js" integrity="sha256-J2sc79NPV/osLcIpzL3K8uJyAD7T5gaEFKlLDM18oxY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" integrity="sha256-CfcERD4Ov4+lKbWbYqXD6aFM9M51gN4GUEtDhkWABMo=" crossorigin="anonymous"></script> 
<script>
    $(function () {
        
        
        //Initialize Select2 Elements
        $('.select1').select2();
        $('.select2').select2();
        $('.select3').select2();
        $('.select4').select2();
        $('.select5').select2();
        $('#cedula').mask('99999999');
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()
        //bootstrap WYSIHTML5 - text editor
        $('.descripcion').wysihtml5()
        //Date range picker
        //$('#reservation').daterangepicker()
        //Date range picker with time picker


        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
            
        }).val()
        $('#datepickerentrega').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        }).val()

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    });

    function NumeroAleatorio(min, max) {
    var num = Math.round(Math.random() * (max - min) + min);
    document.getElementById('rand').value=num;
    //$('#rand').text(num);

    }  
</script>
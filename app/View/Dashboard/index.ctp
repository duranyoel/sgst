<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#area" data-toggle="tab">Area</a></li>
                <li><a href="#chartbar" data-toggle="tab">Bar</a></li>
                <li class="pull-left header"><i class="fa fa-money"></i> Saldos</li>
            </ul>
            <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="area" style="position: relative; height: 300px; width: 100%"><?php $this->GoogleChart->createJsChart($chart);?></div>
                <div class="chart tab-pane" id="chartbar" style="position: relative; height: 300px;"><?php $this->GoogleChart->createJsChart($chartbar);?></div>
            </div>
        </div>
        <!-- /.nav-tabs-custom -->
        <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Recepciones ultimos dias</h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
             <div class="chart tab-pane" id="countchart" style="position: relative; height: 300px;"><?php $this->GoogleChart->createJsChart($chartcount);?></div>
            </div>
            <!-- /.box-body -->
            
          </div>
        
        <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-wrench"></i>

              <h3 class="box-title">Reparaciones ultimos dias</h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
             <div class="chart tab-pane" id="repairchart" style="position: relative; height: 300px;"><?php $this->GoogleChart->createJsChart($repaircount);?></div>
            </div>
            <!-- /.box-body -->
            
          </div>
       
        
    </section>
    <!-- /.Left col -->
    
   
</div>
<?php $__env->startSection('content'); ?>

<section class="content-header">
      <h1>
        Entry
        <small>CRM SAP</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i>home</a></li>
        <li><a href="#"><i class="fa  fa-book"></i>here</a></li>
      </ol>
</section>

<section class="content">
    <div class=" row">
        <section class="col-md-12 col-lg-12 connectedSortable">
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                            <h3 id="bartitle" class="box-title">List and Entry</h3>
                            <div class="box-tools pull-right">

                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#Ent" data-toggle="tab" >Entry</a></li>
                                <li ><a href="#Lst" data-toggle="tab" >List</a></li>
                            </ul>

                            <div class="tab-content"  id="custom-content-below-tabContent">
                                        <!-- --------------------Tab Entry---------------------- -->
                                        <div id="Ent" class="tab-pane active" style=" position: relative; ">
                                            


                                            <div class="row" style="padding-bottom: 20px;">
                                                <div class="col-md-10">
                                                        <div id='main-btn' >
                                                            <div class="inner"> <div id="add" ></div></div>
                                                            <div class="inner"> <div id="save"></div></div>
                                                            <div class="inner"> <div id="edit"></div></div>
                                                            <div class="inner"> <div id="cancel"></div></div>
                                                            <div class="inner"> <div id="delete"></div></div>
                                                            <div class="inner"> <div id="posting"></div></div>
                                                            <div class="inner"> <div id="upload"></div></div>
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin-bottom: 20px;">
                                                <div class="col-md-12">
                                                    <div id="header-dxform"></div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: 20px;">
                                                <div class="col-md-12">
                                                    <div id="institusi-grid"></div>
                                                </div>
                                            </div>

                                            <div id="form-container">
                                                <div id="frm1">
                                                    <div id="form1"></div>
                                                                                            
                                                    <hr>
                                                    <div id="btnLoad" ></div>
                                                    <!--  <div id="note2" style="color:red;margin-top:15px; "></div>   -->

                                                    <div class="row">
                                                            <div id="dtl" style="margin-right: 10px;margin-left:10px"></div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>

                                                
                                            <div id="summary"></div>
                                        </div>

                                        <!----------------------Tab List------------------------->
                                        
                                        <div id="Lst" class="tab-pane" style=" position: relative; ">
                                            <div id="gridContainer"></div>
                                        </div>
                                        <div class="loadpanel"></div>
                            </div>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
        </section>
    </div>
</section>
<style>
    #main-btn{
        float:left;

        margin: 0;
        margin-top:10px;

        width:100%;
        text-align:left;
    }
    .inner{
        display: inline-block;
    }
</style>






<script src="<?php echo url('asset/js/backend/preblock_mcl_form.js'); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookpro/Herd/crm-microapp/resources/views/backend/preblock/preblock_mcl_form.blade.php ENDPATH**/ ?>
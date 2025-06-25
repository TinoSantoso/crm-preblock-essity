@extends('layouts.backend')
@section('content')

<section class="content-header">
      <h1>
        List Visit Confirmation
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
                            <h3 id="bartitle" class="box-title">List Visit</h3>
                            <div class="box-tools pull-right">

                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#Visit" data-toggle="tab" >List Visit</a></li>
                                {{-- <li ><a href="#Ent" data-toggle="tab" >Entry</a></li> --}}
                                
                            </ul>

                            <div class="tab-content"  id="custom-content-below-tabContent">
                                        <!-- --------------------Tab Entry---------------------- -->
                                        <div id="Ent" class="tab-pane" style=" position: relative; ">
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
                                                    <div id="list-visit-grid"></div>
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
                                            <div id="list-panel"></div>
                                        </div>
                                        
                                        <!----------------------Tab Visit------------------------->
                                        <div id="Visit" class="tab-pane" style=" position: relative; ">
                                            <div class="row" style="padding-bottom: 1vh;">
                                                <div class="col-md-10">
                                                    <div id='main-btn' >
                                                        <div class="inner"> <div id="load" ></div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: 20px;">
                                                <div class="col-md-12">
                                                    <div id="visit-dxform"></div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: 20px;">
                                                <div class="col-md-12">
                                                    <div id="visit-grid"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="loadpanel"></div> --}}
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
        margin-top:10px;

        width:100%;
        text-align:left;
    }
    .inner{
        display: inline-block;
    }
    #visit-dxform {
        margin-top: 20px;
    }
</style>


{{-- Scripts for this page --}}
<script src="{!! url('asset/js/backend/preblock_visit.js') !!}"></script>
<script>
    // Utility to store/retrieve active tab in localStorage
    function setActiveTab(tabId) {
        localStorage.setItem('preblock_mcl_active_tab', tabId);
    }
    function getActiveTab() {
        return localStorage.getItem('preblock_mcl_active_tab');
    }

    $(document).ready(function() {
        // On page load, activate the tab and pane marked as active or from storage
        var storedTab = getActiveTab();
        var $tabToActivate;
        if (storedTab && $('.nav-tabs a[href="' + storedTab + '"]').length) {
            $tabToActivate = $('.nav-tabs a[href="' + storedTab + '"]');
        } else {
            $tabToActivate = $('.nav-tabs li.active a');
        }
        if ($tabToActivate && $tabToActivate.length) {
            var target = $tabToActivate.attr('href');
            $('.tab-pane').removeClass('active show');
            $('.nav-tabs li').removeClass('active');
            $tabToActivate.parent().addClass('active');
            $(target).addClass('active show');
        }

        $('.nav-tabs a').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            // Remove 'active' and 'show' from all tab-panes and nav-tabs
            $('.tab-pane').removeClass('active show');
            $('.nav-tabs li').removeClass('active');
            // Add 'active' and 'show' to the clicked tab and corresponding pane
            $(this).parent().addClass('active');
            $(target).addClass('active show');
            setActiveTab(target);
        });
    });
    
</script>
@stop
@extends('layouts.backend')
@section('content')

    <section class="content-header">
        <h1>
            Report Sales
            <small>Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i>home</a></li>
            <li><a href="#"><i class="fa fa-truck"></i>here</a></li>
        </ol>
    </section>

    <section class="content">
        <div class=" row">
            <section class="col-md-12 col-lg-12 connectedSortable">
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 id="bartitle" class="box-title">List and Entry</h3>
                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="dx-field">
                            {{-- <div class="dx-fieldset-header">Please Select :</div> --}}
                            <div class="dx-field-value" style="float:left">
                              
                              <div id="slt" class="d-flex align-items-center" style="gap: 16px;">
                                <div>
                                  <label for="period" style="font-weight: 600; margin-bottom: 4px; display: block;">Period</label>
                                  <div id="period"></div>
                                </div>
                                <div>
                                  <label for="district" style="font-weight: 600; margin-bottom: 4px; display: block;">District</label>
                                  <div id="district"></div>
                                </div>
                              </div>
                            </div>

                        </div>
                        <div class="dx-field" style="margin-bottom:20px">
                          <div id="proses" style="margin-top:10px; display: inline-block;"></div>
                          <div id="exportByDistrict" style="margin-top:10px; display: inline-block; margin-left: 10px;"></div>
                        </div>
                        <div id="autoExpand" style="margin-top:10px"></div>
                        <div id="gridContainer" style="padding-top:20px"></div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            var now = new Date();
            var listData = [];
            var select = 1;
            
            $("#period").dxDateBox({
              pickerType: 'calendar',
              displayFormat: 'monthAndYear',
              labelMode: 'outside',
              openOnFieldClick: true,
              calendarOptions: {
                maxZoomLevel: 'year',
                minZoomLevel: 'century',
              },
              width: "20vw",
              type: "date",
              value: now,
              elementAttr: {
                style: "margin-bottom: 16px;"
              }
            });

            $("#district").dxTagBox({
              value: [],
              placeholder: "Select District(s)",
              dataSource: [
                "Northern Sumatra",
                "Bali Nusra",
                "Easter Jakarta",
                "Ecommerce",
                "Far East",
                "Kalimantan",
                "Northern East Java",
                "Northern Central Java",
                "West Java",
                "Western Jakarta",
                "Southern East Java",
                "Southern Central Java",
                "Southern Sumatra"
              ],
              showSelectionControls: true,
              showMultiTagOnly: false,
              selectAllMode: "allPages",
              onValueChanged: function(e) {
              // Handle value change if needed
              },
              width: "20vw"
            });
            

            $("#proses").dxButton({
                text: "View",
                type: "default",

                useSubmitBehavior: true,
                onClick: function(e) {
                    let alm = "";
                    if (select == 0) {
                        alm = "{{ url('/rpt_get_salesPanelAll') }}";
                    } else {
                        alm = "{{ url('/rpt_get_salesPanelperMonth') }}";
                    }

                    var prd = new Date($("#period").dxDateBox("instance").option('value'));

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: alm,
                        data: {
                            "data": prd.toLocaleDateString()
                        },
                        type: "post",
                        success: function(data) {

                            var dataGrid = $('#gridContainer').dxDataGrid('instance');
                            dataGrid.option('dataSource', data.data);
                            dataGrid.refresh();

                        },
                        error: function(xhr, status, response) {
                            errorHandlers(xhr, status);
                        }



                    });
                }
            });

            $("#exportByDistrict").dxButton({
              text: "Export by District",
              type: "success",
                onClick: async function(e) {
                  const exportUrl = "{{ url('/rpt_export_salesPanelByDistrict') }}";
                  const prd = new Date($("#period").dxDateBox("instance").option('value'));
                  const districts = $("#district").dxTagBox("instance").option('value');
                  const postData = {
                    period: prd.toISOString().slice(0, 10),
                    districts
                  };

                  try {
                    const response = await fetch(exportUrl, {
                    method: "POST",
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(postData)
                    });

                    if (!response.ok) throw new Error('Network response was not ok');

                    const blob = await response.blob();
                    let filename = "Sales_Report_By_District.xlsx";
                    const disposition = response.headers.get('Content-Disposition');
                    if (disposition && disposition.includes('filename=')) {
                      filename = `${disposition.split('filename=')[1].replace(/['"]/g, '')}`;
                    }
                    const link = document.createElement('a');
                    const url = window.URL.createObjectURL(blob);
                    link.href = url;
                    link.download = filename;
                    document.body.appendChild(link);
                    link.click();
                    setTimeout(() => {
                      document.body.removeChild(link);
                      window.URL.revokeObjectURL(url);
                    }, 100);
                  } catch (error) {
                    errorHandlers(error, "error");
                  }
                }

            $("#gridContainer").dxDataGrid({
                dataSource: listData,
                allowColumnReordering: true,
                allowColumnResizing: true,
                showRowLines: true,
                columnAutoWidth: true,
                selection: {
                    mode: "single"
                },
                filterRow: {
                    visible: true
                },
                hoverStateEnabled: true,
                groupPanel: {
                    visible: true
                },
                export: {
                    enabled: true,
                    fileName: "Target Product",
                    allowExportSelectedData: true
                },
                showBorders: true,
                paging: {
                    enabled: true,
                    pageIndex: 0,
                    pageSize: 10
                },
                pager: {
                    showPageSizeSelector: true,
                    allowedPageSizes: [10, 25, 50, 100]
                },
                remoteOperations: {
                    paging: true,
                    sorting: true,
                    filtering: true
                },
                columns: [
                  {
                    dataField: "distName",
                    caption: "District",
                    allowEditing: false
                  },
                  {
                    dataField: "areaName",
                    caption: "Area Name",
                    allowEditing: false
                  },
                  {
                    dataField: "empName",
                    caption: "Employee Name",
                    allowEditing: false
                  },
                  {
                    dataField: "oriBranchShortName",
                    caption: "Original Branch",
                    allowEditing: false
                  },
                  {
                    dataField: "branchShortName",
                    caption: "Branch",
                    allowEditing: false
                  },
                  {
                    dataField: "channelName",
                    caption: "Channel Name",
                    allowEditing: false
                  },
                  {
                    dataField: "fullDate",
                    caption: "Reference Date",
                    dataType: "date",
                    format: "shortDate",
                    allowEditing: false
                  },
                  {
                    dataField: "custNewCode",
                    caption: "Customer Code",
                    allowEditing: false
                  },
                  {
                    dataField: "custName",
                    caption: "Customer Name",
                    allowEditing: false
                  },
                  {
                    dataField: "prodGroup",
                    caption: "Product Group",
                    allowEditing: false
                  },
                  {
                    dataField: "prod_name",
                    caption: "Product Name",
                    allowEditing: false
                  },
                  {
                    caption: "CURRENT MONTH",
                    alignment: "center",
                    columns: [
                      {
                        dataField: "gross",
                        caption: "Gross",
                        dataType: "number",
                        format: "fixedPoint",
                        allowEditing: false
                      },
                      {
                        dataField: "qty",
                        caption: "Qty",
                        dataType: "number",
                        format: "fixedPoint",
                        allowEditing: false
                      },
                      {
                        dataField: "discount",
                        caption: "Discount",
                        dataType: "number",
                        format: "fixedPoint",
                        allowEditing: false
                      },
                      {
                        dataField: "netSales",
                        caption: "Nett",
                        dataType: "number",
                        format: "fixedPoint",
                        allowEditing: false
                      }
                    ]
                  },
                  {
                    caption: "LAST YEAR",
                    alignment: "center",
                    columns: [
                      {
                        dataField: "ly_gross",
                        caption: "LY Gross",
                        dataType: "number",
                        format: "fixedPoint",
                        allowEditing: false
                      },
                      {
                        dataField: "ly_qty",
                        caption: "LY Qty",
                        dataType: "number",
                        format: "fixedPoint",
                        allowEditing: false
                      },
                      {
                        dataField: "ly_discount",
                        caption: "LY Discount",
                        dataType: "number",
                        format: "fixedPoint",
                        allowEditing: false
                      },
                      {
                        dataField: "ly_netSales",
                        caption: "LY Nett",
                        dataType: "number",
                        format: "fixedPoint",
                        allowEditing: false
                      }
                    ]
                  }
                ],
                filterRow: {
                    visible: true,
                },
                summary: {

                  groupItems: [{
                      column: "netSales",
                      summaryType: "sum",
                      valueFormat: "fixedPoint",
                      //showInGroupFooter: false,
                      alignByColumn: true,
                      displayFormat: "{0}"
                  }
                  ],
                  totalItems: [{
                          column: "Category",
                          displayFormat: "Grand Total :"
                      },
                      {
                          column: "netSales",
                          summaryType: "sum",
                          valueFormat: "fixedPoint",
                          displayFormat: "{0}"
                      },
                  ]
                }

            });


        });
    </script>

@Stop

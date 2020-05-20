<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Report
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sales Report</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Total sales - Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="manageTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Total sales - Report everyday</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="manageTable_everyday" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Day</th>
                                    <th>Year</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>
    </section>
</div>
<script>
    $(function() {




    })
</script>
<script>
    var manageTable;
    var manage_table_everyday;
    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function() {

        $("#mainOrdersNav").addClass('active');
        $("#manageOrdersNav").addClass('active');

        // initialize the datatable 
        manageTable = $('#manageTable').DataTable({
            'ajax': base_url + 'sales/fetchSalesData',
            'order': []
        });

        // initialize the datatable 
        manage_table_everyday = $('#manageTable_everyday').DataTable({
            'ajax': base_url + 'sales/everydaySales',
            'order': []
        });

        //Date picker
        $('#datepicker_from').datepicker({
            autoclose: true,
            dateFormat: 'yy-mm-dd',

        })
        //Date picker
        $('#datepicker_to').datepicker({
            autoclose: true,
            dateFormat: 'yy-mm-dd',

        })

    });
</script>
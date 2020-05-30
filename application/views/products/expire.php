<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage
            <small>Expire Products</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Products</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manage Products</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-inline inline-sort">
                            <div class="form-group">
                                <input type="text" class="form-control form-sort" name="searchFor" placeholder="Search..." id="searchKey" onchange="sendRequest();">
                            </div>
                            <div class="form-group">
                                <select class="form-control select-sort" id="limitRows" onchange="sendRequest();">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <a href="<?php echo site_url('products/expire_product/'); ?>" class="btn btn-danger">Reset</a>
                        </div>
                        <table id="manageTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Date Expire</th>
                                    <th>Expire Status</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php $i = 1;
                                foreach ($expired as $item) : ?>

                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $item->name ?></td>
                                        <td><?= $item->price ?></td>
                                        <td><?= $item->date_expire ?></td>
                                        <td>
                                            <?php

                                            $expire = strtotime($item->date_expire);
                                            $today = strtotime(date('Y-m-d'));
                                            if ($today >= $expire) {
                                                //count how many days;
                                                $diff = $today - $expire;
                                                $x = abs(floor($diff / (60 * 60 * 24)));
                                                echo "<span class='ci-error'>Product expired</span>";
                                                echo "<br/> <span class='ci-error'>Days : " . $x . '</span>';
                                            } else {
                                                $diff = $today - $expire;
                                                $x = abs(floor($diff / (60 * 60 * 24)));
                                                echo "<span class='ci-active'>Product not expired</span>";
                                                echo "<br/> <span class='ci-active'>Days : " . $x . '</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                        <?php echo $pagination; ?>
                    </div> <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- col-md-12 -->
        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    .ci-error {
        color: red;
    }

    .ci-active {
        color: green;
    }

    .inline-sort {
        margin-bottom: 1.35rem;
    }
</style>
<script>
    var sendRequest = function() {
        var searchKey = $('#searchKey').val();
        var limitRows = $('#limitRows').val();
        window.location.href = '<?= base_url('products/expire_product') ?>?query=' + searchKey + '&limitRows=' + limitRows + '&orderField=' + curOrderField + '&orderDirection=' + curOrderDirection;
        $('.loading').show();
    }


    var getNamedParameter = function(key) {
        if (key == undefined) return false;

        var url = window.location.href;
        //console.log(url);
        var path_arr = url.split('?');
        if (path_arr.length === 1) {
            return null;
        }
        path_arr = path_arr[1].split('&');
        path_arr = remove_value(path_arr, "");
        var value = undefined;
        for (var i = 0; i < path_arr.length; i++) {
            var keyValue = path_arr[i].split('=');
            if (keyValue[0] == key) {
                value = keyValue[1];
                break;
            }
        }

        return value;
    };


    var remove_value = function(value, remove) {
        if (value.indexOf(remove) > -1) {
            value.splice(value.indexOf(remove), 1);
            remove_value(value, remove);
        }
        return value;
    };


    var curOrderField, curOrderDirection;
    $('[data-action="sort"]').on('click', function(e) {
        curOrderField = $(this).data('title');
        curOrderDirection = $(this).data('direction');
        sendRequest();
    });


    $('#searchKey').val(decodeURIComponent(getNamedParameter('query') || ""));
    $('#limitRows option[value="' + getNamedParameter('limitRows') + '"]').attr('selected', true);

    var curOrderField = getNamedParameter('orderField') || "";
    var curOrderDirection = getNamedParameter('orderDirection') || "";
    var currentSort = $('[data-action="sort"][data-title="' + getNamedParameter('orderField') + '"]');
    if (curOrderDirection == "ASC") {
        currentSort.attr('data-direction', "DESC").find('i.fa').removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc');
    } else {
        currentSort.attr('data-direction', "ASC").find('i.fa').removeClass('fa-sort-amount-desc').addClass('fa-sort-amount-asc');
    }
</script>
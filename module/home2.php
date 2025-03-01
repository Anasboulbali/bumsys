	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	        <h1>
	            <?= __("Dashboard"); ?>
	            <small></small>
	        </h1>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	            <li class="active">Dashboard</li>
	        </ol>
	    </section>

	    <!-- Main content -->
	    <section class="content">
	        <!-- Small boxes (Stat box) -->
	        <div class="row">
	            <div class="col-md-4 col-sm-6 col-xs-12">
	                <!-- small box -->
	                <div class="small-box bg-green">
	                    <div class="inner">
	                        <h3><?php
                                $selectSoldQnt =  easySelectD("SELECT if(sum(sales_quantity) is null, 0, sum(sales_quantity)) as totalSales FROM {$table_prefix}sales where YEAR(sales_delivery_date) = YEAR(CURRENT_DATE) and is_trash = 0 group by YEAR(sales_delivery_date)");

                                $soldQnt = 0;
                                if ($selectSoldQnt !== false) {
                                    $soldQnt = number_format($selectSoldQnt["data"][0]["totalSales"], 2);
                                }

                                echo __($soldQnt);

                                ?></h3>

	                        <p><?= __("This Year Product Sales"); ?></p>
	                    </div>
	                    <div class="icon">
	                        <i class="fa fa-shopping-bag"></i>
	                    </div>
	                    <a href="<?php echo full_website_address(); ?>/sales/pos-sale/" class="small-box-footer"><?= __("Sales List"); ?> <i class="fa fa-arrow-circle-right"></i></a>
	                </div>
	            </div>
	            <!-- ./col -->
	            <div class="col-md-4 col-sm-6 col-xs-12">
	                <!-- small box -->
	                <div class="small-box bg-aqua">
	                    <div class="inner">
	                        <h3><?php echo __(easySelectD("SELECT count(DISTINCT sales_customer_id) as totalCustomer FROM {$table_prefix}sales")["data"][0]["totalCustomer"]); ?></h3>

	                        <p><?= __("Total Customers"); ?></p>
	                    </div>
	                    <div class="icon">
	                        <i class="fa fa-user"></i>
	                    </div>
	                    <a href="<?php echo full_website_address(); ?>/peoples/customer-list/" class="small-box-footer"><?= __("Customers List"); ?> <i class="fa fa-arrow-circle-right"></i></a>
	                </div>
	            </div>
	            <!-- ./col -->
	            <div class="col-md-4 col-sm-6 col-xs-12">
	                <!-- small box -->
	                <div class="small-box bg-yellow">
	                    <div class="inner">
	                        <h3><?php echo __(easySelectD("SELECT count(product_id) as totalProduct FROM {$table_prefix}products")["data"][0]["totalProduct"]); ?></h3>

	                        <p><?= __("Total Products"); ?></p>
	                    </div>
	                    <div class="icon">
	                        <i class="fa fa-cube"></i>
	                    </div>
	                    <a href="<?php echo full_website_address(); ?>/products/product-list/" class="small-box-footer"><?= __("Products List"); ?> <i class="fa fa-arrow-circle-right"></i></a>
	                </div>
	            </div>
	            <!-- ./col -->
	        </div>
	        <!-- /.row -->

	        <!-- Chart -->
	        <div class="row">
	            <div class="col-lg-12">
	                <div class="box box-primary">
	                    <div class="box-header with-border">
	                        <h3 class="box-title"><?= __("Sales Overview"); ?></h3>
	                    </div>
	                    <div class="box-body">
	                        <div class="chart">
	                            <canvas id="overviewChart" style="height: 300px"></canvas>
	                        </div>
	                    </div>

	                    <div class="box-footer">
	                        <div class="row">
	                            <div class="col-sm-3 col-xs-6">
	                                <div class="description-block border-right">
	                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
	                                    <h5 class="description-header">$35,210.43</h5>
	                                    <span class="description-text">TOTAL REVENUE</span>
	                                </div>
	                                <!-- /.description-block -->
	                            </div>
	                            <!-- /.col -->
	                            <div class="col-sm-3 col-xs-6">
	                                <div class="description-block border-right">
	                                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
	                                    <h5 class="description-header">$10,390.90</h5>
	                                    <span class="description-text">TOTAL COST</span>
	                                </div>
	                                <!-- /.description-block -->
	                            </div>
	                            <!-- /.col -->
	                            <div class="col-sm-3 col-xs-6">
	                                <div class="description-block border-right">
	                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
	                                    <h5 class="description-header">$24,813.53</h5>
	                                    <span class="description-text">TOTAL PROFIT</span>
	                                </div>
	                                <!-- /.description-block -->
	                            </div>
	                            <!-- /.col -->
	                            <div class="col-sm-3 col-xs-6">
	                                <div class="description-block">
	                                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
	                                    <h5 class="description-header">1200</h5>
	                                    <span class="description-text">Total Sales </span>
	                                </div>
	                                <!-- /.description-block -->
	                            </div>
	                        </div>
	                        <!-- /.row -->
	                    </div>
	                    <!-- /.box-footer -->

	                </div>
	            </div>
	        </div>

	        <div class="row">
	            <!-- Top Customer of this product -->
	            <div class="col-sm-12 col-lg-6">
	                <div class="box box-info">
	                    <div class="box-header">
	                        <h3 class="box-title"><?= __("Top Sold Products of %d", date("Y")); ?></h3>
	                    </div>
	                    <div class="box-body">
	                        <table class="table table-bordered table-striped table-hover" style="width: 100%;">
	                            <thead>
	                                <tr>
	                                    <th class="no-sort"><?= __("Product Name"); ?></th>
	                                    <th class="text-right"><?= __("Sold Qnt"); ?></th>
	                                </tr>
	                            </thead>

	                            <tbody>
	                                <?php
                                    $topProduct = easySelectA(array(
                                        "table"   => "product_stock as product_stock",
                                        "fields"  => "product_name, product_unit, sum(stock_item_qty) as totalItemQnt",
                                        "join"    => array(
                                            "left join {$table_prefix}products on stock_product_id = product_id"
                                        ),
                                        "where"   => array(
                                            "product_stock.is_trash = 0 and stock_type"  => 'sale',
                                            ""
                                        ),
                                        "having" => array(
                                            "max(stock_entry_date) >= CONCAT(YEAR(CURRENT_DATE),'-',01,'-',01) AND max(stock_entry_date) <= CONCAT(YEAR(CURRENT_DATE),'-',12,'-',31)"
                                        ),
                                        "groupby" => "stock_product_id",
                                        "orderby" => array(
                                            "sum(stock_item_qty)" => "DESC"
                                        ),
                                        "limit" => array(
                                            "start"   => 0,
                                            "length"  => 10
                                        )
                                    ));
                                    $num = 1;
                                    if ($topProduct) {
                                        foreach ($topProduct["data"] as $key => $product) {
                                            echo "<tr>";
                                            echo  "<td>$num. {$product['product_name']}</td>";
                                            echo  "<td class='text-right'>" . __(number_format($product['totalItemQnt'], 2)) . " " . __($product['product_unit']) . "</td>";
                                            echo "</tr>";
                                            $num++;
                                        }
                                    } else {
                                        echo "
												<tr>
													<td class='text-center' colspan='2'>No Data Found!</td>
												</tr>
											";
                                    }

                                    ?>
	                            </tbody>

	                        </table>
	                    </div>
	                </div>
	            </div> <!-- /.Col -->

	            <!-- Top Customer of this product -->
	            <div class="col-sm-12 col-lg-6">
	                <div class="box box-info">
	                    <div class="box-header">
	                        <h3 class="box-title"><?= __("Low Product Stock"); ?></h3>
	                    </div>
	                    <div class="box-body">
	                        <table class="table table-bordered table-striped table-hover" style="width: 100%;">
	                            <thead>
	                                <tr>
	                                    <th class="no-sort"><?= __("Product Name"); ?></th>
	                                    <th class="text-right"><?= __("Left Stock"); ?></th>
	                                </tr>
	                            </thead>

	                            <tbody>
	                                <?php

                                    $select_low_product = easySelectD("
                                                                    SELECT 
                                                                        pbs.vp_id as pid, 
                                                                        product_name, product_unit, 
                                                                        round(sum(base_stock_in), 2) as base_stock_in,
                                                                        base_qty
                                                                    FROM product_base_stock as pbs -- Product Base Stock
                                                                    left join {$table_prefix}products as product on product.product_id = pbs.vp_id
                                                                    where batch_id is null or date(batch_expiry_date) > curdate()
                                                                    GROUP BY pbs.vp_id
                                                                    order by base_stock_in ASC
                                                                    limit 0,10
                                                            ");

                                    $num = 1;
                                    if ($select_low_product) {
                                        foreach ($select_low_product["data"] as $key => $product) {
                                            echo "<tr>";
                                            echo  "<td>$num. {$product['product_name']}</td>";
                                            echo  "<td class='text-right'>" . __(number_format($product['base_stock_in'] / $product['base_qty'], 2)) . " " . __($product['product_unit']) . "</td>";
                                            echo "</tr>";
                                            $num++;
                                        }
                                    } else {
                                        echo "
											<tr>
												<td class='text-center' colspan='2'>No Data Found!</td>
											</tr>
										";
                                    }

                                    ?>
	                            </tbody>

	                        </table>
	                    </div>
	                </div>
	            </div> <!-- /.Col -->

	        </div> <!-- /.Row -->


	    </section> <!-- Main content End tag -->
	    <!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<?php

    $salesData = easySelectD("
			select sales_delivery_date, sum(sales_quantity) as sales_quantity from {$table_prefix}sales where is_trash = 0 and sales_delivery_date >= DATE_SUB(NOW(), INTERVAL 30 DAY) group by sales_delivery_date
		");

    $dateStart = date('Y-m-d', strtotime('today - 30 days'));

    $i = 0;
    $newdate = array();
    $newvalue = array();

    while ($dateStart <= date("Y-m-d")) {

        $dateStart = date("Y-m-d", strtotime("$dateStart + 1 day"));

        if (isset($salesData["data"][$i]) && $salesData["data"][$i]["sales_delivery_date"] == $dateStart) {

            array_push($newdate, $salesData["data"][$i]["sales_delivery_date"]);
            array_push($newvalue, $salesData["data"][$i]["sales_quantity"]);
            $i++;
        } else {

            array_push($newdate, $dateStart);
            array_push($newvalue, 0);
        }
    }

    $salesDate = __(json_encode($newdate));
    $salesAmount = json_encode($newvalue);

    ?>

	<script src="<?php echo full_website_address(); ?>/assets/3rd-party/chart.js/Chart.min.js"></script>

	<script>
	    var ctx = document.getElementById('overviewChart');
	    var myLineChart = new Chart(ctx, {
	        type: 'line',
	        data: {
	            labels: <?php echo $salesDate; ?>,
	            datasets: [{
	                label: "<?= __("Sales"); ?>",
	                borderColor: "green",
	                borderWidth: 2,
	                data: <?php echo $salesAmount; ?>
	            }]
	        },
	        options: {
	            responsive: true,
	            tooltips: {
	                mode: 'index',
	                intersect: false
	            }
	        }
	    });
	</script>
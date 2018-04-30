            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-recycle fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo Product::count_products_by_status(1); ?></div>
                                                <div>Unlisted Products</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="unlisted_products.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span> 
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-barcode fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo Product::count_products_by_status(2); ?></div>
                                                <div>Listed Products</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="listed_products.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fas fa-money-bill-alt fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo Product::count_products_by_status(3); ?></div>
                                                <div>Sold Products</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="sold_products.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            

                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fas fa-truck fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo Product::count_products_by_status(4); ?></div>
                                                <div>Shipped Products</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="sold_products.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fas fa-fw fa-check-square fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo Product::count_products_by_status(6); ?></div>
                                                <div>Completed Products</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="sold_products.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fas fa-chart-line fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">$<?php echo Product::get_total_sales(); ?></div>
                                                <div>Total Sales</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="sales_reports.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                        </div> <!--First Row-->
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col col-md-12 col-lg-6">
                        <div id="chart_div_1" style="width: 100%; height: 500px;"></div>
                    </div>
                    <div class="col col-md-12 col-lg-6">
                        <div id="chart_div_2" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
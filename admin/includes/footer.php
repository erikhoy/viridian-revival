  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <script src="js/dropzone.js"></script>
    
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function getDateArgument(x, y) {
        return <?php echo Product::get_sales_by_month_and_year(x, x+1, 2018); ?>;
      }
      function drawChart() {
        var monthArray = ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'];
        // var chartArray = new Array;
        var currentYear = 2018;
         // chartArray[0] = ['Month', (currentYear-1), currentYear];
        // for(var i=0; i<=12; i++) {
        //   chartArray[i+1] = [monthArray[i], <?php echo Product::get_sales_by_month_and_year(1, 2, 2017); ?>, <?php echo Product::get_sales_by_month_and_year(1,2, 2018); ?>]);
        // }
        var chartArray = new Array();
        chartArray[0] = ['Month', '2017', '2018'];
        for (var i=0; i<1; i++) {
          chartArray[i+1] = [monthArray[i], getDateArgument(i,currentYear-1), getDateArgument(i,currentYear)];
        }
        var data = google.visualization.arrayToDataTable(chartArray,false);
        // var data = google.visualization.arrayToDataTable([
        //   ['Month', '2017', '2018'],
        //   ['J',  <?php echo Product::get_sales_by_month_and_year(1,2,2017); ?>, <?php echo Product::get_sales_by_month_and_year(1,2,2018); ?>]
        // ]);

        var options = {
          title: 'Sales by Month',
          hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div_1'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', '2017', '2018'],
          ['J',  <?php echo get_sales(1,2,2017); ?>, <?php echo get_sales(1,2,2018); ?>],
          ['F',  <?php echo Product::get_expenses_by_month_and_year(2,3,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(2,3,2018); ?>],
          ['M',  <?php echo Product::get_expenses_by_month_and_year(3,4,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(3,4,2018); ?>],
          ['A',  <?php echo Product::get_expenses_by_month_and_year(4,5,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(4,5,2018); ?>],
          ['M',  <?php echo Product::get_expenses_by_month_and_year(5,6,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(5,6,2018); ?>],
          ['J',  <?php echo Product::get_expenses_by_month_and_year(6,7,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(6,7,2018); ?>],
          ['J',  <?php echo Product::get_expenses_by_month_and_year(7,8,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(7,8,2018); ?>],
          ['A',  <?php echo Product::get_expenses_by_month_and_year(8,9,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(8,9,2018); ?>],
          ['S',  <?php echo Product::get_expenses_by_month_and_year(9,10,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(9,10,2018); ?>],
          ['O',  <?php echo Product::get_expenses_by_month_and_year(10,11,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(10,11,2018); ?>],
          ['N',  <?php echo Product::get_expenses_by_month_and_year(11,12,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(11,12,2018); ?>],
          ['D',  <?php echo Product::get_expenses_by_month_and_year(12,13,2017); ?>, <?php echo Product::get_expenses_by_month_and_year(12,13,2018); ?>]
        ]);

        var options = {
          title: 'Expenses by Month',
          hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div_2'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      var get_sales = Product::get_sales_by_month_and_year;

      function drawChart() {
        
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Expenses', 'Sales'],
          ['J',  <?php echo Product::get_expenses_by_month_and_year(1,2,2018); ?>, <?php echo get_sales(1,2,2018); ?>],
          ['F',  <?php echo Product::get_expenses_by_month_and_year(2,3,2018); ?>, <?php echo get_sales(2,3,2018); ?>],
          ['M',  <?php echo Product::get_expenses_by_month_and_year(3,4,2018); ?>, <?php echo get_sales(3,4,2018); ?>],
          ['A',  <?php echo Product::get_expenses_by_month_and_year(4,5,2018); ?>, <?php echo get_sales(4,5,2018); ?>],
          ['M',  <?php echo Product::get_expenses_by_month_and_year(5,6,2018); ?>, <?php echo get_sales(5,6,2018); ?>],
          ['J',  <?php echo Product::get_expenses_by_month_and_year(6,7,2018); ?>, <?php echo get_sales(6,7,2018); ?>],
          ['J',  <?php echo Product::get_expenses_by_month_and_year(7,8,2018); ?>, <?php echo get_sales(7,8,2018); ?>],
          ['A',  <?php echo Product::get_expenses_by_month_and_year(8,9,2018); ?>, <?php echo get_sales(8,9,2018); ?>],
          ['S',  <?php echo Product::get_expenses_by_month_and_year(9,10,2018); ?>, <?php echo get_sales(9,10,2018); ?>],
          ['O',  <?php echo Product::get_expenses_by_month_and_year(10,11,2018); ?>, <?php echo get_sales(10,11,2018); ?>],
          ['N',  <?php echo Product::get_expenses_by_month_and_year(11,12,2018); ?>, <?php echo get_sales(11,12,2018); ?>],
          ['D',  <?php echo Product::get_expenses_by_month_and_year(12,13,2017); ?>, <?php echo get_sales(12,13,2018); ?>]
        ]);

        var options = {
          title: 'Expenses vs Sales for 2018',
          hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div_3'));
        chart.draw(data, options);
      }
    </script>
    
    <script>
      // $( function() {
      //   $( "#accordion" ).accordion();
      // } );
    </script>
    <script>
      lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
      })
    </script>
</body>

</html>

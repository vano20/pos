  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- WYSIWYG -->
    <!-- <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script> -->
    <script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script src="js/scripts.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Sukses',    <?=$_GET['success']?>],
          ['Gagal',     <?=$_GET['cancel']?>]
        ]);

        var options = {
          legend: 'none',
          pieSliceText: 'label',
          title: 'Grafik Penjualan',
          backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    
</body>

</html>

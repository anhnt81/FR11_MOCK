@if(empty($data))
    <div style='font-size: 2em; font-weight: bold;'>Không có đơn hàng nào</div>
@else
    <!-- Best of selling Category Chart -->
    <div class='panel panel-info'>
        <div class='panel-heading'>
            <h3 class='panel-title'>Theo chuyên mục sản phẩm</h3>
        </div>
        <div class='panel-body'>
            <div id="cat-order" class='chart-report col-xs-12 col-md-6'></div>
            <div id="cat-qty" class='chart-report col-xs-12 col-md-6'></div>
        </div>
    </div>


    <!-- Best of selling Brand Chart -->
    <div class='panel panel-info'>
        <div class='panel-heading'>
            <h3 class='panel-title'>Theo thương hiệu sản phẩm</h3>
        </div>
        <div class='panel-body'>
            <div id="br-order" class='chart-report col-xs-12 col-md-6'></div>
            <div id="br-qty" class='chart-report col-xs-12 col-md-6'></div>
        </div>
    </div>

    <!-- Best of selling Brand Chart -->
    <div class='panel panel-info'>
        <div class='panel-heading'>
            <h3 class='panel-title'>Top 5 sản phẩm</h3>
        </div>
        <div class='panel-body'>
            <div id="prd-order" class='chart-report col-xs-12 col-md-6'></div>
            <div id="prd-qty" class='chart-report col-xs-12 col-md-6'></div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/loader.js') }}"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Cat', 'Category Total Order'],
                @foreach ($data['catOrder'] as $key => $value)
                ['{{$key}}', {{$value}}],
                @endforeach
            ]);

            var options = {
                title: 'Theo số lượng đơn hàng'
            };

            var chart = new google.visualization.PieChart(document.getElementById('cat-order'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Cat', 'Category Quantity Product'],
                @foreach ($data['catQty'] as $key => $value)
                ['{{$key}}', {{$value}}],
                @endforeach
            ]);

            var options = {
                title: 'Theo số lượng sản phẩm bán ra',
            };

            var chart = new google.visualization.PieChart(document.getElementById('cat-qty'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Brand', 'Brand Total Order'],
                @foreach ($data['brOrder'] as $key => $value)
                ['{{$key}}', {{$value}}],
                @endforeach
            ]);

            var options = {
                title: 'Theo sô lượng đơn hàng'
            };

            var chart = new google.visualization.PieChart(document.getElementById('br-order'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Brand', 'Brand Quantity Product'],
                @foreach ($data['brQty'] as $key => $value)
                ['{{$key}}', {{$value}}],
                @endforeach
            ]);

            var options = {
                title: 'Theo số lượng sản phẩm bán ra'
            };

            var chart = new google.visualization.PieChart(document.getElementById('br-qty'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Theo đơn hàng', ''],
                @foreach ($data['prdOrder'] as $key => $value)
                ['{{$key}}', {{$value}}],
                @endforeach
            ]);

            var options = {
                title: 'Theo đơn hàng',
                bars: 'horizontal'
            };

            var chart = new google.charts.Bar(document.getElementById('prd-order'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Theo số lượng bán ra', ''],
                @foreach ($data['prdQty'] as $key => $value)
                ['{{$key}}', {{$value}}],
                @endforeach
            ]);

            var options = {
                title: 'Theo sô lượng bán ra',
                bars: 'horizontal'
            };

            var chart = new google.charts.Bar(document.getElementById('prd-qty'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endif
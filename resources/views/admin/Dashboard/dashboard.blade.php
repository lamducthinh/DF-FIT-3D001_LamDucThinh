@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thống kê số lượng lịch làm theo tháng và số lượng từng loại ca làm</h3>
                        </div>
                        <div id="comboChart" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js-custom')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var result = {!! json_encode($result) !!};

        // Gộp dữ liệu cho cùng một tháng
        var groupedData = [];
        var months = [];
        for (var i = 1; i < result.length; i++) {
            var month = result[i][0];
            if (months.indexOf(month) === -1) {
                months.push(month);
                groupedData.push([month, 0, 0, 0]); // Gộp thêm dữ liệu cho mỗi tháng
            }
            groupedData[months.indexOf(month)][1] += result[i][1];
            groupedData[months.indexOf(month)][2] += result[i][2];
            groupedData[months.indexOf(month)][3] += result[i][3];
        }

        var data = google.visualization.arrayToDataTable([
            ['Số tháng nhân viên làm', 'Ca A', 'Ca B', 'Số lượng'],
            ...groupedData
        ]);

        var options = {
            title: 'Thống kê số lượng lịch làm theo tháng và số lượng từng loại ca làm',
            isStacked: true, // Chồng các cột lên nhau
            seriesType: 'line', // Biểu đồ đường cho shift_id
            series: { 0: { targetAxisIndex: 1 } },
            vAxes: {
                0: { title: 'Số lượng ca B', format: '#' }, // Trục y chính cho cột month
                1: { title: 'Số lượng ca A', format: '#', minValue: 0 } // Trục y phụ cho đường shift_id
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('comboChart'));

        chart.draw(data, options);
    }
</script>
@endsection

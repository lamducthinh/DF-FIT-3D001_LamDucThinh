@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                
                <div class="col-lg-12"> <!-- Đổi col-lg-8 thành col-lg-12 để sử dụng toàn bộ chiều rộng -->
                    <h1>DashBoard</h1>

                    <div class="card card-primary">
                        <div class="row">
                            <!-- Earnings (Monthly) Card Example -->
                            
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Tổng số giờ làm:</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalHoursWorked}} giờ</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Earnings (Monthly) Card Example -->
                            {{-- <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Earnings (Annual)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                   Người có số ca làm nhiều nhất:
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $mostActiveUser ? $mostActiveUser->name : 'No employee' }} :    {{ $numberOfSchedules }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="card-body">
                        <div id="columnChart" style="width: 100%; height: 400px;"></div>
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

        // Tạo một mảng chứa dữ liệu chuẩn để vẽ biểu đồ
        var chartData = [['Tháng', 'Ca A', 'Ca B']];
        for (var i = 1; i < result.length; i++) {
            var month = result[i][0];
            var caA = Math.round(result[i][1]); // Làm tròn số ca A
            var caB = Math.round(result[i][2]); // Làm tròn số ca B
            chartData.push([month, caA, caB]);
        }

        var data = google.visualization.arrayToDataTable(chartData);

        var options = {
            title: 'Thống kê số lượng lịch làm theo tháng và số lượng từng loại ca làm',
            isStacked: true, // Chồng các cột lên nhau
            series: {
                0: { targetAxisIndex: 0, color: '#ff5e78' }, // Cột A
                1: { targetAxisIndex: 1, color: '#4571f4' }  // Cột B
            },
            vAxis: {
                title: 'Số lượng', // Tiêu đề trục y
                format: '0' // Định dạng giá trị trục y
            },
            bar: { groupWidth: '20%' }, // Điều chỉnh kích thước của cột
            legend: { position: 'top' } // Vị trí của chú thích
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('columnChart'));

        chart.draw(data, options);
    }
    
</script>
@endsection

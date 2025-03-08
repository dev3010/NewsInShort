@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Stats Cards -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $stats['total_articles'] ?? '125' }}</h3>
                        <p>Total Articles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $stats['total_users'] ?? '0' }}</h3>
                        <p>Registered Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['top_category'] ?? 'N/A' }}</h3>
                        <p>Trending Category</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category Distribution</h3>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>

        <!-- Recent News Table -->
        {{-- <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent News</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Source</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentNews ?? [] as $article)
                        <tr>
                            <td>{{ $article['title'] }}</td>
                            <td>{{ $article['category'] }}</td>
                            <td>{{ $article['source'] }}</td>
                            <td>{{ $article['date'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}

        <!-- Activity Logs -->
        {{-- <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Activity</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($activities ?? [] as $activity)
                    <li class="list-group-item">
                        <i class="fas fa-bolt mr-2"></i>{{ $activity }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div> --}}
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(function () {
            // Dummy Chart Data
            var ctx = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Technology', 'Sports', 'Business', 'Entertainment'],
                    datasets: [{
                        data: [45, 20, 15, 20],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }
            });
        });
    </script>
@stop
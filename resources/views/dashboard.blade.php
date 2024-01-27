@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="container mt-5">
                <h2>Barangay LGU's Statistics</h2>
                <canvas id="barChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="container mt-5">
                <h2>Total Residents Registered per Month</h2>
                <canvas id="lineChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Dummy data for demonstration purposes
        var res = @json($results->pluck('role'));
        var restotals = @json($results->pluck('total'));

        console.log(res);
        console.log(restotals);
        var data = {
            labels: res,
            datasets: [{
                label: "Total LGU's",
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(200, 70, 140, 0.2)', 'rgba(99, 99, 132, 0.2)'],
                borderColor: ['rgba(75, 192, 192)', 'rgba(255, 99, 132)', 'rgba(200, 70, 140)', 'rgba(99, 99, 132)'],
                borderWidth: 1,
                data: restotals, // Dummy data
            }]
        };

        // Bar chart
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // You can also create a line chart using the same data
        var months = @json($residentsData->pluck('month'));
            var totals = @json($residentsData->pluck('total'));

            var data2 = {
                labels: months,
                datasets: [{
                    label: 'Total Residents Registered',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    data: totals,
                }]
            };

            // Line chart
            var ctxLine = document.getElementById('lineChart').getContext('2d');
            var lineChart = new Chart(ctxLine, {
                type: 'line',
                data: data2,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


    });
</script>


@endsection
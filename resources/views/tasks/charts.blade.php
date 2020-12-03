@extends('layouts.app')

@section('content')
    <div class="contaner col-md-4 d-flex">
        <canvas id="pieChart" width="300" height="300">
        </canvas>
        <canvas class="pl-5" id="barChart" width="300" height="300">
        </canvas>

    </div>
@endsection


@section('customJS')
    <script src="{{ asset('/js/Chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var ctxPie = $('#pieChart');

            // pie
            var myChart = new Chart(ctxPie, {
                type: "doughnut",
                data: {
                    labels: ['未完成', '已完成', '总任务'],
                    datasets: [{
                        label: '# of Votes',
                        data: [{{$todo}}, {{$done}}, {{$total}}],
                        backgroundColor: [
                            'rgba(255, 99, 132, .6)',
                            'rgba(54, 162, 235, .6)',
                            'rgba(255, 206, 86, .6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: '所有任务的完成比例:{{ ($done / $total) * 100 }}%'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            }
                        }]
                    },
                    layout: {
                        padding: {
                            left: 100,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                },


            })

            //bar
                var ctxBar = $('#barChart');

                var data = {
                    // labels: ['未完成', '已完成', '总任务'],
                    labels: {!! $names !!},
                        datasets: [{
                            backgroundColor: [
                            'rgba(255, 99, 132, .6)',
                            'rgba(54, 162, 235, .6)',
                            'rgba(255, 206, 86, .6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        // 再 helper 全局函数里定义过的辅助函数
                            data: {{TaskCountArray($projects)}}
                        }]
                    };

                var options = {
                    scales: {
                        xAxes: [{
                            gridLines: {
                                offsetGridLines: true
                            }
                        }]
                    }
                };
                var myBarChart = new Chart(barChart, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: '项目分类'
                    },
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
        })

    </script>

@endsection

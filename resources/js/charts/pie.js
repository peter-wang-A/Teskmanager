var ctxPie = $("#pieChart");
var todo = $("#pie-data").data("todo");
var done = $("#pie-data").data("done");
var total = $("#pie-data").data("total");
// pie
var myChart = new Chart(ctxPie, {
    type: "doughnut",
    data: {
        labels: ["未完成", "已完成", "总任务"],
        datasets: [
            {
                label: "# of Votes",
                data: [todo, done, total],
                backgroundColor: [
                    "rgba(255, 99, 132, .6)",
                    "rgba(54, 162, 235, .6)",
                    "rgba(255, 206, 86, .6)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)"
                ],
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        tooltips: {
            mode: 'point'
        },
        title: {
            display: true,
            text: "所有任务的完成比例:" + total + "%"
        },
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true
                    }
                }
            ]
        },
        layout: {
            padding: {
                left: 100,
                right: 0,
                top: 0,
                bottom: 0
            }
        }
    }
});

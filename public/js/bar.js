//bar
var names = $("#bar-data").data("names");
var projects = $("#bar-data").data("projects");
var ctxBar = $('#barChart');
var data = {
    labels: names,
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
            data:projects,
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

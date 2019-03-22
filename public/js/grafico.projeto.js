$(document).ready(function () {
    var ctx = document.getElementById('myChart');
    var ctx = document.getElementById('myChart').getContext('2d');
    var ctx = $('#myChart');
    var ctx = 'myChart';
    var colunas = [],
        valores = []
    cores = [], indice = 0;


    $.each(dados, function (key, value) {
        colunas.push(key);
        valores.push(value)
        cores.push(getRandomColorHex());
        indice += value;
    });

    indice /= (valores.length);

    $("#indice").append("= " + indice.toFixed(2));

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: colunas,
            datasets: [{
                data: valores,
                backgroundColor: cores,
                borderWidth: 0
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem) {
                        return tooltipItem.yLabel;
                    }
                }
            }

        }
    });

    function getRandomColorHex() {
        var hex = "0123456789ABCDEF",
            color = "#";
        for (var i = 1; i <= 6; i++) {
            color += hex[Math.floor(Math.random() * 16)];
        }
        return color;
    }



});

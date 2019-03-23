$(document).ready(function () {
    var ctx = document.getElementById('myChart');
    var ctx = document.getElementById('myChart').getContext('2d');
    var ctx = $('#myChart');
    var ctx = 'myChart';
    var target = document.getElementById('indice');
    var gauge;  
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

    var opts = {
        angle: -0.1, 
        lineWidth: 0.07,
        radiusScale: 1, 
        pointer: {
          length: 0.5,
          strokeWidth: 0.046, 
          color: '#000000' 
        },
        staticZones: [
            {strokeStyle: "#F03E3E", min: 0, max: 20}, 
            {strokeStyle: "#FFDD00", min: 21, max: 60}, 
            {strokeStyle: "#30B32D", min: 61, max: 100}, 
         ],
         staticLabels: {
            font: "12px sans-serif", 
            labels: [0,10,20,30,40,50,60,70,80,90,100],  
            color: "#000000",  
            fractionDigits: 0  
          },
        limitMax: false,     
        limitMin: false,     
        generateGradient: true,
        highDpiSupport: true, 
        renderTicks: {
          divisions: 10,
          divWidth: 0.7,
          divLength: 0.5,
          divColor: '#333333',
          subDivisions: 10,
          subLength: 0.3,
          subWidth: 0.5,
          subColor: '#666666'
        },
        colorStart: '#6FADCF',
        colorStop: '#8FC0DA',   
        strokeColor: '#E0E0E0',
        generateGradient: true,
        highDpiSupport: true,    
        
      };  
      gauge = new Gauge(target).setOptions(opts);  
      gauge.maxValue = 100;
      gauge.setMinValue(0); 
      gauge.animationSpeed = 22; 
      gauge.set(isNaN(indice) ? 0 : indice);
      target.title = indice.toFixed(2);      

    $("#numero").append("Índice = " + (isNaN(indice) ? 0 : indice.toFixed(2)));

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
                        beginAtZero: true,
                        max: 100
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


    $('#idArea').on('change', function(e){
        $(this).closest('form').submit();
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

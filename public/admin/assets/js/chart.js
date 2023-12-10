window.onload = function () {
    var statistics = {};
    var chartData = {};
    fetch('sales_api.php').then(response => response.json())
    .then(data => {
        statistics = data;
        //console.log(statistics);
        const result = [];

        statistics.forEach(item => {
            const orderMonth = item['order_month'];
            const productName = item['product_name'];
            const totalAmount = parseFloat(item['total_amount']); // Convert total_amount to float

            if (!result[productName]) {
                result[productName] = {
                    type: 'line',
                    axisYType: 'secondary',
                    name: productName,
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: '₱#,###',
                    dataPoints: []
                };
            }

            // Format the date using the Date object
            const formattedDate = new Date(orderMonth);

            result[productName].dataPoints.push({ x: formattedDate, y: totalAmount });
        });

        const finalResult = Object.values(result);
            console.log(result);
            console.log(finalResult);
            chartData = finalResult;
            console.log(chartData);
        var chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: "Bogszilogs Sales"
        },
        axisX: {
            valueFormatString: "MMM YYYY"
        },
        axisY2: {
            title: "Revenue",
            prefix: "₱"
        },
        toolTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            verticalAlign: "top",
            horizontalAlign: "center",
            dockInsidePlotArea: true,
            itemclick: toogleDataSeries
        },
        data: chartData
    });

    chart.render();

    function toogleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else{
            e.dataSeries.visible = true;
        }
        chart.render();
    }
           
    });
    

    }
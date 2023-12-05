window.onload = function () {

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
        data: [{
            type:"line",
            axisYType: "secondary",
            name: "Bento",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "₱#,###",
            dataPoints: [		
                { x: new Date(2023, 1, 1), y: 850 },
                { x: new Date(2023, 1, 10), y: 889 },
                { x: new Date(2023, 2, 1), y: 890 },
                { x: new Date(2023, 3, 1), y: 899 },
                { x: new Date(2023, 4, 1), y: 903 },
                { x: new Date(2023, 5, 1), y: 925 },
                { x: new Date(2023, 6, 1), y: 899 },
                { x: new Date(2023, 7, 1), y: 875 },
                { x: new Date(2023, 8, 1), y: 927 },
                { x: new Date(2023, 9, 1), y: 949 }
            ]
        },
        {
            type: "line",
            axisYType: "secondary",
            name: "Honey BBQ Beef",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "₱#,###",
            dataPoints: [
                { x: new Date(2023, 1, 1), y: 1200 },
                { x: new Date(2023, 1, 12), y: 1200 },
                { x: new Date(2023, 2, 1), y: 1190 },
                { x: new Date(2023, 3, 1), y: 1180 },
                { x: new Date(2023, 4, 1), y: 1250 },
                { x: new Date(2023, 5, 1), y: 1270 },
                { x: new Date(2023, 6, 1), y: 1300 },
                { x: new Date(2023, 7, 1), y: 1300 },
                { x: new Date(2023, 8, 1), y: 1358 },
                { x: new Date(2023, 9, 1), y: 1410 }
                
            ]
        },
        {
            type: "line",
            axisYType: "secondary",
            name: "Tosilog",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "₱#,###",
            dataPoints: [
                { x: new Date(2023, 1, 1), y: 409 },
                { x: new Date(2023, 1, 15), y: 415 },
                { x: new Date(2023, 2, 1), y: 419 },
                { x: new Date(2023, 3, 1), y: 429 },
                { x: new Date(2023, 4, 1), y: 429 },
                { x: new Date(2023, 5, 1), y: 450 },
                { x: new Date(2023, 6, 1), y: 450 },
                { x: new Date(2023, 7, 1), y: 445 },
                { x: new Date(2023, 8, 1), y: 450 },
                { x: new Date(2023, 9, 1), y: 450 }
            ]
        },
        {
            type: "line",
            axisYType: "secondary",
            name: "Teriyaki",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "₱####",
            dataPoints: [
                { x: new Date(2023, 1, 1), y: 529 },
                { x: new Date(2023, 2, 4), y: 540 },
                { x: new Date(2023, 2, 1), y: 539 },
                { x: new Date(2023, 3, 1), y: 565 },
                { x: new Date(2023, 4, 1), y: 575 },
                { x: new Date(2023, 5, 1), y: 579 },
                { x: new Date(2023, 6, 1), y: 589 },
                { x: new Date(2023, 7, 1), y: 579 },
                { x: new Date(2023, 8, 1), y: 579 },
                { x: new Date(2023, 9, 1), y: 579 }
                
            ]
        }]
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

    }
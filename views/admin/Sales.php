<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://www.cssscript.com/demo/sticky.css" rel="stylesheet" type="text/css">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../public/admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../public/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"  rel="stylesheet">
    <link href="../../public/admin/css/style.css" rel="stylesheet">

    <link href="../../public/admin/css/style2.css" rel="stylesheet">
    <title>Expanding Sidebar Navigation Example</title>
  </head>
  <body>
    <div class="container">
      <aside class="sidebar">
        <ul class="menu-list">
          <li>
            <div class="menu-container">
              <a href="#" class="icon" id="menu">
                <img src="../../public/admin/img/menu.svg" alt="menu" />
              </a>
            </div>
          </li>
          <li>
            <a href="#" class="icon" id="search">
              <img src="../../public/admin/img/search.svg" alt="search" />
            </a>
          </li>
          <li>
                <a href="Dashboard.php" class="icon" id="dashboard">
                <img src="../../public/admin/img/grid.svg" alt="dashboard" />
                </a>
          </li>
          <li>
            <a href="Sales.php" class="icon nav-item nav-link active" id="Sales">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 17 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 12v5m5-9v9m5-5v5m5-9v9M1 7l5-6 5 6 5-6"/>
                </svg>
            </a>
          </li>
          <li>
            <a href="Products.php" class="icon nav-item nav-link" id="Products">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.876.517A1 1 0 0 0 17 0H3a1 1 0 0 0-.871.508C1.63 1.393 0 5.385 0 6.75a3.236 3.236 0 0 0 1 2.336V19a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-6h4v6a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V9.044a3.242 3.242 0 0 0 1-2.294c0-1.283-1.626-5.33-2.124-6.233ZM15.5 14.7a.8.8 0 0 1-.8.8h-2.4a.8.8 0 0 1-.8-.8v-2.4a.8.8 0 0 1 .8-.8h2.4a.8.8 0 0 1 .8.8v2.4ZM16.75 8a1.252 1.252 0 0 1-1.25-1.25 1 1 0 0 0-2 0 1.25 1.25 0 0 1-2.5 0 1 1 0 0 0-2 0 1.25 1.25 0 0 1-2.5 0 1 1 0 0 0-2 0A1.252 1.252 0 0 1 3.25 8 1.266 1.266 0 0 1 2 6.75C2.306 5.1 2.841 3.501 3.591 2H16.4A19.015 19.015 0 0 1 18 6.75 1.337 1.337 0 0 1 16.75 8Z"/>
            </svg>
            </a>
          </li>
          <li>
            <a href="Orders.php" class="icon" id="Orders">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
            <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
            </svg>
            </a>
          </li>
          <li>
            <a href="#" class="icon" id="settings">
              <img src="../../public/admin/img/settings.svg" alt="settings" />
            </a>
          </li>
        </ul>
        <div class="logout-container">
          <a href="#" class="icon-logout">
            <img src="../../public/admin/img/log-out.svg" alt="logout" />
          </a>
        </div>
      </aside>
      <section class="main">
        <h1>Bogszilogs Admin</h1>
        <div style="margin:20px auto;"><div id="carbon-block"></div>
        <!-- CSSScript Demo Page -->
        <div class="col-sm-15 col-xl-15 childChart">
                        <div class="bg-light rounded h-100 p-4">
                            <div id="chartContainer" style="height: 370px; width: 80%;"></div>
                        </div>
            </div>
      </section>
    </div>


  </body>
  <script src="../../public/admin/js/script2.js"></script>
  <script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CE7DC2JW&placement=wwwcssscriptcom";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LLWL5N9CSM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-LLWL5N9CSM');
</script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/admin/lib/chart/chart.min.js"></script>
    <script src="../../public/admin/lib/easing/easing.min.js"></script>
    <script src="../../public/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="../../public/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../public/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../public/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../public/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../public/admin/js/main.js"></script>
    <script>
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
    </script>
    
</html>

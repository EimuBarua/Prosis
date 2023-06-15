<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prosis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/chart/apexcharts.css">

    <link rel="stylesheet" type="text/css" href="assets/css/data-table/jquery.dataTables.css">

    <link rel="stylesheet" href="assets/css/sass.css">
    <link rel="stylesheet" href="assets/css/layets.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <div class="main-wrapper">

            <!-- navigation content -->
            <?php include 'navContent.php'; ?>
        <!--x--- navigation content --x--->

        <div class="content-wrapper">

            <!-- Chart -->
            <section class="dashboard-top-sec">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="bg-white top-chart-earn">
                                <canvas id="myChart"></canvas>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="bg-white top-chart-earn">
                                <div class="py-2">
                                    <canvas id="myChart2" class=""></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--x-- Chart --x-->

        </div>


    </div>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  
    <script type="text/javascript" charset="utf8" src="assets/js/data-table/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

    <script src="assets/js/chart/apexcharts.min.js"></script>
    <script src="assets/js/chart/chart.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
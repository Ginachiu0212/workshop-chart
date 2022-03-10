<?php
require_once("db_data.php");
$id=$_GET["id"];


$sql="SELECT Status,COUNT(County) FROM `air` GROUP BY Status;";
$result = $conn->query($sql);
//$row=$result->fetch_assoc();

$status=array();
$county=array();


while($row = $result->fetch_assoc()):
    array_push($status, $row["Status"]);
    array_push($county, $row["COUNT(County)"]);
endwhile;

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Create User</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
      <div class="container">
      <canvas id="myChart" width="400" height="200"></canvas>
      </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('myChart');
            var county_data = <?php echo json_encode($county) ?>;
            var label_data = <?php echo json_encode($status) ?>;
           
            
            const labels = label_data;
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Status',
                    data: county_data,
                    backgroundColor: ['orange','red','green','blue'],
                }]
            };


            const config = {
    
                type: 'pie',
                data: data,
                options:{
                    aspectRatio:2,
                    responsive: true,
                    plugins:{
                        legend: {
                            position: 'top',
                            labels: {
                                font:{
                                    size:15,
                                }
                            }
                        },
                        title: {
                            display: true,
                            text:'全台空氣品質狀態圖-Pie Chart',
                            font:{
                                size:30,
                            }
                        }
                    }
                }
            };
            const myChart = new Chart(ctx, config)
        </script>






</script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
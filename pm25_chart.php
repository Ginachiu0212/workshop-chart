<?php
require_once("db_data.php");
$id=$_GET["id"];



$sql="SELECT County,ROUND(AVG(`PM2.5`),2) FROM air where `PM2.5`!=0 GROUP BY County ORDER BY ID ASC;";
$result = $conn->query($sql);
//$row=$result->fetch_assoc();

$pm25=array();
$county=array();

while($row = $result->fetch_assoc()):
    array_push($pm25, $row["ROUND(AVG(`PM2.5`),2)"]);
    array_push($county,$row["County"]);
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
      
         
      </div>
      <canvas id="myChart" width="800" height="400"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('myChart');
            var pm25_data = <?php echo json_encode($pm25) ?>;
            var label_data = <?php echo json_encode($county) ?>
           
            
            const labels = label_data;
            const data = {
                labels: labels,
                datasets: [{
                    label: 'PM2.5',
                    data: pm25_data,
                    backgroundColor:'rgba(0,128,0,0.5)',
                    borderColor:['rgba(0,128,0,0.5)'],
                    borderWidth:1.5,
                }]
            };


            const config = {
    
                type: 'line',
                data: data,
                options:{
                    aspectRatio:2,
                    plugins:{
                        title:{
                        display:true,
                        text:"台灣地區PM2.5平均",
                        font:{
                            size: 30,
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
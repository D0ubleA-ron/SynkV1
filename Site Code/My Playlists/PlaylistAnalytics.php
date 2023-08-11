<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: ../Login/Login.php");
    exit;
}
include '../tracker.php';

?>
<!-- HTML code for the chart -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Activity per Hour Chart</title>
    <link rel="stylesheet" href="MyPlaylists.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
</head>
<body>
<ul>

    <li><a href="../Home/home.php"><div class = "textnav">Home</div></a></li>
    <li><a href="../My Playlists/MyPlaylists.php"><div class="textnav">My Playlists</div></a></li>
    <li style="float:right"><a class="active" href="../AccountSettings/AccountSettings.php"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['image']); ?>" style="height: 2em"/></a></li>
    <li><div class = "synklogo">Synk</div></li>

</ul>
<form method="post" style="color: #313131">
    <div style="text-align: center;margin-top: 5em">
        <form>
            <label for="dropdown">Filter by Hour, Day or Month:</label>
            <select id="dropdown" name="dropdown" style="background-color: #F7F6C5">
                <option value='%Y-%m-%d %H:00:00'>Hour</option>
                <option value='%Y-%m-%d'>Day </option>
                <option value='%Y-%m'>Month</option>
            </select>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</form>
<?php if(isset($_POST['dropdown'])) { ?>
    <?php
    session_start();


    $servername = "localhost";
    $username = "88827654";
    $password = "88827654";
    $dbname = "db_88827654";
    $conn = mysqli_connect($servername, $username, $password, $dbname);


    $stmt = $conn->prepare("SELECT DATE_FORMAT(date, ?) AS hour, COUNT(link) AS activity FROM Tracking WHERE link LIKE ? GROUP BY hour;");
    if(isset($_POST['dropdown']) && isset($_GET['postId']) && isset($_GET['postTitle']))
    {
        $type = $_POST['dropdown'];
        $postid = $_GET['postId'];
        $posttitle = $_GET['postTitle'];
        if($type == '%Y-%m' )
        {
            $daytype = 'Month';
        }
        if($type == '%Y-%m-%d')
        {
            $daytype = 'Day';
        }
        if($type == '%Y-%m-%d %H:00:00' )
        {
            $daytype = 'Hour';
        }

    }
    $tester = '%id='. $postid . '%';
    $stmt->bind_param("ss", $type, $tester);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    ?>
    <div style="margin-top: 2rem">
        <p style="color: #313131; text-align: center">Site Usage Report by <?php echo $daytype?> for <?php echo $posttitle?></p>
        <canvas id="myChart"></canvas>
        <script>
            var data = <?php echo json_encode($data); ?>;
            var labels = [];
            var values = [];
            for (var i = 0; i < data.length; i++) {
                labels.push(data[i].hour);
                values.push(data[i].activity);
            }
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Views per <?php echo $daytype; ?>',
                        data: values,
                        fill: false,
                        borderColor: 'rgb(254,95, 85)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: '<?php echo $daytype; ?>'
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
<?php } ?>
</body>
</html>

<?php
require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $s_date= $_POST['sDate'];
    $e_date= $_POST['eDate'];

    $api_key="O9DmdteIeAed6x1W9MW5Szcd0PzTvYDHeLAMyyWV";
    $client=new GuzzleHttp\Client();

    $res=$client->request('GET', "https://api.nasa.gov/neo/rest/v1/feed?start_date=".$s_date."&end_date=".$e_date."&api_key=$api_key");


    $data=json_decode($res->getBody(), true);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>NEO Information</h2>
    <table>
    <form method="post" >
        <tr>
            <th>
                <label>Start date:</label>
            </th>
            <td>
                <input type="text"  name="sDate" required>
            </td>
        </tr>
        <tr>
            <th>
                <label>Ending date:</label>
            </th>
            <td>
                <input type="text"  name="eDate" required>
             </td>
        </tr>
         <td>
            <button type="submit">SUBMIT</button>
        </td>  

     </form>
     <table border="1px">
     <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Max Size</th>
    <th>Minimum Size</th>
    <th>Distance</th>
    <th>Fastest</th>

  </tr>
  <?php 
foreach ($data['near_earth_objects'] as  $objects) {
    foreach ($objects as $object) { ?>
      <tr>
        <td><?= $object['id'] ?></td>
        <td><?= $object['name'] ?></td>
        <td><?= $object['estimated_diameter']['kilometers']['estimated_diameter_max'] ?></td>
        <td><?= $object['estimated_diameter']['kilometers']['estimated_diameter_min'] ?></td>
        <td><?= $object['close_approach_data'][0]['miss_distance']['kilometers'] ?></td>
        <td><?= $object['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'] ?></td>
    </tr>
  <?php } } ?>
     </table>

    </table>
    
    </body>
</html>
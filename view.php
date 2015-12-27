<?php
try {
    if (!file_exists('includes.php')) {
        throw new Exception("Include File not fountd");
    } else {
        require_once('includes.php');
    }
    $db = new db();
    $activites = $db->get('1 ORDER BY `date`', 'activity');
    $table='<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Activity</th>
        <th>User</th>
        <th>Date</th>
        <th>Duration</th>
        <th>Setps</th>
      </tr>
    </thead>
    <tbody>
';
    foreach($activites as $activity){
        $table.='<tr>
                <td>'.$activity['activity'].'</td>
                <td>'.$activity['user_id'].'</td>
                <td>'.$activity['date'].'</td>
                <td>'.$activity['duration'].'</td>
                <td>'.$activity['steps'].'</td>
                </tr>';
    }
    $table.=' </tbody>
  </table>
</div>

</body>
</html>
';
    echo $table;

}
catch
    (Exception $e) {
        echo "Message : " . $e->getMessage() . "<br>";
        echo "Code : " . $e->getCode();
    }
?>
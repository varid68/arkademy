<!DOCTYPE html>
<html>
<?php
$koneksi = mysqli_connect("localhost","root","","gudang");
if (mysqli_connect_errno()){
  echo "Koneksi database gagal : " . mysqli_connect_error();
}

$array = [];
$array2 = [];

$data = mysqli_query($koneksi, "SELECT products.id, categories.name AS category_name, products.name AS products FROM categories INNER JOIN products on categories.id = products.category_id");
while ($arr = mysqli_fetch_assoc($data)) {
  array_push($array, $arr['category_name']);
  array_push($array2, $arr);
}

$unique = array_unique($array);
$result = [];

foreach ($unique as $value) {
  foreach ($array2 as $value2) {
    if ($value2['category_name'] == $value){
      $result[$value][] = $value2['products'];
    }
  }
}

?>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>

</head>

<body>
  <div class="container">
    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px">
      <table class="table table-hover table-bordered table-striped">
        <tr>
          <th width="20%">Id</th>
          <th width="40%">category name</th>
          <th width="40%">products</th>
        </tr>
        <?php 
        $no = 1;
        foreach ($result as $key => $value) { ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $key; ?></td>
            <td>
            <?php foreach ($value as $value2) { ?>
              <span><?php echo $value2; ?></span><br/>
            <?php } ?>
            </td>
        </tr><?php } ?>
      </table>
    </div>
  </div>

</body>
</html>
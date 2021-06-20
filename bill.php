<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1 class="text-center">Bill Table</h1><br>

             <div class="container">
            <table class="table l">
                <thead>
                  <tr>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Bill after discount</th>
                  </tr>
                </thead>

<?php
 require_once('DBconnect.php');
 $query="SELECT * FROM bill"; 
 $read= mysqli_query($conn,$query);
 if($read->num_rows>0){
   while($rd=mysqli_fetch_assoc($read)){
    $id=$rd['customer_id'];
    $dob=$rd['total_bill'];
?>
                <tbody>
                  <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $dob; ?></td>
                 </tr>
                  <?php 
    }} ?>
                </tbody>
              </table>
              </div>


           
</body>
</html>


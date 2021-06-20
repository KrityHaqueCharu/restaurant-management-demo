<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
                 require_once('DBconnect.php');
                 $query="SELECT * FROM orders INNER JOIN menu ON orders.item = menu.item"; 
                 $read= mysqli_query($conn,$query);
                
                 if($read->num_rows>0){
                   while($rd=mysqli_fetch_assoc($read)){
                    $id=$rd['customer_id'];
                    $dob=$rd['dob'];
                    $item=$rd['item'];
                    $quan=$rd['quantity'];
                    $money=$rd['purchase_date'];
                    $price=$rd['price'];
                    $bill=$price*$quan;

                    //For birthday checking
                    $diff = abs(strtotime($money) - strtotime($dob));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                    $i= (strtotime($money) - strtotime($dob))  / (60 * 60 * 24);
                    //$origin = date_create($dob);
                    //$target = date_create($money);
                    //$interval = date_diff($origin, $target);
                    $daay=($i-$days)/365;
                    

                    if($years <25 && $months==0 && $daay==$years){
                        if($item=="pasta"){
                            $bil1=$bill-$bill*.20;
                            $sql="INSERT INTO `bill`(`customer_id`, `total_bill`) VALUES ('$id','$bil1')";
                            $createquery = mysqli_query($conn, $sql);
                        }else{
                        $bil1=$bill-$bill*.15;
                        $sql="INSERT INTO `bill`(`customer_id`, `total_bill`) VALUES ('$id','$bil1')";
                        $createquery = mysqli_query($conn, $sql);
                        }
                    }
                    elseif($years > 60){
                        $bil1=$bill-($bill*.30);
                        $sql="INSERT INTO `bill`(`customer_id`, `total_bill`) VALUES ('$id','$bil1')";
                        $createquery = mysqli_query($conn, $sql);
                    }
                    elseif($item=="pasta"){
                        $bil1=$bill-$bill*.20;
                        $sql="INSERT INTO `bill`(`customer_id`, `total_bill`) VALUES ('$id','$bil1')";
                        $createquery = mysqli_query($conn, $sql);
                    }
                    elseif($months==0 && $daay==$years){
                        $bil1=$bill-$bill*.05;
                        $sql="INSERT INTO `bill`(`customer_id`, `total_bill`) VALUES ('$id','$bil1')";
                        $createquery = mysqli_query($conn, $sql);
                    }
                    else{
                        $bil1=$bill;
                        $sql="INSERT INTO `bill`(`customer_id`, `total_bill`) VALUES ('$id','$bil1')";
                        $createquery = mysqli_query($conn, $sql);
                    }
                    $sqla="INSERT INTO `final`(`customer_id`) VALUES ($id)";
                    $sql="UPDATE final SET 'total_bill' = '(total_bill + $bill)' WHERE customer_id='$id'";
                    
                
                  }}
                 
?>
                  <a href="bill.php">Click me</a>
                  </body>
</html>
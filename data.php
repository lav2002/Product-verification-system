
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <title>Star for your Star</title>
    <style>
        
    *{
        color: white;
    }
    img {
        width: 100px;
        height: 100px;
        margin: auto;
        display: block;
}
.download-text{
    text-align: center;
    font-size: 25px;
}
body {
  display:flex; flex-direction:column; justify-content:center;
  min-height:100vh;
}
    </style>
</head>
<body>
<div class="text-box">
    <div class="heading">
    
    <?php 

include('db.php');
if(isset($_POST['submit'])){
 $str = mysqli_real_escape_string($con,$_POST['str']);
 $sql = "SELECT * FROM images WHERE image_url LIKE '%$str%'";
 $res = mysqli_query($con,$sql);
 if(mysqli_num_rows($res)>0){
   while($row=mysqli_fetch_assoc($res)){
     $out = $row['image_url'];
   // echo "<img src='$out'>";
   echo "<a href='$out'><img src='img/downlaod.png'></a>"; //image link change
   echo '<div class="button-wrapper">
   <div class="download-text">DOWNLOAD</div>
   
 </div>';

   }
 }
 else{
   echo "No Data Found";
 }

}
mysqli_close($con);

?>

    </div>
    </div>
  </div>
  
  
    <script src="js/three.min.js"></script>
<script src="js/star.js"></script>
</body>
</html>
 
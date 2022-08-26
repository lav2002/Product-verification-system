
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verify Star Map</title>
    <meta charset=UTF-8 />

    <link rel="stylesheet" type="text/css" href="css/style2.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <style>
        body {
  display:flex; flex-direction:column; justify-content:center;
  min-height:100vh;
}
    </style>
</head>

<body>
    <div style="text-align:center ;">
        <script src="js/three.min.js"></script>
        <script src="js/star.js"></script>
        <?php
      
            echo "<h3 class='text-box1' >Verified Sucessfully</h3>";

            header("refresh: 5; url = index.php");
echo 
'<div class="container">

<span>3</span>
<span>2</span>
<span>1</span>
<span>0</span>
</div>';


            exit;
        ?>
        

    </div>


</body>

</html>

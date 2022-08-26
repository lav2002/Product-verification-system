<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
    <html>

    <head>
        <title>STAR VERIFICATION | Fleastore</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>

    <body>


        <h2 id="heading">STAR VERIFICATION IMAGE UPLOAD PANEL</h2>
        <h2 id="heading1">BIRTHDAY | FLEASTORE</h2>
        <form id="frm-image-upload" action="birthday-data.php" name='img' method="post" enctype="multipart/form-data">
            <!-- change the location of data -->
            <div class="form-row">
                <div>Choose Image file:</div>
                <div>
                    <input type="file" class="file-input" name="file-input" required="true"><br><br>
                    Enter image name :<br><input placeholder="Enter Image Name" type="text" class="file-input" name="filename" required="true"><br><br>
                    Enter UNIQUE ID<br><input type="text" class="file-input" name="uniqueid" required="true" placeholder="Enter Unique ID"><br><br>
                    Enter D-O-B :<br><input type="date" class="file-input" name="DOB" required="true"><br>
                   
                </div>
            </div>

            <div class="button-row">
                <button type="submit" id="btn-submit" name="upload">Upload</button>


            </div>
        </form>
        <?php if (!empty($response)) { ?>
            <div class="response <?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
        <?php } ?>
    </body>

    </html>


    <a class="links" href="logout.php">Logout</a>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>
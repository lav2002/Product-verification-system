<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>


    <?php
    include "db_conn2.php";
    if (isset($_POST["upload"])) {
        // Get Image Dimension
        $fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);
        $width = $fileinfo[0];
        $height = $fileinfo[1];

        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg",
            "gif",
            "pdf"
        );

        // file extension lega
        $file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);

        //  check if is not empty
        if (!file_exists($_FILES["file-input"]["tmp_name"])) {

            echo "<p class='lines'>ERROR: </p>";
            echo "<p class='lines'>Choose image file to upload.</p>";
        }    // check if is with valid extension
        else if (!in_array($file_extension, $allowed_image_extension)) {

            echo "<p class='lines'>ERROR: </p>";
            echo "<p class='lines'>Upload valid images. Only PNG, JPEG, GIF and PDFs are allowed.</p>";
        }    //image file size
        else if (($_FILES["file-input"]["size"] > 20000000)) {

            echo "<p class='lines'>ERROR: </p>";
            echo "<p class='lines'>Image size exceeds 20MB</p>";
        }
        else if (isset($_POST['upload'])) {

            $extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);
            $name = $_POST["filename"];
            $uniqueid = $_POST["uniqueid"];//must different from others
            $dob = $_POST["DOB"];
            $imagename = $uniqueid . " - " . $dob . " - " . $name . "." . $extension;
            $target = "../special/" . $imagename; //file location
            $link = 'https://' . $_SERVER['HTTP_HOST'] . '/star/special/'.$imagename;

$check="SELECT * FROM images WHERE image_url = '$link'";
$rs = mysqli_query($conn,$check);

if(mysqli_num_rows($rs) > 0){
    echo "<p class='lines'>File already exist</p>";
    echo " <a class='links' href='special.php'>UPLOAD ANOTHER</a>";
exit;
}
else if (isset($_POST['upload'])) {
 
            


            $extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);
            $name = $_POST["filename"];
            $uniqueid = $_POST["uniqueid"];//must different from others
            $dob = $_POST["DOB"];
            $imagename = $uniqueid . " - " . $dob . " - " . $name . "." . $extension;
            $target = "../special/" . $imagename; //file location
            $link = 'https://' . $_SERVER['HTTP_HOST'] . '/star/special/'.$imagename;
            //quary

            $sql = "INSERT INTO images(image_url) 
				        VALUES('$link')";
            mysqli_query($conn, $sql);

            echo "<p class='lines'>Old Image Name ↓↓↓ </p>" . $_FILES["file-input"]["name"] . "<br/>";
            echo "<p class='lines'>New Image Name ↓↓↓ </p>" . $imagename . "<br/>";
            echo "<p class='lines'>Unique Code ↓↓↓ </p>" . $uniqueid . "<br/>";



            if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
                $response = array(
                    "type" => "success",
                    "message" => "Image uploaded successfully."
                );
                if (isset($_POST['upload'])) {
                    echo "\n";
                    $url = $imagename;

                    $qrcode = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https%3A%2F%2F' . $_SERVER['HTTP_HOST'] . '/star/special/' . $url; //file location

                    echo "<br>Image URL is :\t" . "<a class='url-output' href='https://$_SERVER[HTTP_HOST]/star/special/$url'>https://$_SERVER[HTTP_HOST]/star/special/$url</a>" . "<br>"; //file location
                    // change krna hai as per site directory
                }
            }
            } else {
            $response = array(
                "type" => "error",
                "message" => "Problem in uploading image files."
            );
        }
    }}
    ?>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <title>STAR VERIFICATION | Fleastore</title>
    </head>

    <body class="data-size">
        <img src="<?php echo $qrcode; ?>"><br>
        <a href="<?php echo $qrcode; ?>" download="<?php echo $url; ?>"><button class="links">DOWNLOAD</button></a>
        <a class="links" href="special.php">UPLOAD ANOTHER</a>
        <!-- add proper link -->
    </body>

    </html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>
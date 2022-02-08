<html>
<head>
    <title>Multiple upload</title>
</head>

<body>
<form action="#" enctype="multipart/form-data" method="post">
    <input multiple="" name="img[]" type="file" />
    <input name="submit" type="submit" />
</form>

<style >
    body{
        background: -webkit-linear-gradient(left, blue, #f2dede);
    }
</style>

<?php
//mysql_connect("localhost","root","");
//mysql_select_dB("image");
$con=mysqli_connect("localhost","root","","myhmsdb");
//$query=mysqli_query($con,"select username,spec from doctb");
if(isset($_POST["submit"])){
    $filename = $_FILES['img']['name'];
    $file_tmp = $_FILES['img']['tmp_name'];
    $filetype = $_FILES['img']['type'];
    $filesize = $_FILES['img']['size'];
    for($i=0; $i<=count($file_tmp); $i++){
        if(!empty($file_tmp[$i])){
            $name = addslashes($filename[$i]);
            $temp = addslashes(file_get_contents($file_tmp[$i]));
            if(mysqli_query($con,"Insert into multiple(name,image) values('$name','$temp')")){
            }
            else{
                echo "failed";
                echo "<br />";
            }
        }
    }
}
$res = mysqli_query($con,"SELECT * FROM multiple");
while($row = mysqli_fetch_array($res)){
    $displ = $row['image'];

//please place the
//    single quotation ' instead &#39;


    echo '<img src="data:image/jpeg;base64,'.base64_encode($displ).'" />';
    echo "<br />";
}

?>

</body>
</html>



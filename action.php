<!DOCTYPE HTML>  
<html>
<head>
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; 
    background-color: #f2f2f2; 
}
.container {
    background-color: white; 
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center; 
}
h2 {
    margin-bottom: 20px; 
}
</style>
</head>
<body>

<div class="container">

<?php
$name = $email = $gender = $otherGender = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["name"])) {
        $name = ($_GET["name"]);
    }
    if (isset($_GET["email"])) {
        $email = ($_GET["email"]);
    }
    if (isset($_GET["gender"])) {
        $gender = ($_GET["gender"]);
        if ($gender === "other" && ($_GET["otherGender"])) {
            $otherGender = ($_GET["otherGender"]);
        }
    }

    $timestamp = date("Y-m-d H:i:s");
    $dataToSave = "Timestamp: $timestamp | Name: $name | Email: $email | Gender: " . ($gender === "other" ? $otherGender : $gender) . "\n";

    file_put_contents("submissions.txt", $dataToSave, FILE_APPEND | LOCK_EX);
}
?>

<h2>Successfully Submitted!</h2>
<p>Full Name: <?php echo $name; ?></p>
<p>Email: <?php echo $email; ?></p>
<p>Gender: <?php echo ($gender === "other") ? $otherGender : $gender; ?></p>
</div>

</body>
</html>

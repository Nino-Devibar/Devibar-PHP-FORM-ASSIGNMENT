<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f2f2f2; 
}
form {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h2 {
    text-align: center;
	bottom: 25rem;
	position: absolute;
	font-size: 30px;
}
</style>
</head>
<body>  

<?php
$nameErr = $emailErr = $genderErr = "";
$name = $email = $gender = "";
$otherGender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (empty($_POST["name"])) {
    $nameErr = "Name is required";
} else {
    $name = test_input($_POST["name"]);
}
if (empty($_POST["email"])) {
    $emailErr = "Email is required";
} else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
    }
}

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    if ($gender == "other") {
        $otherGender = test_input($_POST["otherGender"]);
    }
}

    if (empty($nameErr) && empty($emailErr) && empty($genderErr)) {
        header("Location: action.php?" . http_build_query($_POST));
        exit();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>USER INFO FORM</h2>
<form method="post" action="<?php echo ($_SERVER["PHP_SELF"]);?>">  
    Name: <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Gender: <span class="error">* <?php echo $genderErr;?></span> <br>
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
    <br>
    Please specify: <input type="text" name="otherGender" value="<?php echo $otherGender; ?>">
    <br><br>
    <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/starbull.css" />
    <title>Apply</title>
</head>
<style>
    <?php include "css/starbull.css" ?>
</style>


<body>
    <form action="bufstar.php" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="name">
            <!--span includes the script to generate the correct eror message created in php-->
            First Name:<input type="text" name="name" required /> <span class="error">* <?php echo $nameErr; ?></span></br></br>
            Middle Initial:<input type="text" name="name" /></br></br>
            Last Name:<input type="text" name="name" required /> </br><span class="error">* <?php echo $nameErr; ?></span></br></br>
        </div>

        <div name="dob">
            <label for="dob">DOB</label>
            <input type="date" id="dob" name="dob" required /><span class="error">* <?php echo $dobErr; ?></span><br><br>
        </div>
        <div name="phone">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
            <small>Format: 123-456-7890</small> <span class="error">* <?php echo $phoneErr; ?></span><br><br>
        </div>

        <div name="address">
            <p>Please Enter Your Address</p>
            Street Address:<input type="text" name="address" required /><span class="error">* <?php echo $addressErr; ?></span><br></br>
            Address Line 2:<input type="text" name="address" /> </br>
            City:<input type="text" name="address" required /><span class="error">* <?php echo $addressErr; ?></span><br></br>
            State:<select id="state" name="address" required>
                <option value=></option>
                <option value="AL">AL</option>
                <option value="AK">AK</option>
                <option value="AZ">AZ</option>
                <option value="AR">AR</option>
                <option value="CA">CA</option>
                <option value="CO">CO</option>
                <option value=“CT”>CT</option>
                <option value=“DE”>DE</option>
                <option value=“DC”>DC</option>
                <option value=“FL”>FL</option>
                <option value=“GA”>GA</option>
                <option value=“HI”>HI</option>
                <option value=“ID”>ID</option>
                <option value=“IL”>IL</option>
                <option value=“IN”>IN</option>
                <option value=“IA”>IA</option>
                <option value=“KS”>KS</option>
                <option value=“KY”>KY</option>
                <option value=“LA”>LA</option>
                <option value=“ME”>ME</option>
                <option value=“MD”>MD</option>
                <option value=“MA”>MA</option>
                <option value=“MI”>MI</option>
                <option value=“MN”>MN</option>
                <option value=“MS”>MS</option>
                <option value=“MO”>MO</option>
                <option value=“MT”>MT</option>
                <option value=“NE”>NE</option>
                <option value=“NV”>NV</option>
                <option value=“NH”>NH</option>
                <option value=“NJ”>NJ</option>
                <option value=“NM”>NM</option>
                <option value=“NY”>NY</option>
                <option value=“NC”>NC</option>
                <option value=“ND”>ND</option>
                <option value=“OH”>OH</option>
                <option value=“OK”>OK</option>
                <option value=“OR”>OR</option>
                <option value=“PA”>PA</option>
                <option value=“RI”>RI</option>
                <option value=“SC”>SC</option>
                <option value=“SD”>SD</option>
                <option value=“TN”>TN</option>
                <option value=“TX”>TX</option>
                <option value=“UT”>UT</option>
                <option value=“VT”>VT</option>
                <option value=“VA”>VA</option>
                <option value=“WA”>WA</option>
                <option value=“WV”>WV</option>
                <option value=“WI”>WI</option>
                <option value=“WY”>WY</option>
            </select><span class="error">* <?php echo $addressErr; ?></span><br></br>
            ZIP:<input type="number" name="address" required /><span class="error">* <?php echo $addressErr; ?></span><br>
            Country:<input type="text" name="address" required /><span class="error">* <?php echo $addressErr; ?></span><br>
        </div>
        <div name="email">
            <label for="email">Enter an Email:</label>
            <input type="email" id="email" name="email" value="email" placeholder="email@example.com" required /> <span class="error">* <?php echo $emailErr; ?></span><br><br>
        </div>
        <div name="title">
            <label for="title">Job Title Applying For:</label>
            <select id="title" name="title" required>
                <option value></option>
                <option value="retail">Retail</option>
                <option value="retail leadership">Retail Leadership</option>
                <option value="corporate">Corporate</option>
                <option value="dist">Manufacturing and Distribution</option>
            </select>
        </div>

        </div> </br>
        <div name="file">
            <input tye="submit" name="SubmitBtn" id="SubmitBtn" value="Upload Resume" />
            <input type="file" name="resume" id="resume" />
        </div>
        <div name="submit">
            <input type="submit" value="submit" />
    </form>

    <?php
    include 'ecc/css/starbull.css';
    if (isset($_POST['SubmitBtn'])) {
        $fileName = $_FILES['resume']['name'];
        $fileName = $_FILES['resume']['size'];
        $fileName = $_FILES['resume']['type'];
        $fileName = $_FILES['resume']['tmp-name'];

        if ($fileType == "application/msword") {
            if ($fileSize <= 200) {
                $random = rand(1111, 9999);

                $uploadPath = "testUpload/" . $newFileName;

                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    echo "Successful";
                    echo "File Name:" . $newFileName;
                    echo "File Size:" . $fileSize . " kb";
                    echo "File Type:" . $fileType;
                } else {
                    echo "Maximum upload file size limit is 200kb";
                }
            } else {
                echo "You can only upload a Word doc file.";
            }
        }
    }
    function sanitize_email($email)
    {
        $email =
            filter_var($email, FILTER_VALIDATE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    //created error variables and set to empty
    $nameErr = $dobErr = $addressErr = $phoneErr = $emailErr = "";
    $name = $dob = $address = $phone = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "$_POST") {
        if (empty($_POST['name'])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
        }
        if (empty($_POST["dob"])) {
            $dobErr = "Date of Birth is required";
        } else {
            $dob = test_input($_POST["dob"]);
        }
        if (empty($_POST["address"])) {
            $addressErr = "Address is required";
        } else {
            $address = test_input($_POST["address"]);
        }
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone Number is required";
        } else {
            $phone = test_input($_POST["phone"]);
        }
        if (empty($_POST["email"])) {
            $emailErr = "An Email is required";
        } else {
            $email = test_input($_POST["email"]);
        }
    }
    $name = $dob = $address = $phone = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["$name"]);
        $dob = test_input($_POST["dob"]);
        $address = test_input($_POST["address"]);
        $phone = test_input($_POST["phone"]);
        $email = test_input($_POST["email"]);
    }
    function test_input($data)
    {
        $data = trim($data); //strips unneccessary characters
        $data = stripslashes($data); //removes backlashes from user input
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>


</body>

</html>
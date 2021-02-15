<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/starbull.css" />
    <title>Apply</title>
</head>

<body>
    <h1>STARBULLS
        <div class="topnav">
            <a class="active" href="mainPage.html">Home</a>
            <a href="specialsOTW.html">Specials Of The Week</a>
            <a href="us.html">About Us</a>
            <a href="starbull.php">Apply Now</a>
        </div>
    </h1>


    <div id="socialMedia">
        <a href="http://www.instagram.com/" class="btn btn-default" target="_blank">
            <img src="images\instagram.png" alt="Instagram"></a>
        <a href="http://www.facebook.com/" class="btn btn-default" target="_blank">
            <img src="images\fb.png" alt="facebook"></a>
        <a href="http://www.twitter.com/" class="btn btn-default" target="_blank">
            <img src="images\_twitter.png" alt="twitter"></a>
    </div>


    <div class="hero">
        <div class="hero-text">
            <h2>Become a Part of the StarBulls</h2>
            <p>Appy Today!</p>
        </div>
    </div>

    <div id="columns">
        <div class="column-wrap">
            <div class="column-left">
                <!--left content-->
                <h2>Application</h2>
                <h3>*required fields</h3>
                <div class="form-container">
                    <!-- action htmlspecialchars converts special characters to html entities avoids exploits -->
                    <!--<span class="error"> <?php echo $addressErr; ?></span> -->

                    <form action="starbull.php" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                        <div class="name">
                            <!--span includes the script to generate the correct eror message created in php-->
                            First Name:*<input type="text" name="name" id="firstname value=" <?php echo $name; ?>"required /><span class=" error"> <?php echo $nameErr; ?></span>
                            Middle Initial:<input type=" text" name="name" id="middle" value="<?php echo $name; ?>" /></br></br>
                            Last Name:*<input type="text" name="name" id="lastname" value="<?php echo $name; ?>" required /><span class="error"> <?php echo $nameErr; ?></span> </br>
                        </div>
                        </br>
                        <div class="dob">
                            <label for="dob">DOB*</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required /><span class="error"><?php echo $dobErr; ?></span>
                        </div>
                        </br>
                        <div class="phone">
                            <label for="phone">Phone Number*</label>
                            <input type="tel" id="phone" name="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Format: 123-456-7890" value="<?php echo $tel; ?>" required /><span class="error"> <?php echo $telErr; ?></span>
                            <br><br>
                        </div>
                        </br>
                        <div class="address">
                            <p>Please Enter Your Address:</p>
                            Street Address:* <input type="text" name="address" id="address1" value="<?php echo $address; ?>" required /><span class="error"><?php echo $addressErr; ?></span><br></br>

                            Address Line 2:<input type="text" name="address" id="line2" value="<?php echo $address; ?>" /> </br></br>

                            City:*<input type="text" name="address" id="city" value="<?php echo $address; ?>" required /><span class="error"> <?php echo $addressErr; ?></span><br></br>

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
                            </select><span class="error">* <?php echo $addressErr; ?></span>
                            </br></br>
                            ZIP:*<input type="number" name="address" id="zip" maxlength="5" value="<?php echo $address; ?>" required /><span class="error"> <?php echo $addressErr; ?></span></br></br>

                            Country:*<input type="text" name="address" id="country" pattern="[A-Za-z]{3}" value="<?php echo $address; ?>" required /><span class="error"> <?php echo $addressErr; ?></span>
                            </br> </br>
                        </div> </br>
                        <div class="email">
                            <label for="email">Enter an Email:*</label>
                            <input type="email" id="email" name="email" placeholder="email@example.com" value="<?php echo $email; ?>" required /><span class="error"> <?php echo $emailErr; ?></span> </br></br>
                        </div>
                        </br>
                        <div class="title">
                            <label for="title">Job Title Applying For:</label> <span class="error"> <?php echo $titleErr; ?></span></br>
                            <select id="title" name="title" required>
                                <option value></option>
                                <option value="retail">Retail</option>
                                <option value="retail leadership">Retail Leadership</option>
                                <option value="corporate">Corporate</option>
                                <option value="dist">Manufacturing and Distribution</option>
                            </select>
                        </div>
                        </br>
                        </br>
                        <div class="file">
                            <h3>Upload Resume:</h3>
                            <input type="file" name="resume" id="resume" /><span class="error"> <?php echo $resumeErr; ?></span>
                        </div>

                        </br>
                        <div class="submit">
                            <input type="submit" value="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="column-right">
            <h2>Reviews</h2>
            <div class="review1">
                <p>McLovin:"No fake ID required: they'll hire you at 16!"</p>
            </div> </br>

            <div class="review2">
                <p>Ragnar L:"Don’t waste your time looking back you are not going that way. Apply to StarBulls and change your life."</p>
            </div> </br>

            <div class="review1">
                <p>Uhtred:"What is it that you want? Great bosses and colleagues? Good pay? Then work at StarBulls"</p>
            </div> </br>

            <div class="review2">
                <p>Dwight S.:"Nothing stresses me out. Except having to seek the approval of my inferiors. Here at StarBulls I don't stress about this!</p>
            </div></br>

            <div class="review1">
                <p> Winnie T.P:"How lucky I am to have something that makes saying goodbye so hard."
                </p>
            </div> </br>

            <div class='review2'>
                <p>Anna K:"Great place to work!"</p>
            </div></br>

            <div class="review1">
                <p>John L: "StarBulls offers a great astmosphere; everyone is very relaxed!"</p>
            </div></br>
        </div>
    </div>



    <?php
    //form validation
    //calling out the variables and setting them to empty
    $name = $dob = $tel = $address = $email = $title = $resume = "";
    if (isset($_POST["submit_btn"]) == "POST") {
        $name = test_input($_POST["name"]);
        $dob = test_input($_POST["dob"]);
        $tel = test_input($_POST["tel"]);
        $address = test_input($_POST["address"]);
        $email = test_input($_POST["email"]);
        $title = test_input($_POST["title"]);
        $resume = test_input($_POST["resume"]);
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //form required fields
    //adding error variables
    $nameErr = $dobErr = $telErr = $addressErr = $emailErr = $titleErr = $resumeErr = "";
    $name = $dob = $tel = $address = $email = $title = $resume = "";
    //if the user presses submit using post check the following: if the '' field is empty echo error message, else use the test_input function to test the data
    //preg_match checks a string for a pattern, returns true if it exists and false if otherwise
    if (isset($_POST["submit_btn"]) == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z' ]*$", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
    }

    if (empty($_POST["dob"])) {
        $dobErr = "Date of Birth is required";
    } else {
        $dob = test_input($_POST["dob"]);
    }


    if (empty($_POST["tel"])) {
        $telErr = "Phone Number is required";
    } else {
        $tel = test_input($_POST["tel"]);
    }


    if (empty($_POST["address"])) {
        $addressErr = "Address field is required";
    } else {
        $address = test_input($_POST["address"]);
    }


    if (empty($_POST["email"])) {
        $emailErr = "An Email is required";
    } else {
        $email = test_input($_POST["email"]);
        //checking email address formation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }


    if (empty($_POST["title"])) {
        $titleErr = "Please choose a Job Title";
    } else {
        $title = test_input($_POST["title"]);
    }


    if (empty($_POST["resume"])) {
        $resumerErr = "Upload your Resume";
    } else {
        $resume = test_input($_POST["resume"]);
    }

    ?>



</body>

</html>
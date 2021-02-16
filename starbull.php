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

                    <form action="starbull.php" method="post" enctype="multipart/form-data">

                        <div class=" name">
                            <!--span includes the script to generate the correct eror message created in php-->
                            First Name:*<input type="text" name="firstName" id="firstName" <?= ($firstName ? 'value="' . $firstName . '"' : ''); ?> required />

                            Middle Initial:<input type="text" name="middleName" id="middleName" <?= ($middleName ? 'value="' . $middleName . '"' : ''); ?> /> </br></br>

                            Last Name:*<input type="text" name="lastName" id="lastName" <?= ($lastName ? 'value="' . $lastName . '"' : ''); ?> required />
                            </br>
                        </div>
                        </br>
                        <div class="dob">
                            <label for="dob">DOB*</label>
                            <input type="date" id="dob" name="dob" <?= ($dob ? 'value="' . $dob . '"' : ''); ?> required />

                        </div>
                        </br>
                        <div class="phone">
                            <label for="phone">Phone Number*</label>
                            <input type="tel" id="tel" name="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Format: 123-456-7890" <?= ($tel ? 'value="' . $tel . '"' : ''); ?>required />

                            <br><br>
                        </div>
                        </br>
                        <div class="address">
                            <p>Please Enter Your Address:</p>
                            Street Address:* <input type="text" name="address1" id="address1" <?= ($address1 ? 'value="' . $address1 . '"' : ''); ?> required />
                            <br></br>

                            Address Line 2:<input type="text" name="address2" id="address2" <?= ($address2 ? 'value="' . $address2 . '"' : ''); ?> /> </br></br>

                            City:*<input type="text" name="city" id="city" value="<?php echo $city; ?>" <?= ($city ? 'value="' . $city . '"' : ''); ?> required />
                            <br></br>

                            State:<select id="state" name="state" <?= ($state ? 'value="' . $state . '"' : ''); ?>required>
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
                            </select>

                            </br></br>
                            ZIP:*<input type="number" name="zip" id="zip" maxlength="5" value="<?php echo $address; ?>" <?= ($zip ? 'value="' . $zip . '"' : ''); ?>required />
                            </br></br>

                            Country:*<input type="text" name="country" id="country" pattern="[A-Za-z]{3}" value="<?php echo $address; ?>" <?= ($country ? 'value="' . $country . '"' : ''); ?> required />

                            </br> </br>
                        </div> </br>
                        <div class="email">
                            <label for="email">Enter an Email:*</label>
                            <input type="email" id="email" name="email" placeholder="email@example.com" value="<?php echo $email; ?>" <?= ($email ? 'value="' . $email . '"' : ''); ?>required />
                            </br></br>
                        </div>
                        </br>
                        <div class="title">
                            <label for="title">Job Title Applying For:</label>
                            </br>
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
                            <input type="file" name="resume" id="resume" <?= ($resume ? 'value="' . $resume . '"' : ''); ?> />

                        </div>

                        </br>
                        <div class="submit">
                            <input type="submit" name="submit_btn" value="submit_btn" />
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

            <!-- <div class='review2'>
                <p>Anna K:"Great place to work!"</p>
            </div></br>-->

            <div class="review2">
                <p>John L: "StarBulls offers a great astmosphere; everyone is very relaxed!"</p>
            </div></br>
        </div>
    </div>


    <div id="form" name="form">
        <?php
        //form validation
        //calling out the variables and setting them to empty
        $firstName = $middleName = $lastName = $dob = $tel = $address1 = $address2 = $city = $state = $zip = $email = $title = $resume = "";

        if (isset($_POST["submit_btn"])) {
            if (!empty($_POST['firstName'])) {
                $first = $_POST['firstName'];
            } else {
                echo "<h1 style='color:red'>First Name Required</h1>";
            }

            if (!empty($_POST['lastName'])) {
                $last = $_POST['lastName'];
            } else {
                echo "<h3 style='color:red'>Last Name Required</h3>";
            }

            if (!empty($_POST['dob'])) {
                $dob = $_POST['dob'];
            } else {
                echo "<h3 style='color:red'>Date of Birth Required</h3>";
            }

            if (!empty($_POST['tel'])) {
                $tel = $_POST['tel'];
            } else {
                echo "<h3 style='color;red'>Phone Number is Required</h3>";
            }

            if (!empty($_POST['address1'])) {
                $address1 = $_POST['addresss1'];
            } else {
                echo "<h3 style='color:red'>Street Address is Required</h3>";
            }

            if (!empty($_POST['city'])) {
                $city = $_POST['city'];
            } else {
                echo "<h3 style='color:red'>City field is Required</h3>";
            }

            if (!empty($_POST['state'])) {
                $state = $_POST['state'];
            } else {
                echo "<h3 style='color:red'>Please Select a State</h3>";
            }

            if (!empty($_POST['zip'])) {
                $zip = $_POST['zip'];
            } else {
                echo "<h3 style='color:red'>Zip Code is Required</h3>";
            }

            if (!empty($_POST['email'])) {
                $email = $_POST['email'];
            } else {
                echo
                    "<h3 style='color:red'>An Email is Required</h3>";
            }

            if (!empty($_POST['title'])) {
                $title = $_POST['title'];
            } else {
                echo
                    "<h3 style='color:red'>Please Select One</h3>";
            }
        }


        /* $firstNameErr = $middleNameErr = $lastNameErr = $dobErr = $telErr = $address1Err = $cityErr = $stateErr = $zipErr = $emailErr = $titleErr = $resumeErr = "";
         if (isset($_POST["submit_btn"])) {
            $firstName = format_input($_POST["firstName"]);
            $middleName = format_input($_POST["middleName"]);
            $lastName = format_input($_POST["lastName"]);
            $dob = format_input($_POST["dob"]);
            $tel = format_input($_POST["tel"]);
            $address1 = format_input($_POST["address1"]);
            $address2 = format_input($_POST["address2"]);
            $city = format_input($_POST["city"]);
            $state = format_input($_POST["state"]);
            $zip = format_input($_POST["zip"]);
            $email = format_input($_POST["email"]);
            $title = format_input($_POST["title"]);
            $resume = format_input($_POST["resume"]);

           
             if (empty($_POST["firstName"])) {
                $firstNameErr = "Name is required";
            } else {
                $firstName = format_input($_POST["firstName"]);
                if (preg_match("/^[a-zA-Z' ]*$", $firstName)) {
                    $firstNameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["lastName"])) {
                $lastNameErr = "Name is required";
            } else {
                $lastName = format_input($_POST["lastName"]);
                if (preg_match("/^[a-zA-Z' ]*$", $lastName)) {
                    $lastNameErr = "Only letters and white space allowed";
                }
            }


            if (empty($_POST["dob"])) {
                $dobErr = "Date of Birth is required";
            } else {
                $dob = format_input($_POST["dob"]);
            }


            if (empty($_POST["tel"])) {
                $telErr = "Phone Number is required";
            } else {
                $tel = format_input($_POST["tel"]);
            }


            if (empty($_POST["address1"])) {
                $address1Err = "Street Address field is required";
            } else {
                $address1 = format_input($_POST["address1"]);
            }

            if (empty($_POST["city"])) {
                $cityErr = "City field is required";
            } else {
                $city = format_input($_POST["city"]);
            }

            if (empty($_POST["state"])) {
                $stateErr = "State field is required";
            } else {
                $state = format_input($_POST["state"]);
            }
            if (empty($_POST["zip"])) {
                $zipErr = "Zip code is required";
            } else {
                $zip = format_input($_POST["zip"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "An Email is required";
            } else {
                $email = format_input($_POST["email"]);
            }

            if (empty($_POST["title"])) {
                $titleErr = "Please choose a Job Title";
            } else {
                $title = format_input($_POST["title"]);
            }


            if (empty($_POST["resume"])) {
                $resumerErr = "Upload your Resume";
            } else {
                $resume = format_input($_POST["resume"]);
            }
        }
        function format_input($data)
        {
            $data = trim($data);
            $data = htmlspecialchars($data);
            return $data;
        } */
        ?>
    </div>



</body>

</html>
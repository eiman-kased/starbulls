<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/starbull.css" />
    <title>Apply</title>
</head>

<body>
    <div class="header">
        <div class="logo">
            <a href="home.php" class="logo">
                <img src="images/starbullslogo.png" alt="logo" />
            </a>
        </div>

        <h1>STARBULLS
            <div class="topnav">
                <a href="menu.php">Menu</a>
                <a href="specialMenu.php">Specials Of The Week</a>
                <a href="about.php">About Us</a>
                <a href="apply.php">Apply Now</a>
            </div>
        </h1>
    </div>
    </div>

    <div id="socialMedia">
        <a href="https://www.instagram.com/starbulls716/" class="btn btn-default" target="_blank">
            <img src="images\instagram.png" alt="Instagram"></a>
        <a href="https://www.facebook.com/starbulls.buffalo/" class="btn btn-default" target="_blank">
            <img src="images\fb.png" alt="facebook"></a>
        <a href="https://twitter.com/home/" class="btn btn-default" target="_blank">
            <img src="images\_twitter.png" alt="twitter"></a>
    </div>

    <div class="hero">
        <div class="hero-text">
            <h2>Become a Part of the StarBulls</h2>
            <p>Apply Today!</p>
        </div>
    </div>

    <div id="columns">
        <div class="column-wrap">
            <div class="column-left">
                <!--left content-->
                <h2>Application</h2>
                <h3>*required fields</h3>
                <div class="form-container">

                    <?php

                    $firstName = '';
                    $lastName = '';
                    $dob = '';
                    $tel = '';
                    $address1 = '';
                    $city = '';
                    $state = '';
                    $zip = '';
                    $email = '';
                    $title = '';

                    if (isset($_POST["submit_btn"])) {
                        if (!empty(trim($_POST['firstName']))) {
                            $firstName = trim($_POST['firstName']);
                        } else {
                            echo '<span class="error">*First Name is Required</span> </br>';
                        }

                        if (!empty(trim($_POST['lastName']))) {
                            $lastName = trim($_POST['lastName']);
                        } else {
                            echo '<span class="error">*Last Name is Required</span> </br>';
                        }

                        if (!empty(trim($_POST['dob']))) {
                            $dob = trim($_POST['dob']);
                        } else {
                            echo '<span class="error">*Date of Birth Required</span> </br>';
                        }

                        if (!empty(trim($_POST['tel']))) {
                            $tel = trim($_POST['tel']);
                        } else {
                            echo '<span class="error">*Phone Number is Required</span> </br>';
                        }

                        if (!empty(trim($_POST['address1']))) {
                            $address1 = trim($_POST['addresss1']);
                        } else {
                            echo '<span class="error">*Street Address is Required</span> </br>';
                        }

                        if (!empty(trim($_POST['city']))) {
                            $city = trim($_POST['city']);
                        } else {
                            echo '<span class="error">*City field is Required</span> </br>';
                        }

                        if (!empty(trim($_POST['state']))) {
                            $state = trim($_POST['state']);
                        } else {
                            echo '<span class="error">*Please Select a State</span> </br>';
                        }

                        if (!empty(trim($_POST['zip']))) {
                            $zip = trim($_POST['zip']);
                        } else {
                            echo '<span class="error">*Zip Code is Required</span> </br>';
                        }
                        if (!empty(trim($_POST['country']))) {
                            $zip = trim($_POST['country']);
                        } else {
                            echo '<span class="error">*Country is Required</span> </br>';
                        }

                        if (!empty(trim($_POST['email']))) {
                            $email = trim($_POST['email']);
                        } else {
                            echo '<span class="error">*An Email is Required</span> </br>';
                        }

                        if (!empty(trim($_POST['title']))) {
                            $title = trim($_POST['title']);
                        } else {
                            echo '<span class="error">*Please Select Job Title</span> </br>';
                        }
                    }
                    ?>

                    <form action="starbull.php" method="post" enctype="multipart/form-data">

                        <div class="name">

                            First Name:*<input type="text" name="firstName" id="firstName" <?php if (isset($_POST['error'])) {
                                                                                                echo $_POST['error'];
                                                                                            } ?> required /> </br></br>

                            Middle Initial:<input type="text" name="middleName" id="middleName" /> </br></br>

                            Last Name:*<input type="text" name="lastName" id="lastName"> required /> </br></br>

                        </div>
                        </br>
                        <div class="dob">
                            <label for="dob">DOB*</label>
                            <input type="date" id="dob" name="dob" <?php if (isset($_POST['error'])) {
                                                                        echo $_POST['error'];
                                                                    } ?> required /> </br></br>

                        </div>

                        <div class="phone">
                            <label for="phone">Phone Number*</label>
                            <input type="tel" id="tel" name="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Format: 123-456-7890" <?php if (isset($_POST['error'])) {
                                                                                                                                                echo $_POST['error'];
                                                                                                                                            } ?> required />

                            </br>
                        </div>

                        <div class="address">
                            <p>Please Enter Your Address:</p>
                            Street Address:* <input type="text" name="address1" id="address1" ] required />
                            <br></br>

                            Address Line 2:<input type="text" name="address2" id="address2" /> </br></br>

                            City:*<input type="text" name="city" id="city" <?php if (isset($_POST['error'])) {
                                                                                echo $_POST['error'];
                                                                            } ?> required />
                            <br></br>

                            State:<select id="state" name="state" required>
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
                            ZIP:*<input type="number" name="zip" id="zip" maxlength="5" <?php if (isset($_POST['error'])) {
                                                                                            echo $_POST['error'];
                                                                                        } ?> required />
                            </br></br>

                            Country:*<input type="text" name="country" id="country" pattern="[A-Za-z]{3}" required />

                            </br> </br>
                        </div>
                        <div class="email">
                            <label for="email">Enter an Email:*</label>
                            <input type="email" id="email" name="email" placeholder="email@example.com" required />
                            </br></br>
                        </div>

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
                            <input type="file" name="resume" id="resume" />

                        </div>

                        </br></br>
                        <div class="submit">
                            <input type="submit" name="submit_btn" value="Submit Application" />
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

            <div class="review2">
                <p>John L: "StarBulls offers a great astmosphere; everyone is very relaxed!"</p>
            </div></br>
        </div>
    </div>
    </br>

    <div id="end">
        <b>
            Starbulls Wings and Coffee&nbsp; |&nbsp; 01101000 01101001 00100000 01100010 01101001 01101100 01101100 Web Development Street&nbsp; |&nbsp; Buffalo , NY 14220&nbsp; |&nbsp;
        </b>

    </div>
</body>

</html>
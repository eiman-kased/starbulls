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
<form action="apply.php" method="post" enctype="multipart/form-data">
	<div class="name">
		First Name:*<input type="text" name="firstName" id="firstName" <?= (isset($_POST['firstName']) ? 'value="' . $_POST['firstName'] . '"' : '') ?> required />
		Middle Initial:<input type="text" name="middleName" id="middleName" <?= (isset($_POST['middleName']) ? 'value="' . $_POST['middleName'] . '"' : '') ?> />
		Last Name:*<input type="text" name="lastName" id="lastName" <?= (isset($_POST['lastName']) ? 'value="' . $_POST['lastName'] . '"' : '') ?> required />
	</div>
	<div class="dob">
		<label for="dob">DOB*</label>
		<input type="date" id="dob" name="dob" <?= (isset($_POST['dob']) ? 'value="' . $_POST['dob'] . '"' : '') ?> required />
	</div>
	<div class="phone">
		<label for="phone">Phone Number*</br>Format:123-456-7890</label>
		<input type="tel" id="tel" name="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" <?= (isset($_POST['tel']) ? 'value="' . $_POST['tel'] . '"' : '') ?> required />
	</div>
	<div class="address">
		<p>Please Enter Your Address:</p>
		Street Address:* <input type="text" name="address1" id="address1" <?= (isset($_POST['address1']) ? 'value="' . $_POST['address1'] . '"' : '') ?> required />
		Address Line 2:<input type="text" name="address2" id="address2" <?= (isset($_POST['address2']) ? 'value="' . $_POST['address2'] . '"' : '') ?> />
		City:*<input type="text" name="city" id="city" <?= (isset($_POST['city']) ? 'value="' . $_POST['city'] . '"' : '') ?> required />
		State:<select id="state" name="state" required>
			<option value="AL" <?= ((isset($_POST['state']) && $_POST['state'] === 'AL') ? 'selected' : '') ?>>AL</option>
			<option value="AK" <?= ((isset($_POST['state']) && $_POST['state'] === 'AK') ? 'selected' : '') ?>>AK</option>
			<option value="AZ" <?= ((isset($_POST['state']) && $_POST['state'] === 'AZ') ? 'selected' : '') ?>>AZ</option>
			<option value="AR" <?= ((isset($_POST['state']) && $_POST['state'] === 'AR') ? 'selected' : '') ?>>AR</option>
			<option value="CA" <?= ((isset($_POST['state']) && $_POST['state'] === 'CA') ? 'selected' : '') ?>>CA</option>
			<option value="CO" <?= ((isset($_POST['state']) && $_POST['state'] === 'CO') ? 'selected' : '') ?>>CO</option>
			<option value="CT" <?= ((isset($_POST['state']) && $_POST['state'] === 'CT') ? 'selected' : '') ?>>CT</option>
			<option value="DE" <?= ((isset($_POST['state']) && $_POST['state'] === 'DE') ? 'selected' : '') ?>>DE</option>
			<option value="DC" <?= ((isset($_POST['state']) && $_POST['state'] === 'DC') ? 'selected' : '') ?>>DC</option>
			<option value="FL" <?= ((isset($_POST['state']) && $_POST['state'] === 'FL') ? 'selected' : '') ?>>FL</option>
			<option value="GA" <?= ((isset($_POST['state']) && $_POST['state'] === 'GA') ? 'selected' : '') ?>>GA</option>
			<option value="HI" <?= ((isset($_POST['state']) && $_POST['state'] === 'HI') ? 'selected' : '') ?>>HI</option>
			<option value="ID" <?= ((isset($_POST['state']) && $_POST['state'] === 'ID') ? 'selected' : '') ?>>ID</option>
			<option value="IL" <?= ((isset($_POST['state']) && $_POST['state'] === 'IL') ? 'selected' : '') ?>>IL</option>
			<option value="IN" <?= ((isset($_POST['state']) && $_POST['state'] === 'IN') ? 'selected' : '') ?>>IN</option>
			<option value="IA" <?= ((isset($_POST['state']) && $_POST['state'] === 'IA') ? 'selected' : '') ?>>IA</option>
			<option value="KS" <?= ((isset($_POST['state']) && $_POST['state'] === 'KS') ? 'selected' : '') ?>>KS</option>
			<option value="KY" <?= ((isset($_POST['state']) && $_POST['state'] === 'KY') ? 'selected' : '') ?>>KY</option>
			<option value="LA" <?= ((isset($_POST['state']) && $_POST['state'] === 'LA') ? 'selected' : '') ?>>LA</option>
			<option value="ME" <?= ((isset($_POST['state']) && $_POST['state'] === 'ME') ? 'selected' : '') ?>>ME</option>
			<option value="MD" <?= ((isset($_POST['state']) && $_POST['state'] === 'MD') ? 'selected' : '') ?>>MD</option>
			<option value="MA" <?= ((isset($_POST['state']) && $_POST['state'] === 'MA') ? 'selected' : '') ?>>MA</option>
			<option value="MI" <?= ((isset($_POST['state']) && $_POST['state'] === 'MI') ? 'selected' : '') ?>>MN</option>
			<option value="MS" <?= ((isset($_POST['state']) && $_POST['state'] === 'MS') ? 'selected' : '') ?>>MS</option>
			<option value="MO" <?= ((isset($_POST['state']) && $_POST['state'] === 'MO') ? 'selected' : '') ?>>MO</option>
			<option value="MT" <?= ((isset($_POST['state']) && $_POST['state'] === 'MT') ? 'selected' : '') ?>>MT</option>
			<option value="NE" <?= ((isset($_POST['state']) && $_POST['state'] === 'NE') ? 'selected' : '') ?>>NE</option>
			<option value="NV" <?= ((isset($_POST['state']) && $_POST['state'] === 'NV') ? 'selected' : '') ?>>NV</option>
			<option value="NH" <?= ((isset($_POST['state']) && $_POST['state'] === 'NH') ? 'selected' : '') ?>>NH</option>
			<option value="NJ" <?= ((isset($_POST['state']) && $_POST['state'] === 'NJ') ? 'selected' : '') ?>>NJ</option>
			<option value="NM" <?= ((isset($_POST['state']) && $_POST['state'] === 'NM') ? 'selected' : '') ?>>NM</option>
			<option value="NY" <?= ((isset($_POST['state']) && $_POST['state'] === 'NY') ? 'selected' : '') ?>>NY</option>
			<option value="NC" <?= ((isset($_POST['state']) && $_POST['state'] === 'NC') ? 'selected' : '') ?>>NC</option>
			<option value="ND" <?= ((isset($_POST['state']) && $_POST['state'] === 'ND') ? 'selected' : '') ?>>ND</option>
			<option value="OH" <?= ((isset($_POST['state']) && $_POST['state'] === 'OH') ? 'selected' : '') ?>>OH</option>
			<option value="OK" <?= ((isset($_POST['state']) && $_POST['state'] === 'OK') ? 'selected' : '') ?>>OK</option>
			<option value="OR" <?= ((isset($_POST['state']) && $_POST['state'] === 'OR') ? 'selected' : '') ?>>OR</option>
			<option value="PA" <?= ((isset($_POST['state']) && $_POST['state'] === 'PA') ? 'selected' : '') ?>>PA</option>
			<option value="RI" <?= ((isset($_POST['state']) && $_POST['state'] === 'RI') ? 'selected' : '') ?>>RI</option>
			<option value="SC" <?= ((isset($_POST['state']) && $_POST['state'] === 'SC') ? 'selected' : '') ?>>SC</option>
			<option value="SD" <?= ((isset($_POST['state']) && $_POST['state'] === 'SD') ? 'selected' : '') ?>>SD</option>
			<option value="TN" <?= ((isset($_POST['state']) && $_POST['state'] === 'TN') ? 'selected' : '') ?>>TN</option>
			<option value="TX" <?= ((isset($_POST['state']) && $_POST['state'] === 'TX') ? 'selected' : '') ?>>TX</option>
			<option value="UT" <?= ((isset($_POST['state']) && $_POST['state'] === 'UT') ? 'selected' : '') ?>>UT</option>
			<option value="VT" <?= ((isset($_POST['state']) && $_POST['state'] === 'VT') ? 'selected' : '') ?>>VT</option>
			<option value="VA" <?= ((isset($_POST['state']) && $_POST['state'] === 'VA') ? 'selected' : '') ?>>VA</option>
			<option value="WA" <?= ((isset($_POST['state']) && $_POST['state'] === 'WA') ? 'selected' : '') ?>>WA</option>
			<option value="WV" <?= ((isset($_POST['state']) && $_POST['state'] === 'WV') ? 'selected' : '') ?>>WV</option>
			<option value="WI" <?= ((isset($_POST['state']) && $_POST['state'] === 'WI') ? 'selected' : '') ?>>WI</option>
			<option value="WY" <?= ((isset($_POST['state']) && $_POST['state'] === 'WY') ? 'selected' : '') ?>>WY</option>
		</select>
		ZIP:*<input type="number" name="zip" id="zip" maxlength="5" <?= (isset($_POST['zip']) ? 'value="' . $_POST['zip'] . '"' : '') ?> required />
		Country:*<input type="text" name="country" id="country" <?= (isset($_POST['country']) ? 'value="' . $_POST['country'] . '"' : '') ?> required />
	</div>
	<div class="email">
		Enter an Email<input type="email" id="email" name="email" placeholder="email@example.com" <?= (isset($_POST['email']) ? 'value="' . $_POST['email'] . '"' : '') ?> required />
	</div>
	<label>Select Job Applying For</label>
	<select id="title" name="title" required>
		<option value=""></option>
		<option value="retail" <?= (isset($_POST['title']) && $_POST['title'] === 'retail') ? 'selected' : ''; ?>>Retail</option>
		<option value="retail leadership" <?= (isset($_POST['title']) && $_POST['title'] === 'retail leadership') ? 'selected' : ''; ?>>Retail Leadership</option>
		<option value="corporate" <?= (isset($_POST['title']) && $_POST['title'] === 'corporate') ? 'selected' : ''; ?>>Corporate</option>
		<option value="dist" <?= (isset($_POST['title']) && $_POST['title'] === 'dist') ? 'selected' : ''; ?>>Manufacturing and Distribution</option>
	</select>
	<div class="file">
		<h3>Upload Resume:</h3>
		<input type="file" name="resume" id="resume" />
	</div>
	<div class="submit">
		<input type="submit" name="submit_btn" value="Submit Application" />
	</div>
</form>

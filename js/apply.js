// Wait for the DOM to be ready
$(function () {
	// Initialize form validation on the registration form.
	// It has the name attribute "registration"
	$("form[name='applyForm']").validate({
		// Specify validation rules
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			firstName: {
				required: true,
				minlength: 1,
				maxlength: 30,
				specialChars: true,
			},
			middleName: {
				maxlength: 30,
				specialChars: true,
			},
			lastName: {
				required: true,
				minlength: 1,
				maxlength: 30,
				specialChars: true,
			},
			email: {
				required: true,
				minlength: 5,
				maxlength: 50,
				// Specify that email should be validated
				// by the built-in "email" rule
				email: true,
			},
			// resume: {
			// 	accept: "application/msword,application/pdf"
			// },
			//,application/vnd.openxmlformats-officedocument.wordprocessingml application/vnd.oasis.opendocument.text,
		},
		// Specify validation error messages
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
			},
			email: "Please enter a valid email address",
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function (form) {
			form.submit();
		},
	});

	jQuery.validator.addMethod("specialChars", function (value, element) {
		var regex = new RegExp("^[a-zA-Z0-9'-]+$");
		var key = String.fromCharCode(event.charCode ? event.which : event.charCode);

		if (!regex.test(key)) {
			return false;
		}
	}, "No special characters allowed");

	jQuery.validator.addMethod("file", function (value, element) {
		console.log(element);
		var ext = $(element).val().split(".").pop().toLowerCase();
		if ($.inArray(ext, ["pdf", "doc", "docx", "odf"]) == -1) {
			return false;
		}
	}, "Invalid file format (pdf,doc,docx,odf supported)");
});

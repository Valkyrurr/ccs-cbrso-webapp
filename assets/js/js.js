/**
 * 
 */
$('#search').on(
		'hidden.bs.collapse',
		function() {
			$(this).prev().find(".glyphicon.glyphicon-chevron-up").removeClass(
					"glyphicon-chevron-up").addClass("glyphicon-chevron-down");
		});

$('#search').on(
		'shown.bs.collapse',
		function() {
			$(this).prev().find(".glyphicon.glyphicon-chevron-down")
					.removeClass("glyphicon-chevron-down").addClass(
							"glyphicon-chevron-up");
		});

$('#register').on(
		'hidden.bs.collapse',
		function() {
			$(this).prev().find(".glyphicon.glyphicon-chevron-up").removeClass(
					"glyphicon-chevron-up").addClass("glyphicon-chevron-down");
		});

$('#register').on(
		'shown.bs.collapse',
		function() {
			$(this).prev().find(".glyphicon.glyphicon-chevron-down")
					.removeClass("glyphicon-chevron-down").addClass(
							"glyphicon-chevron-up");
		});

$(document).ready(function() {
	$('input[type=button]').click(function() {
		$(this).hide();
		$(".btn.hidden").removeClass("hidden").show();
	});
});

/* Used for /root/user/index.php. WORKING! Used for /root/user/settings.php. */
var password = document.getElementById("password");
var validate_password = document.getElementById("validate-password");
var validate_password_ref = document.getElementById("validate-password-ref");

function validatePassword() {
	if (validate_password.value != validate_password_ref.value) {
		validate_password_ref.setCustomValidity("Passwords Do Not Match!");
		$("#validate-password-ref").parent().addClass("has-error");
	} else {
		validate_password_ref.setCustomValidity("");
		$("#validate-password-ref").parent().removeClass("has-error");
	}
}

function validatePasswordLength() {
	if(validate_password.value.length >= 6){
		validate_password.setCustomValidity("");
	} else {
		validate_password.setCustomValidity("Password minimum length is 6.");
	}
}

function validatePasswordIfBlank() {
	if(password.value === "" && validate_password_ref.value !== ""){
		password.setCustomValidity("Field must not be blank");
	} else {
		password.setCustomValidity("");
	}
}

//validate_password.onchange = validatePassword;
//validate_password_ref.onkeyup = validatePassword;
$(validate_password).on("change keyup", validatePassword);
$(validate_password).on("change input", validatePasswordLength);
$(validate_password_ref).on("change keyup", validatePassword);
$(validate_password_ref).on("change input", validatePasswordIfBlank);
$(password).on("change input", validatePasswordIfBlank);
/* END OF function() */
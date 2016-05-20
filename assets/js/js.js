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

var validate_password = document.getElementById("validate-password");
var validate_password_ref = document.getElementById("validate-password-ref");

function validatePassword() {
	if (validate_password.value != validate_password_ref.value) {
		validate_password_ref.setCustomValidity("Passwords Do Not Match!");
		$("#validate-password-ref").parent().addClass("has-error");
	} else {
		validate_password_ref.setCustomValidity('');
		$("#validate-password-ref").parent().removeClass("has-error");
	}
}

validate_password.onchange = validatePassword;
validate_password_ref.onkeyup = validatePassword;
<?php
if(mail("ccs.cbrso.smtp@gmail.com", "PHP E-mail Script!", "Hello World!")){
	echo "Email sent.";
} else {
	echo "FUCK!";
}
?>
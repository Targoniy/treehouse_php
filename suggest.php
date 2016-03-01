<?php

if (($_SERVER["REQUEST_METHOD"]) == "POST"){
        $name    = trim(filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING));
        $email   = trim(filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL));
        $details = trim(filter_input(INPUT_POST,"details", FILTER_SANITIZE_SPECIAL_CHARS));

        if ($name == "" OR $email == "" OR $details == "") {
        	echo "Please fill in the required fields: Name, Email and Details";
        	exit;
        }
        if ($_POST["adress"] != "" ) {

        	echo("Bad input.");
        	exit;
        }

        require("inc/phpmailer/class.phpmailer.php") ;

        $mail = new PHPMailer;

        if (!$mail->ValidateAddress($email)) {
        	echo("Invalid Email Adress");
        	exit;
        }

        echo "<pre>";
        $email_body = "Name " . $name . "\n"
            . "Email " . $email . "\n"
            . "Details " . $details . "\n";
        echo ($email_body);
        echo "<pre>";

        header("location:thanks.php");
    }
$pageTitle = "Suggest a Media Item";
$section = "suggest";
include "inc/header.php";
?>
<div class="section page">
	<div class="wrapper">

			<h1>Suggest a Media Item</h1>
			<?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") {
				echo "<p>Thanks for the email!</p>";
				}   else { ?> 

			<p>If you think there is something I&rsquo;m missing, let me know. Complete the form to send me an email.</p>
			<form action="suggest.php" method="post">
				<table>
				<tr>
					<th><label for="name">Name</label></th>
					<td><input type="text" id="name" name = "name"></td>
				</tr>
				<tr>
					<th><label for="email">Email</label></th>
					<td><input type="text" id="email" name = "email"></td>
				</tr>
				<tr>
					<th><label for="name">Suggest Item Details</label></th>
					<td><textarea name="details" id="details"></textarea></td>
				</tr>
				<tr style="display: none">
					<th><label for="adress">adress</label></th>
					<td><input type="text" id="adress" name = "adress">
					<p>Please, leave  this field blank</p>
					</td>
				</tr>
			</table>
		<input type="submit" value="Send">
		</form>
		<?php } ?>
	</div>
</div>

<?php include "inc/footer.php";?>
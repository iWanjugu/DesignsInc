<?php
		//This code runs if the form has been submitted
		if (isset($_POST['submit']))
		{
error_reporting(E_ERROR | E_PARSE);
$database_hostname = "localhost";
$database_username = "root";
$database_password = "";


$main_database = "laikiana_db";
mysql_connect($database_hostname,$database_username,$database_password);
mysql_select_db("laikiana_db");


			//This makes sure they did not leave any fields blank
			if ($_POST['mail_to'] == "" || $_POST['mail_body'] == "" || $_POST['mail_subject'] == "")
			{
				$message = 'You did not complete all of the required fields';
			}

			// checks if the username is in use
			if (!get_magic_quotes_gpc()) {
				$_POST['mail_to'] = addslashes($_POST['mail_to']);
			}

			$usercheck = $_POST['mail_to'];
			$check = mysql_query("SELECT email FROM um_laikiana WHERE coname = '$usercheck' OR  email = '$usercheck' OR  pname = '$usercheck'") or die(mysql_error());
			$check2 = mysql_num_rows($check);

			//if the name exists it gives an error
			if ($check2) {
				$message = 'Sorry, the Person '.$_POST['mail_to'].' Does Not exist.';
			}

			// this makes sure both passwords entered match


			// here we encrypt the password and add slashes if needed
			if (!get_magic_quotes_gpc()) {
				$_POST['mail_to'] = addslashes($_POST['mail_to']);
				$_POST['mail_subject'] = addslashes($_POST['mail_subject']);
				$_POST['mail_body'] = addslashes($_POST['mail_body']);
			}


			// now we insert it into the database
			$query_upload = "INSERT INTO mail (mail_from, mail_to, mail_subject,mail_body,mail_sent) VALUES ('$email', '".$_POST['mail_to']."', '".$_POST['mail_subject']."','".$_POST['mail_body']."', '".date("Y-m-d H:i:s")."')";

				mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());
				if($result) { ?>
			<script> alert('Sent') </script><?php
			}
}

?>

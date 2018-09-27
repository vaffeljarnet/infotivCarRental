<?php
  // when the login button is pressed this will unset all session info, exit the session and send the user back to where they belong.
if (isset($_POST['submit'])) {
	session_start();
	session_unset();
	session_destroy();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
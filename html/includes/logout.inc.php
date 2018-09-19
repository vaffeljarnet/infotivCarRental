<?php

if (isset($_POST['submit'])) {
	session_start();
	session_unset();
	session_destroy();
	header("location:javascript://history.go(-1)");
}
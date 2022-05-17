<?php
	session_start();
    $lg_c = "en";

	if (!isset($_SESSION['lang']))
		$_SESSION['lang'] = "en";
        $lg_c = "fr";
	else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
		if ($_GET['lang'] == "en")
			$_SESSION['lang'] = "en";
            $lg_c = "fr";
		else if ($_GET['lang'] == "fr")
			$_SESSION['lang'] = "fr";
            $lg_c = "en";
	}

	require_once "languages/" . $_SESSION['lang'] . ".php";
?>
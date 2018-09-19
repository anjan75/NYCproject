<?php
// ob_start();
//page redirect
function redirect($page) {
	header('location: ' . URLROOT . '/' . $page);
}

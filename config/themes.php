<?php
$admin_theme = [
    "dir" => "default_admin/blue",
    "template" => "admin.php",
];

$themes['admin'] = $admin_theme;
$livestock247_theme = [
    "dir" => "livestock247/default",
    "template" => "livestock247.php",
];

$login_theme = [
    "dir" => "login/default",
    "template" => "login.php",
];



$blogger_theme = [
    "dir" => "blogger/default",
    "template" => "blogger.php",
];



$themes['login'] = $login_theme;
$themes['blogger'] = $blogger_theme;
$themes['livestock247'] = $livestock247_theme;

define('THEMES', $themes);

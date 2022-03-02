<?php
session_start();
require_once ('../connections/connection.php');
if (!isset($_SESSION['role']) || $_SESSION['role']!=1){
    header("Location:../../index.php");
}
<?php
$conn = new mysqli ('localhost','root','','users_app');
if(!$conn){
    die("connect is error");
}
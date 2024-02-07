<?php

include('models/HomeModel.php');

function index() {
    $servicesResult = getServices();
    include('views/home.php');
}

index();

?>

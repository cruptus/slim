<?php
/**
 * Les routes
 */
$app->get("/", \App\Controllers\DefaultController::class.':index');
$app->post("/", \App\Controllers\DefaultController::class.':index')->setName("test");

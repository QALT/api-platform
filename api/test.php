<?php

use Carbon\Carbon;

require "vendor/autoload.php";

use Faker\Factory;

$faker = Factory::create();

$startDate = $faker->dateTimeBetween("-20 year", "-10 years")->format("Y-m-d");
$endDate = $faker->dateTimeBetween("-10 years", "now")->format("Y-m-d");

var_dump($startDate);
var_dump($endDate);

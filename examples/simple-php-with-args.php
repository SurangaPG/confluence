#!/usr/bin/env php

<?php
# Get the composer autoloader

// This will be different based on where the autoloader is placed.
include_once "../vendor/autoload.php";

// Load in the data for your credentials etc here. In whichever way is appropriate
// for your implementation.
$pass = "findMyPass";
$user = "findMyUser";
$endpoint = "findMyEndpoint";
$pageId = "findMyPageId";

$confluence = new \surangapg\confluence\Confluence($endpoint, $user, $pass);

// Load in the page
$page = $confluence->getPage($pageId);

// Do whatever you may need. Using the data from the response etc wherever
// you may need it. 
$data = [
  'title' => 'myTitle',
  'text' => 'myText',
];

$page = $confluence->setPage($pageId, $data);
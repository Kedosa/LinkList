<?php
include_once __DIR__.'/app/Autoloader.php';
include_once __DIR__.'/app/service/linkArray.php';
$links = new app\Links($menu);
$links->searchArray();
$links->createSite($menu);

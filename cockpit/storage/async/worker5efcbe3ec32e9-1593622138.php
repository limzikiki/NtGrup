<?php

// include cockpit
include('C:/Server/data/htdocs/cockpit/bootstrap.php');
const ASYNC_PARAMS = NULL;

?><?php cockpit()->helper('jobs')->stopRunner();cockpit()->helper('jobs')->run();

// delete script after execution
unlink(__FILE__);

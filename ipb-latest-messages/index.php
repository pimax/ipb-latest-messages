<?php

require_once dirname(__FILE__).'/classes/IpbLatestMessages.php';
require_once dirname(__FILE__).'/classes/IpbPost.php';
$config = include dirname(__FILE__).'/config/main.php';

$oMessages = new IpbLatestMessages($config);
$oMessages->show();
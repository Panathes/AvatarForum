<?php

use App\Messenger;
use App\ImageSizer;

require __DIR__ . '/vendor/autoload.php';

const ROOT_DIR = __DIR__;
const UPLOAD_DIR = ROOT_DIR.'/upload/';

$messenger = new Messenger();
$sizer = new ImageSizer();

$messenger->createAvatarChanel();
echo " [*] Waiting for messages. To exit press CTRL+C\n";

$messenger->sendAvatarPath(function ($msg) use($sizer) {
    echo ' [x] Received ', $msg->body, "\n";
    $sizer->resize($msg->body);
});

$messenger->waitAvatarChanel();

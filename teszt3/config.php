<?php

$cfg = [];
$cfg["pageKey"] = "p";
$cfg["flagSign"] = "§";
$cfg["flagPattern"] = "/{$cfg["flagSign"]}([A-Z]+){$cfg["flagSign"]}/";
$cfg["defaultPage"] = "index";
$cfg["defaultAdminPage"] = "?{$cfg["pageKey"]}=admin";
$cfg["pageHeaderFlag"] = "HEADER";
$cfg["pageContentFlag"] = "CONTENT";
$cfg["sessionAuthKey"] = "auth";



$cfg["contentFolder"] = "content";
$cfg["imagesFolder"] = $cfg["contentFolder"]."/images";
$cfg["tmpFolder"] = $cfg["contentFolder"]."/tmp";


$cfg["SMTPServer"] = "mail.ruander.eu";
$cfg["SMTPPort"] = 465;
$cfg["emailContact"] = "kis.balazs@ruander.hu";
$cfg["SMTPFrom"] = "webpelda@ruander.eu";
$cfg["SMTPPass"] = "Ruander2000";

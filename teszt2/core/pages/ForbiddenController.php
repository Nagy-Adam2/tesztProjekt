<?php

abstract class ForbiddenController implements IPageBase
{
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        global $cfg;
        if(isset($_GET["page"]))
        {
            View::getBase()->AddData("PAGE", htmlspecialchars($_GET["page"]));
        }
        if(isset($_SESSION[$cfg["pageMessage"]]))
        {
            View::getBase()->AddData("DESCRIPTION", $_SESSION[$cfg["pageMessage"]]);
        }
    }
}

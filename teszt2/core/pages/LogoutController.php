<?php

abstract class LogoutController implements IPageBase
{
    #[\Override]
    public static function Run(?\Template $template = null): void 
    {
        PermissionHandler::Logout();
        header("Location: index.php");
    }
}

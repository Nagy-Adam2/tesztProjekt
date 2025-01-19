<?php

abstract class NotFoundController implements IPageBase
{
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        if(isset($_GET["page"]))
        {
            View::getBase()->AddData("PAGE", htmlspecialchars($_GET["page"]));
        }
    }
}

<?php

abstract class IndexController implements IPageBase
{
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        try
        {
            $template->AddData("WELCOME", Model::GetText("maintext")["value"]);
        }
        catch (KeyNotFoundException $ex)
        {
            //Logger
        }
    }
}

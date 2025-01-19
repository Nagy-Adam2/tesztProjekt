<?php


abstract class AboutController implements IPageBase
{
    //put your code here
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        try
        {
            $template->AddData("ABOUT", Model::GetText("aboutText")["value"]);
        }
        catch (KeyNotFoundException $ex)
        {
            //Logger
            $template->AddData("ABOUT", "Hamarosan...");
        }
    }
}

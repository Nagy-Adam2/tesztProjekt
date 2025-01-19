<?php

abstract class AdminTextsController implements IPageBase
{
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        if(isset($_POST["ok"]))
        {
            if(isset($_POST["text"]) && isset($_POST["key"]))
            {
                $text = $_POST["text"];
                $textKey = htmlspecialchars($_POST["key"]);
                try
                {
                    Model::SetText($textKey, $text);
                    $template->AddData("RESPONSE", "A $textKey megváltozott!");
                }
                catch (KeyNotFoundException $ex)
                {
                    $template->AddData("RESPONSE", $ex->getMessage());
                }
            }
            else
            {
                $template->AddData("RESPONSE", "Hiányos adatok!");
            }
        }
        $texts = Model::GetAllTexts();
        foreach ($texts as $key=>$value)
        {
            $t = Template::LoadFromFile("textForm.html");
            $t->AddData("ID", $key);
            $t->AddData("NAME", $value["title"]);
            $t->AddData("VALUE", trim($value["value"]));
            $template->AddData("FORMS", $t);
            $template->AddData("SUMMERNOTES", "$('#$key').summernote();");
        }
    }
}

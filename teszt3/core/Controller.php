<?php

abstract class Controller
{
    public static function Route() : void
    {
        global $cfg;
        View::Init(Template::LoadFromFile($cfg["defaultPage"].".html"));
        $page = $cfg["defaultPage"];
        if(isset($_GET[$cfg["pageKey"]]))
        {
            $page = trim(htmlspecialchars($_GET[$cfg["pageKey"]]));
        }
        try
        {
            $pageInfo = Model::GetPageInfo($page);
            if(PermissionHandler::CheckPagePermission($pageInfo["permission"]))
            {
                if(in_array("IPageBase", class_implements($pageInfo["class"])))
                {
                    $template = null;
                    if($pageInfo["basePage"] === false)
                    {
                        View::setBase(Template::LoadFromFile($pageInfo["template"]));
                    }
                    else
                    {
                        $template = Template::LoadFromFile($pageInfo["template"]);
                        View::setBase(Template::LoadFromFile($pageInfo["basePage"]));
                        View::getBase()->AddData($cfg["pageContentFlag"], $template);
                    }
                    $pageInfo["class"]::Run($template);
                }        
                else
                {
                    throw new PageException($page, "A megadott oldal nem teljesíti a szükséges előkövetelményeket!");
                }
            }
            else
            {
                throw new PageException($page, "A megadott oldal megtekintéséhez magasabb jog szükséges!");
            }
        }
        catch (PageException $ex)
        {
            //Logger
            $_SESSION[$cfg["pageMessage"]] = $ex->getMessage();
            header("Location: ?{$cfg["pageKey"]}=forbidden&page=$page");
        }
        catch (PageNotFoundException $ex)
        {
            //Logger
            header("Location: ?{$cfg["pageKey"]}=notFound&page=$page");
        }
        View::PrintFinal();
    }
}

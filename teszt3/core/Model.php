<?php

abstract class Model
{
    public static function GetPageInfo(string $key) : array
    {
        global $cfg;
        $json = json_decode(file_get_contents($cfg["contentFolder"]."/pages.json"), true);
        if(array_key_exists($key, $json) && is_array($json[$key]))
        {
            return $json[$key];
        }
        throw new PageNotFoundException("A megadott oldal nem található!");
    }
    
    public static function GetAllTexts() : array
    {
        global $cfg;
        return json_decode(file_get_contents($cfg["contentFolder"]."/recipes-and-messages.json"), true);
    }
    
    public static function SetText(string $key, string $value) : void
    {
        global $cfg;
        $texts = json_decode(file_get_contents($cfg["contentFolder"]."/recipes-and-messages.json"), true);
        if(isset($texts[$key]))
        {
            $texts[$key]["value"] = $value;
            file_put_contents($cfg["contentFolder"]."/recipes-and-messages.json", json_encode($texts));
        }
        else
        {
            throw new KeyNotFoundException("A megadott szöveges kulcs ($key) nem található!");
        }
    }
    
    public static function GetText(string $key) : array
    {
        global $cfg;
        $texts = json_decode(file_get_contents($cfg["contentFolder"]."/recipes-and-messages.json"), true);
        if(isset($texts[$key]))
        {
            return $texts[$key];
        }
        else
        {
            throw new KeyNotFoundException("A megadott szöveges kulcs ($key) nem található!");
        }
    }
}

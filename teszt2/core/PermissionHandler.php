<?php

abstract class PermissionHandler
{
    public static function CheckPagePermission(int $pagePermission) : bool
    {
        global $cfg;
        return Permissions::from($pagePermission) == Permissions::Guest || isset($_SESSION[$cfg["sessionAuthKey"]]) && Permissions::from($_SESSION[$cfg["sessionAuthKey"]]["permission"])->value >= Permissions::from($pagePermission)->value;
    }
    
    public static function SetLogin(string $user, Permissions $perm) : void
    {
        global $cfg;
        unset($_SESSION[$cfg["sessionAuthKey"]]);
        $_SESSION[$cfg["sessionAuthKey"]] = ["user" => $user, "permission" => $perm->value];
    }
    
    public static function Logout() : void
    {
        global $cfg;
        unset($_SESSION[$cfg["sessionAuthKey"]]);
    }
}

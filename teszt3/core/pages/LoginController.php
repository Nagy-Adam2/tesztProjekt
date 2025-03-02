<?php

abstract class LoginController implements IPageBase
{
    //put your code here
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        global $cfg;
        if(isset($_POST["ok"]))
        {
            if(isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["captcha"]))
            {
                $user = htmlspecialchars(trim($_POST["user"]));
                $captcha = htmlspecialchars(trim($_POST["captcha"]));
                $pass = hash("sha256", trim($_POST["pass"]));
                if(strtolower($captcha) == strtolower($_SESSION["captcha"]))
                {
                    if($user == "admin" && $pass == "86a53dd33aa2112aa01a03ed488a794cfbbfe92607678827e25b7b1f52dad8a2")
                    {
                        PermissionHandler::SetLogin($user, Permissions::Admin);
                        header("Location: index.php{$cfg["defaultAdminPage"]}");
                    }
                    else
                    {
                        View::getBase()->AddData("RESPONSE", "Hibás felhasználónév / jelszó!");
                    }
                }
                else
                {
                    View::getBase()->AddData("RESPONSE", "Hibás CAPTCHA!");
                }
            }
            else
            {
                View::getBase()->AddData("RESPONSE", "Hiányos belépési információk!");
            }
        }
        $captchaData = self::GenCaptcha();
        View::getBase()->AddData("BASEIMG", $captchaData["img64"]);
        $_SESSION["captcha"] = $captchaData["code"];
    }
    
    private static function GenCaptcha(int $charNum = 6, int $height = 75, array $fonts = ["1.ttf", "2.ttf"]) : array
    {
        global $cfg;
        $chars = [];
        for($i = 0; $i < $charNum; $i++)
        {
            $c = "";
            switch (rand(1,3))
            {
                case 1:
                    $c = chr(rand(48, 57));
                    break;
                case 2:
                    $c = chr(rand(65, 90));
                    break;
                case 3:
                    $c = chr(rand(97, 122));
                    break;
            }
            $chars[] = $c;
        }
        $captcha = imagecreatetruecolor($charNum * 50, $height);
        imagefill($captcha, 0, 0, imagecolorallocate($captcha, rand(0,100), rand(0,100), rand(0,100)));
        $i = 0;
        foreach ($chars as $c)
        {
            imagettftext($captcha, rand(16, 38), rand(-30, 30), $i * 50 + rand(0, 15), $height - rand($height * 0.2, $height * 0.6) , imagecolorallocate($captcha, rand(80, 160), rand(80, 160), rand(80, 160)), $cfg["contentFolder"]."/fonts/".$fonts[rand(0, count($fonts)-1)], $c);
            $i++;
        }
        $f = ["rectangle", "line", "ellipse"];
        for($i = 0; $i < 5; $i++)
        {
            $func = "image".$f[rand(0, count($f)-1)];
            $func($captcha, rand(0, imagesx($captcha)), rand(0, imagesy($captcha)), rand(0, imagesx($captcha)), rand(0, imagesy($captcha)), imagecolorallocate($captcha, rand(80, 160), rand(80, 160), rand(80, 160)));
        }
        /*header("Content-type: image/png");
        imagepng($captcha);*/
        $name = sha1(rand(1, 10000).microtime().implode(".", $chars)).".png";
        imagepng($captcha, $cfg["tmpFolder"]."/$name");
        $kep = base64_encode(file_get_contents($cfg["tmpFolder"]."/$name"));
        unlink($cfg["tmpFolder"]."/$name");
        return ["img64" => $kep, "code" => implode("", $chars)];
    }
}

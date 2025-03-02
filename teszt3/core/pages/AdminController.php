<?php


abstract class AdminController implements IPageBase
{
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        global $cfg;
        if(isset($_POST["ok"]))
        {
            if(isset($_FILES["logo"]) && $_FILES["logo"]["error"] == 0)
            {
                $mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES["logo"]["tmp_name"]);
                if(in_array($mime, ["image/jpeg", "image/pjpeg", "image/png"]))
                {
                    if(move_uploaded_file($_FILES["logo"]["tmp_name"], $cfg["imagesFolder"]."/tmp.file"))
                    {
                        self::ResizeLogo($cfg["imagesFolder"]."/tmp.file", $mime);
                        unlink($cfg["imagesFolder"]."/tmp.file");
                        $template->AddData("RESPONSE", "A feltöltés sikeres!");
                    }
                    else
                    {
                        $template->AddData("RESPONSE", "A fájl véglgesítése sikertelen!");
                    }
                }
                else
                {
                    $template->AddData("RESPONSE", "A kép típusa nem megfelelő! (PNG, vagy JPG kell legyen!)");
                }
            }
            else
            {
                $template->AddData("RESPONSE", "A fájl feltöltése meghiúsult!");
            }
        }
    }
    
    private static function ResizeLogo(string $img, string $mime) : void
    {
        global $cfg;
        switch ($mime)
        {
            case "image/jpeg":
            case "image/pjpeg":
                $gd = imagecreatefromjpeg($img);
                break;
            case "image/png":
                $gd = imagecreatefrompng($img);
                break;
            default:
                throw new Exception("Hibás formátum");
        }
        //200X150
        if(imagesx($gd) != 200 || imagesy($gd) != 150)
        {
            $logo = imagecreatetruecolor(200, 150);
            imagecopyresampled($logo, $gd, 0, 0, 0, 0, 200, 150, imagesx($gd), imagesy($gd));
        }
        else
        {
            $logo = $gd;
        }
        imagepng($logo, $cfg["imagesFolder"]."/logo.png");
    }
}

<?php

abstract class ContactController implements IPageBase
{
    //put your code here
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        global $cfg;
        if(isset($_POST["ok"]))
        {
            if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"]))
            {
                if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL))
                {
                    $name = htmlspecialchars($_POST["name"]);
                    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                    $subject = htmlspecialchars($_POST["subject"]);
                    //$message = htmlspecialchars($_POST["message"]);
                    $message = $_POST["message"];
                    /*if(mail($cfg["emailContact"], $subject, "$name küldi a következőt:\n$message", ["From" =>"php@example.local", "Reply-To" => $email]))
                    {
                        $template->AddData("RESPONSE", "Köszönjük levelét, kollégánk hamarosan jelentkezik!");
                    }
                    else
                    {
                        $template->AddData("RESPONSE", "Hiba a kiküldés során! Próbálkozzon később!");
                    }*/
                    try
                    {
                       $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                       $mail->isHTML();
                       $mail->isSMTP();
                       $mail->SMTPDebug = 2;
                       $mail->SMTPAuth = true;
                       $mail->Username = $cfg["SMTPFrom"];
                       $mail->Password = $cfg["SMTPPass"];
                       $mail->Port = $cfg["SMTPPort"];
                       $mail->Host = $cfg["SMTPServer"];
                       $mail->SMTPSecure = "ssl";
                       
                       $mail->From = $cfg["SMTPFrom"];
                       $mail->FromName = "PHP Weboldal";
                       $mail->addAddress($cfg["emailContact"]);
                       $mail->Subject = $subject;
                       //$mail->Body = "$name küldi a következőt:\n$message";
                       $mail->msgHTML("$name küldi a következőt:\n$message");
                       $mail->addCustomHeader("Reply-To", $email);
                       $mail->CharSet = "UTF-8";
                       $mail->send();
                       $template->AddData("RESPONSE", "Köszönjük levelét, kollégánk hamarosan jelentkezik!");
                    } 
                    catch (Exception $ex)
                    {
                        //$template->AddData("RESPONSE", "Hiba a kiküldés során! Próbálkozzon később!");
                        $template->AddData("RESPONSE", $ex->getMessage());
                    }
                }
                else 
                {
                    $template->AddData("RESPONSE", "A megadott email cím formai hibás!");
                }
            }
            else 
            {
                $template->AddData("RESPONSE", "Kérjük az összes mezőt töltse ki!");
            }
        }
    }
}

<?php


abstract class MessagesController implements IPageBase
{
    //put your code here
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        try
        {
            $template->AddData("NAVIGATION", 
                '<div class="container-fluid">
                    <a class="navbar-brand" href="?p=index">Ételeink</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="justify-content-end collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-4">
                            <li class="nav-item mx-1">
                                <a class="nav-link" aria-current="index" href="?p=index">Ételek receptjei</a>
                            </li>
                            <li class="nav-item mx-1">
                                <a class="nav-link" href="?p=messages">Üzenetek</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav navbar-nav-row mx-4">
                                <li class="nav-item item-inline-flex px-2">
                                    <a class="nav-link" 
                                    href="?p=messages">MA</a>
                                </li>
                                <li class="nav-item item-inline-flex px-2">
                                    <a class="nav-link" 
                                    href="?p=messagesen">AN</a>
                                </li>
                                <li class="nav-item item-inline-flex px-2">
                                    <a class="nav-link" 
                                    href="?p=messagesde">NÉ</a>
                                </li>
                            </ul>
                    </div>
                </div>'
            );
            $cardDivBegin = '<div class="card my-3">';
            $cardHeaderDivBegin = '<div class="card-header">';
            $classTextPrimaryBegin = '<h3 class="text-primary">';
            $classTextPrimaryEnd = '</h3>';
            $cardBodyDivBegin = '<div class="card-body text-primary row">';
            $classColSmallOrder = '<div class="col-12 col-sm-12 col-md-12 col-lg-8 small-order-2">';
            $classMarginBottomTwo = '<div class="mb-2">';
            $paragraphClassTextPrimaryBegin = '<p class="text-justify">';
            $paragraphClassTextPrimaryEnd = '</p>';
            $classMarginBottomFour = '<div class="mb-4">';
            $classColSmallOrderIimgBoxAlign = '<div class="col-none col-sm-none col-md-none col-lg-4 small-order-1 img-box-align">';
            
                    
            $cardFooterDivBegin = '<div class="card-footer text-primary">';
            $divEnd = '</div>';
            for($i = 0; $i < count(Model::GetText("Recipes-and-messages")); $i++) {
                $template->AddData("MESSAGES", $cardDivBegin);
                $imageTitle = Model::GetText("Recipes-and-messages")[$i]["title"];
                $template->AddData("MESSAGES", $cardHeaderDivBegin . $classTextPrimaryBegin . $imageTitle . $classTextPrimaryEnd . $divEnd);
                $template->AddData("MESSAGES", $cardBodyDivBegin);
                $template->AddData("MESSAGES", $classColSmallOrder);
                $template->AddData("MESSAGES", $classMarginBottomTwo . $paragraphClassTextPrimaryBegin . Model::GetText("Recipes-and-messages")[$i]["Message"]["body"] . $paragraphClassTextPrimaryEnd . $divEnd);
                $messageUrl = Model::GetText("Recipes-and-messages")[$i]["Message"]["url"];
                $template->AddData("MESSAGES", $classMarginBottomFour . "<a href='$messageUrl' target='_blank'>" . $messageUrl .  '</a>' . $divEnd);
                $template->AddData("MESSAGES", $divEnd);
                $imagePath = Model::GetText("Recipes-and-messages")[$i]["Message"]["imagePath"];
                $template->AddData("MESSAGES", $classColSmallOrderIimgBoxAlign . "<img src='$imagePath' alt='$imageTitle' title='$imageTitle' class='img-thumbnail message-img' />"  . $divEnd);
                $template->AddData("MESSAGES", $divEnd);
                $template->AddData("MESSAGES", $cardFooterDivBegin. Model::GetText("Recipes-and-messages")[$i]["Message"]["userMessage"] . $divEnd);
                $template->AddData("MESSAGES", $divEnd);
            }
            $template->AddData("IMAGES", '<hr />');
        }
        catch (KeyNotFoundException $ex)
        {
            //Logger
            $template->AddData("MESSAGES", "Üzenetek feltöltése hamarosan...");
        }
    }
}

<?php


abstract class ImagesControllerDe implements IPageBase
{
    //put your code here
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        try
        {
            $template->AddData("NAVIGATION", 
                '<div class="container-fluid">
                    <a class="navbar-brand" href="?p=imagesde">Essen von uns</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="justify-content-end collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-4">
                            <li class="nav-item mx-1">
                                <a class="nav-link" aria-current="index" href="?p=imagesde">Essen von Rezepten</a>
                            </li>
                            <li class="nav-item mx-1">
                                <a class="nav-link" href="?p=messagesde">Mitteilungen</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav navbar-nav-row mx-4">
                                <li class="nav-item item-inline-flex px-2">
                                    <a class="nav-link" 
                                    href="?p=index">UN</a>
                                </li>
                                <li class="nav-item item-inline-flex px-2">
                                    <a class="nav-link" 
                                    href="?p=imagesen">EN</a>
                                </li>
                                <li class="nav-item item-inline-flex px-2">
                                    <a class="nav-link" 
                                    href="?p=imagesde">DE</a>
                                </li>
                            </ul>
                    </div>
                </div>'
            );
	    $classContainer = 'container';
	    $divContainer = '<div class='.$classContainer.'>';
  	    $classRow = 'row';
	    $divRow = '<div class='.$classRow.'>';
    	    $classCol = 'col-12';
	    $divCol = '<div class='.$classCol.'>';
            $classImgThumbnailRecipeDivBegin = '<div class="img-thumbnail recipe-div">';
            $classBackgroundWhite = 'bg-white';
	    $classTextCenter = 'text-center';
            $headingImagetitleBegin = '<h4 class=\'' . $classBackgroundWhite . ' ' . $classTextCenter . '\'>';
            $headingImagetitleEnd = '</h4>';
            $divEnd = '</div>';
            
	    $template->AddData("IMAGES", $divContainer . $divRow . $divCol);
            for($i = 0; $i < count(Model::GetText("Recipes-and-messages-de")); $i++) {
                $template->AddData("IMAGES", $classImgThumbnailRecipeDivBegin);
                $imagePath = Model::GetText("Recipes-and-messages-de")[$i]["Message"]["imagePath"];
                $template->AddData("IMAGES", "<a href='$imagePath' class='recipe-link'>");
                $imageTitle = Model::GetText("Recipes-and-messages-de")[$i]["title"];
                $template->AddData("IMAGES", "<img src='$imagePath' title='$imageTitle' alt='$imageTitle' class='recipe-img'>");
                $template->AddData("IMAGES", $headingImagetitleBegin . $imageTitle . $headingImagetitleEnd);
                $template->AddData("IMAGES", "</a>");
                $template->AddData("IMAGES", $divEnd);
            }
            $template->AddData("IMAGES", $divEnd);
        }
        catch (KeyNotFoundException $ex)
        {
            //Logger
            $template->AddData("MESSAGES", "Üzenetek feltöltése hamarosan...");
        }
    }
}

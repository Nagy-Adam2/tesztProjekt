<?php

abstract class IndexController implements IPageBase
{
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
                                    href="?p=index">MA</a>
                                </li>
                                <li class="nav-item item-inline-flex px-2">
                                    <a class="nav-link" 
                                    href="?p=imagesen">AN</a>
                                </li>
                                <li class="nav-item item-inline-flex px-2">
                                    <a class="nav-link" 
                                    href="?p=imagesde">NÉ</a>
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
            for($i = 0; $i < count(Model::GetText("Recipes-and-messages")); $i++) {
                $template->AddData("IMAGES", $classImgThumbnailRecipeDivBegin);
                $imagePath = Model::GetText("Recipes-and-messages")[$i]["Message"]["imagePath"];
                $template->AddData("IMAGES", "<a href='$imagePath' class='recipe-link'>");
                $imageTitle = Model::GetText("Recipes-and-messages")[$i]["title"];
                $template->AddData("IMAGES", "<img src='$imagePath' title='$imageTitle' alt='$imageTitle' class='recipe-img'>");
                $template->AddData("IMAGES", $headingImagetitleBegin . $imageTitle . $headingImagetitleEnd);
                $template->AddData("IMAGES", "</a>");
                $template->AddData("IMAGES", $divEnd);
            }
            $template->AddData("IMAGES",  $divEnd . $divEnd . $divEnd);
        }
        catch (KeyNotFoundException $ex)
        {
            //Logger
        }
    }
}

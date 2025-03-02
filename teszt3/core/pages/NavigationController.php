<?php


abstract class NavigationController implements IPageBase
{
    //put your code here
    #[\Override]
    public static function Run(?\Template $template = null): void
    {
        try
        {
            $template->AddData("NAVIGATION", 
                '<div class="container-fluid">
                    <a class="navbar-brand" href="?p=index  ">Ételeink</a>
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
                                    href="?p=imagesde">DE</a>
                                  </li>
                            </ul>
                    </div>
                </div>'
            );
        }
        catch (KeyNotFoundException $ex)
        {
            //Logger
            $template->AddData("NAVIGATION", "Navigáció hamarosan...");
        }
    }
}

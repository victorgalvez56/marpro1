<?php

namespace App\Http\ViewComposers\Tenant\Ecommerce;

use App\Models\Tenant\Catalogs\Tag;


class MenuViewComposer
{
    public function compose($view)
    {
        $view->items = Tag::all();
    }
}

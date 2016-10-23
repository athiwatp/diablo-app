<?php

namespace App\Http\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TitleComposer
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function compose(View $view)
    {
        $title = 'Diablo Rankings';
        
        return $view->with(compact('title'));
    }
}
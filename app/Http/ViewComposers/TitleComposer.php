<?php

namespace App\Rankings;

use Illuminate\Http\Request;

class TitleComposer
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $title = 'Diablo Rankings';
        
        return compact('title');
    }
}
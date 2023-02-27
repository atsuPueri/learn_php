<?php

namespace Controller;

use function Util\view;

class Search extends Controller
{
    public function search() 
    {
        view('search.html');
    }
}
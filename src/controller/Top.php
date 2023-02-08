<?php

namespace Controller;

use function Util\view;

class Top extends Controller
{
    public function show()
    {    
        view('index.html');
    }
}

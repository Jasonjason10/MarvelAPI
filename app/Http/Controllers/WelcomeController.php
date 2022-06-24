<?php

namespace app\Http\Controllers;

class WelcomeController
{
    /*
     * returns the homepage
     */
    public function show()
    {
        return view('welcome');
    }
}

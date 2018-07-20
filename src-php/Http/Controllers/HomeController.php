<?php

namespace Maxfactor\CMS\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Maxfactor\CMS\Pages\Models\Page;
use Maxfactor\CMS\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Web namespace
     *
     * @var string
     */
    protected $namespace = 'maxfactor::pages.';

    /**
     * Render the homepage blade view with meta data from a matching page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::meta('homepage', config('app.name'));

        return view($this->namespace.'homepage', compact('page'));
    }
}

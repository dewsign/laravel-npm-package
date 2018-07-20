<?php

namespace Maxfactor\CMS\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Maxfactor\CMS\Pages\Models\Page;
use Maxfactor\CMS\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Web namespace
     *
     * @var string
     */
    protected $namespace = 'maxfactor::pages.';

    /**
     * Show a page based on a full slug url path
     *
     * @param string  $path
     * @return \Illuminate\Http\Response
     */
    public function show(string $path = 'home')
    {
        $page = Page::withParent()
            ->withChildren()
            ->whereFullPath($path)
            ->first();

        if (!$page) {
            abort(404, __('Page not found'));
        }

        return view($this->namespace.'default', compact('page'));
    }
}

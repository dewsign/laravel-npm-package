<?php

namespace Maxfactor\CMS\Pages\Http\Admin\Controllers;

use Maxfactor\CMS\Pages\Models\Page;
use Maxfactor\CMS\Http\Controllers\Controller;
use Maxfactor\CMS\Pages\Http\Admin\Requests\PageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::highToLow()->get();

        return $pages;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = Page::create($request->validated());

        return response()->json([
            'message' => __('Successfully created'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, string $locale = null, Page $page)
    {
        $page->update($request->validated());

        return response()->json([
            'message' => __('Successfully updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $locale = null, Page $page)
    {
        $page->delete();

        return response()->json([
            'message' => __('Successfully deleted'),
        ]);
    }
}

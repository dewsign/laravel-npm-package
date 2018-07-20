@extends('maxfactor::layouts.default')

@section('browser_title', array_get($page, 'browser_title'))
@section('meta_description', array_get($page, 'meta_description'))

@section('content')
    <section>
        <div class="rte">
            @markdown($page->content)
        </div>
    </section>
@endsection

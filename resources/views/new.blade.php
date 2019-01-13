@extends('layout')

@section('content')
<div class="title m-b-md">
    Add new resource
</div>

<div class="links">
    <a href="{{ route('resource.list') }}">Return to list</a>
</div>

<div id="block-form">
    <form method="post" action="{{ route('resource.job') }}">
        <label>URL</label>
        <br />
        <input type="text" name="url" />
        <br />
        {{ $errors->first('url') }}
        <br />
        <button type="submit">Add resource</button>
    </form>
</div>
@endsection

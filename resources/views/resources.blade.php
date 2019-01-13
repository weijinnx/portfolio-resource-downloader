@extends('layout')

@section('content')
<div class="title m-b-md">
    List of resources
</div>

<div class="links">
    <a href="{{ route('resource.add') }}">Add resource</a>
</div>

<table style="width: 100%;" cellpadding="10">
    <thead>
        <tr>
            <td><b>ID</b></td>
            <td><b>URL</b></td>
            <td><b>Filename</b></td>
            <td><b>Status</b></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @forelse ($resources as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->url }}</td>
                <td>{{ $item->filename ?? 'Not downloaded yet.' }}</td>
                <td>{{ $item->getStatusAsText() }}</td>
                <td>
                    @if ($item->filename)
                        <a href="{{ route('resource.download', $item->id) }}" target="_blank">Download</a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">There are no resources yet.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection

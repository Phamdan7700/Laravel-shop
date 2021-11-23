@extends('admin.layout.layout')

@section('content')
<h1 class="mt-4">File manager</h1>

<div class="row">
    <iframe src="/laravel-filemanager?type=Images" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
</div>
@endsection

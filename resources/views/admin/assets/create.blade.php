@extends('layout.app')

@section('content')
    <div class="container">
        <div class="card-header">
            Create Asset
        </div>

        <div class="card-body">
            <form action="{{ route('admin.assets.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                @include('admin.assets._form')
            </form>
        </div>
    </div>
@endsection

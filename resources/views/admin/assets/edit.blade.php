@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            Edit Asset
        </div>

        <div class="card-body">
            <form action="{{ route('admin.assets.update', $asset) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                @include('admin.assets._form')
            </form>

        </div>
    </div>
@endsection

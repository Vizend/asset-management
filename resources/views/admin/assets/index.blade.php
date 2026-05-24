@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">

            <h3>Assets</h3>

            <a href="{{ route('admin.assets.create') }}" class="btn btn-primary">
                Add Asset
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="mb-3">

            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                placeholder="Search asset...">

        </form>

        <div class="card">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th width="200">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($assets as $asset)
                            <tr>

                                <td>
                                    @if ($asset->photo)
                                        <img src="{{ asset('storage/' . $asset->photo) }}"
                                            width="60">
                                    @endif
                                </td>

                                <td>
                                    {{ $asset->asset_code }}
                                </td>

                                <td>
                                    {{ $asset->name }}
                                </td>

                                <td>
                                    {{ $asset->category->name }}
                                </td>

                                <td>

                                    @php
                                        $badge = match ($asset->status) {
                                            'available' => 'success',
                                            'borrowed' => 'warning',
                                            'maintenance' => 'info',
                                            default => 'secondary',
                                        };
                                    @endphp

                                    <span class="badge bg-{{ $badge }}">
                                        {{ $asset->status }}
                                    </span>

                                </td>

                                <td>

                                    <a href="{{ route('admin.assets.show', $asset) }}"
                                        class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="{{ route('admin.assets.edit', $asset) }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.assets.destroy', $asset) }}"
                                        method="POST" class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Delete asset?')" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6">
                                    No data
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-3">
            {{ $assets->links() }}
        </div>

    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3>Asset Detail</h3>

            <div>

                <a href="{{ route('admin.assets.edit', $asset) }}"
                    class="btn btn-warning">

                    Edit
                </a>

                <a href="{{ route('admin.assets.index') }}" class="btn btn-secondary">

                    Back
                </a>

            </div>

        </div>

        @php
            $badge = match ($asset->status) {
                'available' => 'success',

                'borrowed' => 'warning',

                'maintenance' => 'info',

                'retired' => 'secondary',

                default => 'dark',
            };
        @endphp

        <div class="row">

            {{-- LEFT --}}

            <div class="col-md-4">

                <div class="card mb-3">

                    <div class="card-header">
                        Asset Photo
                    </div>

                    <div class="card-body text-center">

                        @if ($asset->photo)
                            <img src="{{ asset('storage/' . $asset->photo) }}"
                                class="img-fluid rounded">
                        @else
                            <img src="https://via.placeholder.com/300x250?text=No+Image" class="img-fluid rounded">
                        @endif

                    </div>

                </div>

                {{-- QR CARD --}}

                <div class="card">

                    <div class="card-header">
                        QR Code
                    </div>

                    <div class="card-body text-center">

                        @if ($asset->qr_code)
                            <img src="{{ asset('storage/' . $asset->qr_code) }}"
                                class="img-fluid mb-3" width="220">

                            <br>

                            <a href="{{ asset('storage/' . $asset->qr_code) }}"
                                download class="btn btn-success">

                                Download QR
                            </a>
                        @else
                            <p class="text-muted">
                                QR belum tersedia
                            </p>
                        @endif

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        Asset Information
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <tr>
                                <th width="220">
                                    Asset Code
                                </th>
                                <td>
                                    {{ $asset->asset_code }}
                                </td>
                            </tr>

                            <tr>
                                <th>Name</th>
                                <td>
                                    {{ $asset->name }}
                                </td>
                            </tr>

                            <tr>
                                <th>Category</th>
                                <td>
                                    {{ $asset->category->name }}
                                </td>
                            </tr>

                            <tr>
                                <th>Brand</th>
                                <td>
                                    {{ $asset->brand ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Model</th>
                                <td>
                                    {{ $asset->model ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Serial Number</th>
                                <td>
                                    {{ $asset->serial_no ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Purchase Date</th>
                                <td>

                                    {{ optional($asset->purchase_date)->format('d M Y') ?? '-' }}

                                </td>
                            </tr>

                            <tr>
                                <th>Purchase Price</th>
                                <td>

                                    @if ($asset->purchase_price)
                                        Rp
                                        {{ number_format($asset->purchase_price, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif

                                </td>
                            </tr>

                            <tr>
                                <th>Condition</th>
                                <td>

                                    {{ str($asset->condition)->replace('_', ' ')->title() }}

                                </td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>

                                    <span class="badge bg-{{ $badge }}">

                                        {{ ucfirst($asset->status) }}

                                    </span>

                                </td>
                            </tr>

                            <tr>
                                <th>Location</th>
                                <td>
                                    {{ $asset->location ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Notes</th>
                                <td>
                                    {{ $asset->notes ?? '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Created At</th>
                                <td>

                                    {{ $asset->created_at->format('d M Y H:i') }}

                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

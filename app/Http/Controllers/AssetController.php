<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $search = request('search');

        $assets = Asset::with('category')
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('asset_code', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
        return view(
            'admin.assets.index',
            compact('assets')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view(
            'admin.assets.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssetRequest $request)
    {
        //
        $data = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | Upload Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {
            $data['photo'] = $request
                ->file('photo')
                ->store('assets', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Create Asset
        |--------------------------------------------------------------------------
        */

        $asset = Asset::create($data);

        /*
        |--------------------------------------------------------------------------
        | Generate QR
        |--------------------------------------------------------------------------
        */

        $qrPath = 'qrcodes/' .
            $asset->asset_code .
            '.png';

        Storage::disk('public')->put(
            $qrPath,
            QrCode::format('png')
                ->size(300)
                ->generate(
                    route(
                        'admin.assets.show',
                        $asset->id
                    )
                )
        );

        $asset->update([
            'qr_code' => $qrPath
        ]);

        return redirect()
            ->route('admin.assets.index')
            ->with(
                'success',
                'Asset berhasil dibuat.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
        $asset->load('category');

        return view(
            'admin.assets.show',
            compact('asset')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
        $categories = Category::all();

        return view(
            'admin.assets.edit',
            compact(
                'asset',
                'categories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateAssetRequest $request,
        Asset $asset
    ) {
        //
        $data = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if (
                $asset->photo &&
                Storage::disk('public')
                    ->exists($asset->photo)
            ) {
                Storage::disk('public')
                    ->delete($asset->photo);
            }

            // Upload foto baru
            $data['photo'] = $request
                ->file('photo')
                ->store('assets', 'public');
        }

        $asset->update($data);

        return redirect()
            ->route('admin.assets.index')
            ->with(
                'success',
                'Asset berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
        /*
        |--------------------------------------------------------------------------
        | Delete Files
        |--------------------------------------------------------------------------
        */

        if (
            $asset->photo &&
            Storage::disk('public')
                ->exists($asset->photo)
        ) {
            Storage::disk('public')
                ->delete($asset->photo);
        }

        if (
            $asset->qr_code &&
            Storage::disk('public')
                ->exists($asset->qr_code)
        ) {
            Storage::disk('public')
                ->delete($asset->qr_code);
        }

        $asset->delete();

        return redirect()
            ->route('admin.assets.index')
            ->with(
                'success',
                'Asset berhasil dihapus.'
            );
    }
}

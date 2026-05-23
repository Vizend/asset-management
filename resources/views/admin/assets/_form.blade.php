<div class="row">

    <div class="col-md-6 mb-3">
        <label class="form-label">Category</label>

        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">

            <option value="">Choose Category</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $asset->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Asset Code</label>

        <input type="text" name="asset_code" class="form-control @error('asset_code') is invalid @enderror"
            value="{{ old('asset_code', $asset->asset_code ?? '') }}">

        @error('asset_code')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Asset Name</label>

        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $asset->name ?? '') }}">

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Brand</label>

        <input type="text" name="brand" class="form-control" value="{{ old('brand', $asset->brand ?? '') }}">

    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Model</label>

        <input type="text" name="model" class="form-control" value="{{ old('model', $asset->model ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Serial Number</label>

        <input type="text" name="serial_no" class="form-control"
            value="{{ old('serial_no', $asset->serial_no ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Purchase Date</label>

        <input type="date" name="purchase_date" class="form-control"
            value="{{ old('purchase_date', isset($asset) ? optional($asset->purchase_date)->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Purchase Price</label>

        <input type="number" name="purchase_price" class="form-control"
            value="{{ old('purchase_price', $asset->purchase_price ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Condition</label>

        <select name="condition" class="form-select">

            <option value="good">
                Good
            </option>

            <option value="minor_damage">
                Minor Damage
            </option>

            <option value="broken">
                Broken
            </option>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>

        <select name="status" class="form-select">
            <option value="available">
                Available
            </option>

            <option value="borrowed">
                Borrowed
            </option>

            <option value="maintenance">
                Maintenance
            </option>

            <option value="retired">
                Retired
            </option>
        </select>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Location</label>

        <input type="text" name="location" class="form-control"
            value="{{ old('location', $asset->location ?? '') }}">
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Notes</label>

        <textarea name="notes" rows="4" class="form-control">
            {{ old('notes', $asset->notes ?? '') }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Photo</label>

        <input type="file" name="photo" id="photo" class="form-control">

        <img id="preview" class="img-thumbnail mt-2" style="max-height:200px">

        @isset($asset)
            @if ($asset->photo)
                <img src="{{ asset('storage/' . $asset->photo) }}" class="img-thumbnail mt-2" width="150">
            @endif
        @endisset
    </div>

</div>

<button class="btn btn-primary">
    Save
</button>

<a href="{{ route('admin.assets.index') }}" class="btn btn-secondary">
    Cancel
</a>

<script>
    document
        .getElementById('photo')
        ?.addEventListener('change', function(e) {

            let reader = new FileReader();

            reader.onload = function() {
                document.getElementById('preview')
                    .src = reader.result;
            }

            reader.readAsDataURL(e.target.files[0]);
        });
</script>

@extends('layouts.app')
<title>Create Listing</title>
@section('content')
<div class="max-w-2xl mx-auto py-12">
    <h1 class="text-3xl font-bold mb-8 text-center">Create a Listing</h1>
    <form method="POST" action="{{ route('listing.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-8 space-y-8">
        @csrf
        <!-- Brand Selection -->
        <div>
            <h2 class="text-lg font-semibold mb-4">Choose Brand</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach($brands as $brand)
                    <button type="button"
                        class="group w-full border-2 rounded-lg p-4 flex flex-col items-center transition {{ old('brand_id') == $brand->id ? 'border-lime-500 bg-lime-50' : 'border-gray-200 bg-gray-50' }}"
                        onclick="selectBrand('{{ $brand->id }}')"
                        id="brand-btn-{{ $brand->id }}">
                        <span class="text-xl font-bold text-gray-900">{{ $brand->name }}</span>
                    </button>
                @endforeach
            </div>
            <input type="hidden" name="brand_id" id="brand_id" value="{{ old('brand_id') }}">
        </div>
        <!-- Category Selection -->
        <div>
            <h2 class="text-lg font-semibold mb-4">Choose Category</h2>
            <div class="grid grid-cols-3 gap-4">
                @foreach($categories as $category)
                    <button type="button"
                        class="group w-full border-2 rounded-lg p-4 flex flex-col items-center transition {{ old('category_id') == $category->id ? 'border-lime-500 bg-lime-50' : 'border-gray-200 bg-gray-50' }}"
                        onclick="selectCategory('{{ $category->id }}')"
                        id="category-btn-{{ $category->id }}">
                        <span class="text-base font-semibold text-gray-900">{{ $category->name }}</span>
                    </button>
                @endforeach
            </div>
            <input type="hidden" name="category_id" id="category_id" value="{{ old('category_id') }}">
        </div>
        <!-- Model Selection -->
        <div>
            <label class="block text-base font-medium mb-2" for="model">Model</label>
            <select name="model" id="model" class="w-full border rounded px-3 py-2" required>
                <option value="" disabled selected>Select a model</option>
                <!-- Options will be populated by JavaScript when brand/category is selected -->
            </select>
            <p class="text-sm text-gray-500 mt-1">Only existing models in our database are available for selection.</p>
        </div>
        <!-- Dynamic Attributes -->
        <div id="attributes-section">
            <!-- JS will inject attribute fields here based on selected category -->
        </div>
        <!-- Product Image Upload -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-base font-medium" for="product_image">Product Image (optional)</label>
                <button type="button" onclick="openHelpModal()" class="text-sm text-gray-500 hover:text-gray-700 underline">Help</button>
            </div>
            <input type="file" name="product_image" id="product_image" accept="image/*" class="w-full border rounded px-3 py-2">
            <p class="text-sm text-gray-500 mt-1">Upload an image for this product if it doesn't exist yet. JPG, PNG, GIF up to 2MB.</p>
        </div>
        <!-- Price, Condition, Comment -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-base font-medium mb-2" for="price">Price</label>
                <input type="number" name="price" id="price" class="w-full border rounded px-3 py-2" value="{{ old('price') }}" required>
            </div>
            <div>
                <label class="block text-base font-medium mb-2" for="condition">Condition</label>
                <select name="condition" id="condition" class="w-full border rounded px-3 py-2">
                    <option value="new">New</option>
                    <option value="used">Used</option>
                    <option value="refurbished">Refurbished</option>
                </select>
            </div>
            <div>
                <label class="block text-base font-medium mb-2" for="comment">Comment</label>
                <input type="text" name="comment" id="comment" class="w-full border rounded px-3 py-2" value="{{ old('comment') }}">
            </div>
        </div>
        <button type="submit" class="w-full mt-8 bg-lime-500 hover:bg-lime-400 text-white font-bold py-3 rounded-lg text-lg transition">Create Listing</button>
    </form>
</div>

<!-- Help Modal -->
<div id="help-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
        <button onclick="closeHelpModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
        <h2 class="text-xl font-bold mb-4">How to Add Product Images</h2>
        <p class="text-gray-700 mb-4">
            Please upload a clear image of your product. If an official image already exists in the catalog, no need to upload.
        </p>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Images should be in JPG, PNG, or GIF format.</li>
            <li>Maximum file size: 2MB.</li>
            <li>Recommended: Use high-quality images without watermarks.</li>
            <li>If you don't have a product image, you can use manufacturer photos from official websites.</li>
        </ul>
        <div class="mt-6 text-right">
            <button onclick="closeHelpModal()" class="bg-lime-500 hover:bg-lime-400 text-white px-4 py-2 rounded-lg">Got it</button>
        </div>
    </div>
</div>

<script>
function selectBrand(id) {
    document.getElementById('brand_id').value = id;
    document.querySelectorAll('[id^=brand-btn-]').forEach(btn => btn.classList.remove('border-lime-500', 'bg-lime-50'));
    document.getElementById('brand-btn-' + id).classList.add('border-lime-500', 'bg-lime-50');
    updateModelOptions();
}

function selectCategory(id) {
    document.getElementById('category_id').value = id;
    document.querySelectorAll('[id^=category-btn-]').forEach(btn => btn.classList.remove('border-lime-500', 'bg-lime-50'));
    document.getElementById('category-btn-' + id).classList.add('border-lime-500', 'bg-lime-50');
    fetchAttributesForCategory(id);
    updateModelOptions();
}

function fetchAttributesForCategory(categoryId) {
    fetch(`/api/category/${categoryId}/attributes`)
        .then(res => res.json())
        .then(attrs => {
            let html = '';
            attrs.forEach(attr => {
                html += `<div class='mb-4'>
                    <label class='block text-base font-medium mb-2'>${attr.name}</label>`;
                if (attr.allowed_values && attr.allowed_values.length > 0) {
                    html += `<select name='attributes[${attr.id}]' class='w-full border rounded px-3 py-2' required>`;
                    html += `<option value='' disabled selected>Select ${attr.name}</option>`;
                    attr.allowed_values.forEach(val => {
                        html += `<option value='${val}'>${val}</option>`;
                    });
                    html += `</select>`;
                } else {
                    html += `<input type='${attr.input_type === 'number' ? 'number' : 'text'}' name='attributes[${attr.id}]' class='w-full border rounded px-3 py-2' required>`;
                }
                html += `</div>`;
            });
            document.getElementById('attributes-section').innerHTML = html;
        });
}

function updateModelOptions() {
    const brandId = document.getElementById('brand_id').value;
    const categoryId = document.getElementById('category_id').value;
    const modelSelect = document.getElementById('model');
    
    // Reset model dropdown
    modelSelect.innerHTML = '<option value="" disabled selected>Select a model</option>';
    
    if (!brandId || !categoryId) {
        return;
    }
    
    // Fetch models for the selected brand and category
    const params = new URLSearchParams({
        brand_id: brandId,
        category_id: categoryId
    });
    
    fetch(`/api/model-suggestions?${params}`)
        .then(res => res.json())
        .then(models => {
            if (models.length === 0) {
                const noModelsOption = document.createElement('option');
                noModelsOption.value = '';
                noModelsOption.textContent = 'No models available for this brand/category';
                noModelsOption.disabled = true;
                modelSelect.appendChild(noModelsOption);
            } else {
                models.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model;
                    option.textContent = model;
                    modelSelect.appendChild(option);
                });
            }
        });
}

// Remove custom model handling - users can only select existing models
document.addEventListener('DOMContentLoaded', function() {
    // No custom functionality needed
});

function openHelpModal() {
    document.getElementById('help-modal').classList.remove('hidden');
    document.getElementById('help-modal').classList.add('flex');
}

function closeHelpModal() {
    document.getElementById('help-modal').classList.remove('flex');
    document.getElementById('help-modal').classList.add('hidden');
}
</script>
@endsection

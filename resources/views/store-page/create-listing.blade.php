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
        <!-- Model Input -->
        <div class="relative">
            <label class="block text-base font-medium mb-2" for="model">Model</label>
            <input type="text" name="model" id="model" class="w-full border rounded px-3 py-2" value="{{ old('model') }}" autocomplete="off" required>
            <div id="suggestions" class="absolute z-10 w-full bg-white border border-gray-300 rounded-b-md shadow-lg hidden max-h-40 overflow-y-auto"></div>
        </div>
        <!-- Dynamic Attributes -->
        <div id="attributes-section">
            <!-- JS will inject attribute fields here based on selected category -->
        </div>
        <!-- Product Image Upload -->
        <div>
            <label class="block text-base font-medium mb-2" for="product_image">Product Image (optional)</label>
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
<script>
let suggestionsTimeout;

function selectBrand(id) {
    document.getElementById('brand_id').value = id;
    document.querySelectorAll('[id^=brand-btn-]').forEach(btn => btn.classList.remove('border-lime-500', 'bg-lime-50'));
    document.getElementById('brand-btn-' + id).classList.add('border-lime-500', 'bg-lime-50');
}

function selectCategory(id) {
    document.getElementById('category_id').value = id;
    document.querySelectorAll('[id^=category-btn-]').forEach(btn => btn.classList.remove('border-lime-500', 'bg-lime-50'));
    document.getElementById('category-btn-' + id).classList.add('border-lime-500', 'bg-lime-50');
    fetchAttributesForCategory(id);
}

function fetchAttributesForCategory(categoryId) {
    fetch(`/api/category/${categoryId}/attributes`)
        .then(res => res.json())
        .then(attrs => {
            let html = '';
            attrs.forEach(attr => {
                html += `<div class='mb-4'>
                    <label class='block text-base font-medium mb-2'>${attr.name}</label>
                    <input type='${attr.input_type === 'number' ? 'number' : 'text'}' name='attributes[${attr.id}]' class='w-full border rounded px-3 py-2' required>
                </div>`;
            });
            document.getElementById('attributes-section').innerHTML = html;
        });
}

function setupModelAutocomplete() {
    const modelInput = document.getElementById('model');
    const suggestionsDiv = document.getElementById('suggestions');
    
    modelInput.addEventListener('input', function() {
        clearTimeout(suggestionsTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            suggestionsDiv.classList.add('hidden');
            return;
        }
        
        suggestionsTimeout = setTimeout(() => {
            const brandId = document.getElementById('brand_id').value;
            const categoryId = document.getElementById('category_id').value;
            
            const params = new URLSearchParams({
                q: query,
                ...(brandId && { brand_id: brandId }),
                ...(categoryId && { category_id: categoryId })
            });
            
            fetch(`/api/model-suggestions?${params}`)
                .then(res => res.json())
                .then(suggestions => {
                    if (suggestions.length > 0) {
                        let html = '';
                        suggestions.forEach(suggestion => {
                            html += `<div class="px-3 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-100 last:border-b-0" onclick="selectSuggestion('${suggestion}')">${suggestion}</div>`;
                        });
                        suggestionsDiv.innerHTML = html;
                        suggestionsDiv.classList.remove('hidden');
                    } else {
                        suggestionsDiv.classList.add('hidden');
                    }
                });
        }, 300);
    });
    
    modelInput.addEventListener('blur', function() {
        setTimeout(() => suggestionsDiv.classList.add('hidden'), 200);
    });
    
    modelInput.addEventListener('focus', function() {
        if (this.value.length >= 2) {
            this.dispatchEvent(new Event('input'));
        }
    });
}

function selectSuggestion(value) {
    document.getElementById('model').value = value;
    document.getElementById('suggestions').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    setupModelAutocomplete();
});
</script>
@endsection

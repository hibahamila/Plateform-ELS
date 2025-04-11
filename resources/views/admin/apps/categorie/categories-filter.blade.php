<div class="categories-filter">
    <div class="categories-wrapper">
        <button class="nav-button prev-button" style="display: none;">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="categories-slider">
            @foreach($categories as $category)
            <div class="category-item {{ request()->get('categorie_id') == $category->id || (request()->get('categorie_id') === null && $loop->first) ? 'active' : '' }}">
                <a href="{{ route('formations', ['categorie_id' => $category->id]) }}" 
                   class="category-link" 
                   data-category-id="{{ $category->id }}">
                    <span class="category-title">{{ $category->title }}</span>
                    <span class="participant-count">+ {{ $category->formations_count ?? 0 }} de participants</span>
                </a>
            </div>
            @endforeach
        </div>
        <button class="nav-button next-button">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>


<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/categories-filter.css') }}">
<script src="{{ asset('assets/js/MonJs/categorie/categorie-filter.js') }}"></script>


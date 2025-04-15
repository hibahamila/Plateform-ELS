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
                    <span class="participant-count">+ {{ $category->formations_count ?? 0 }} formations</span>
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











            {{-- <div class="categories-slider">
                @foreach($categories as $category)
                    <div class="category-item {{ request()->get('categorie_id') == $category->id || (request()->get('categorie_id') === null && $loop->first) ? 'active' : '' }}">
                        <a href="{{ route('formations', ['categorie_id' => $category->id]) }}"
                            class="category-link"
                            data-category-id="{{ $category->id }}">
                            <span class="category-title">{{ $category->title }}</span>
                            <span class="participant-count">+ {{ $category->formations_count ?? 0 }} de participants</span>
                            
                            <!-- Bouton dropdown à l'intérieur de la catégorie -->
                            <span class="dropdown-wrapper">
                                <button class="dropdown-toggle">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('categorieedit', $category->id) }}" class="dropdown-item">
                                        <i class="fas fa-edit"></i> Éditer
                                    </a>
                                    <a href="#" class="dropdown-item delete-item" data-id="{{ $category->id }}" data-route="{{ route('categoriedestroy', $category->id) }}">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </a>
                                </div>
                            </span>
                        </a>
                    </div>
                @endforeach --}}
            {{-- </div>
        <button class="nav-button next-button">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div> --}}

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/categories-filter.css') }}"> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/MonCss/categories-dropdown.css') }}"> --}}
{{-- <script src="{{ asset('assets/js/MonJs/categorie/categorie-filter.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/MonJs/categorie/categorie-dropdown.js') }}"></script> --}}
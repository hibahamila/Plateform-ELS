<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper"><a href="{{ route('index') }}"><img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt=""></a></div>
      <div class="dark-logo-wrapper"><a href="{{ route('index') }}"><img class="img-fluid" src="{{asset('assets/images/logo/dark-logo.png')}}" alt=""></a></div>
      <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">    </i></div>
    </div>

     
    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
       
        <li>
            <div class="mode"><i class="fa fa-moon-o"></i></div>
        </li>
        <li>
        {{-- <a href="{{ route('panier.index') }}" class="cart-link">
          <div class="cart-container">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="cart-icon">
                  <circle cx="9" cy="21" r="1"></circle>
                  <circle cx="20" cy="21" r="1"></circle>
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
            
          </div>
      </a> --}}
      <a href="{{ route('panier.index') }}" class="cart-link">
        <div class="cart-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="cart-icon">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <!-- Le badge sera inséré ici par JavaScript ou montré/caché selon le besoin -->
        </div>
    </a>
        </li>
        
        <li class="onhover-dropdown p-0">
          <a class="btn btn-primary-light" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div>


@push('styles')
{{-- <style>
  .cart-icon-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
  }
  .cart-count {
  position: absolute;
  top: -10px; /* Monter davantage le badge */
  left: 50%; /* Centrer horizontalement */
  transform: translateX(-50%); /* Assurer un centrage parfait */
  font-size: 0.75rem;
  padding: 0.25rem 0.5rem;
  border-radius: 50%;
  background-color: #7366ff;
  color: white;
}
</style> --}}

{{-- <style>
  .cart-container {
    position: relative;
    display: inline-block;
}

.cart-badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: #ff0000; /* Rouge */
    color: white;
    border-radius: 50%; /* Rond */
    min-width: 18px;
    height: 18px;
    padding: 0 5px;
    font-size: 12px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.cart-badge:empty {
    display: none;
}

.cart-badge-visible {
    display: flex !important;
    opacity: 1 !important;
    visibility: visible !important;
}
</style> --}}
@endpush


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico" type="image/x-icon') }}">
        <link rel="preconnect" href="https://fonts.gstatic.com/">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link
          href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
          rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Allura&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
        @stack("styles")
</head>
<body class="gradient-bg">

    <style>
      #header {
        padding-top: 8px;
        padding-bottom: 8px;
      }
  
      .logo__image {
        max-width: 220px;
      }
    </style>
    <div class="header-mobile header_sticky">
      <div class="container d-flex align-items-center h-100">
        <a class="mobile-nav-activator d-block position-relative" href="#">
          <svg class="nav-icon" width="25" height="18" viewBox="0 0 25 18" xmlns="http://www.w3.org/2000/svg">
            <use href="#icon_nav" />
          </svg>
          <button class="btn-close-lg position-absolute top-0 start-0 w-100"></button>
        </a>
  
        <div class="logo">
          <a href="{{route('home.index')}}">
            <img src="{{ asset('assets/images/logo.webp') }}"  alt="logo" class="logo__image d-block"  height="100"/>
          </a>
        </div>
  
        <a href="#" class="header-tools__item header-tools__cart js-open-aside" data-aside="cartDrawer">
          <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <use href="#icon_cart" />
          </svg>
          <span class="cart-amount d-block position-absolute js-cart-items-count">3</span>
        </a>
      </div>
  
      <nav
        class="header-mobile__navigation navigation d-flex flex-column w-100 position-absolute top-100 bg-body overflow-auto">
        <div class="container">
          <form action="#" method="GET" class="search-field position-relative mt-4 mb-3">
            <div class="position-relative">
              <input class="search-field__input w-100 border rounded-1" type="text" name="search-keyword"
                placeholder="Search products" />
              <button class="btn-icon search-popup__submit pb-0 me-2" type="submit">
                <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_search" />
                </svg>
              </button>
              <button class="btn-icon btn-close-lg search-popup__reset pb-0 me-2" type="reset"></button>
            </div>
  
            <div class="position-absolute start-0 top-100 m-0 w-100">
              <div class="search-result"></div>
            </div>
          </form>
        </div>
  
        <div class="container">
          <div class="overflow-hidden">
            <ul class="navigation__list list-unstyled position-relative">
              <li class="navigation__item">
                <a href="{{route('home.index')}}" class="navigation__link">Home</a>
              </li>
              <li class="navigation__item">
                <a href="{{route('shop.index')}}" class="navigation__link">Shop</a>
              </li>
              <li class="navigation__item">
                <a href="{{route('cart.index')}}" class="navigation__link">Cart</a>
              </li>

              <li class="navigation__item">
                <a href="{{route('shop.contactus')}}" class="navigation__link">Contact</a>
              </li>
            </ul>
          </div>
        </div>
  
        <div class="border-top mt-auto pb-2">
          <div class="customer-links container mt-4 mb-2 pb-1">
            <svg class="d-inline-block align-middle" width="20" height="20" viewBox="0 0 20 20" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_user" />
            </svg>
            <span class="d-inline-block ms-2 text-uppercase align-middle fw-medium">My Account</span>
          </div>
  
  
  
          <ul class="container social-links list-unstyled d-flex flex-wrap mb-0">
            <li>
              <a href="#" class="footer__social-link d-block ps-0">
                <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_facebook" />
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="footer__social-link d-block">
                <svg class="svg-icon svg-icon_twitter" width="14" height="13" viewBox="0 0 14 13"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_twitter" />
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="footer__social-link d-block">
                <svg class="svg-icon svg-icon_instagram" width="14" height="13" viewBox="0 0 14 13"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_instagram" />
                </svg>
              </a>
            </li>
            <li>
           
            </li>
            <li>
              <a href="#" class="footer__social-link d-block">
                <svg class="svg-icon svg-icon_pinterest" width="14" height="15" viewBox="0 0 14 15"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_pinterest" />
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  
  
    <header id="header" class="header header-fullwidth header-transparent-bg">
      <div class="container">
        <div class="header-desk header-desk_type_1">
          <div class="logo">
            <a href="{{route('home.index')}}">
              <img src="{{asset('assets/images/logo.webp')}}" alt="logo" class="logo__image d-block"  height="100" />
            </a>
          </div>
  
          <nav class="navigation">
            <ul class="navigation__list list-unstyled d-flex">
              <li class="navigation__item">
                <a href="{{route('home.index')}}"" class="navigation__link">Home</a>
              </li>
              <li class="navigation__item">
                <a href="{{route('shop.index')}}" class="navigation__link">Shop</a>
              </li>
              <li class="navigation__item">
                <a href="{{route('cart.index')}}" class="navigation__link">Cart</a>
              </li>

              <li class="navigation__item">
                <a href="{{route('shop.contactus')}}" class="navigation__link">Contact</a>
              </li>
            </ul>
          </nav>
  
          <div class="header-tools d-flex align-items-center">
            <div class="header-tools__item hover-container">
              <div class="js-hover__open position-relative">
                <a class="js-search-popup search-field__actor" href="#">
                  <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_search" />
                  </svg>
                  <i class="btn-icon btn-close-lg"></i>
                </a>
              </div>
  
              <div class="search-popup js-hidden-content">
                <form action="#" method="GET" class="search-field container">
                  <p class="text-uppercase text-secondary fw-medium mb-4">What are you looking for?</p>
                  <div class="position-relative">
                    <input class="search-field__input search-popup__input w-100 fw-medium" type="text"
                      name="search-keyword" placeholder="Search products" />
                    <button class="btn-icon search-popup__submit" type="submit">
                      <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_search" />
                      </svg>
                    </button>
                    <button class="btn-icon btn-close-lg search-popup__reset" type="reset"></button>
                  </div>
  
                  <div class="search-popup__results">
                    <div class="sub-menu search-suggestion">
                      <h6 class="sub-menu__title fs-base">Quicklinks</h6>
                      <ul class="sub-menu__list list-unstyled">
                        <li class="sub-menu__item"><a href="shop2.html" class="menu-link menu-link_us-s">New Arrivals</a>
                        </li>
                        <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Dresses</a></li>
                        <li class="sub-menu__item"><a href="shop3.html" class="menu-link menu-link_us-s">Accessories</a>
                        </li>
                        <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Footwear</a></li>
                        <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Sweatshirt</a></li>
                      </ul>
                    </div>
  
                    <div class="search-result row row-cols-5"></div>
                  </div>
                </form>
              </div>
            </div>
            
            @guest   
            <div class="header-tools__item hover-container">
              <a href="{{route('login')}}" class="header-tools__item">
                <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_user" />
                </svg>
              </a>
            </div>
            @else
            <div class="header-tools__item hover-container">
              <a href="{{ Auth::user()->utype ==='ADM' ? route('admin.index'): route(name: 'user.index')}}" class="header-tools__item">
                <span class="pr-6px">{{Auth::user()->name}} </span>
                <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_user" />
                </svg>
              </a>
            </div>
            @endguest
  
            <a href="{{route('wishlist.index')}}" class="header-tools__item header-tools__cart ">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_heart" />
              </svg>
              @if(Cart::instance('wishlist')->content()->count()> 0)
              <span class="cart-amount d-block position-absolute js-wishlist-items-count">{{Cart::instance('wishlist')->content()->count()}}</span>
              @endif
            </a>
  
            <a href="{{route('cart.index')}}" class="header-tools__item header-tools__cart">
              <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_cart" />
              </svg>
              @if(Cart::instance('cart')->content()->count()> 0)
              <span class="cart-amount d-block position-absolute js-cart-items-count">{{Cart::instance('cart')->content()->count()}}</span>
              @endif
            </a>
          </div>
        </div>
      </div>
    </header>

  @yield("content")


  
    <hr class="mt-5 text-secondary" />
    <footer class="footer footer_type_2">
      <div class="footer-middle container">
        <div class="row row-cols-lg-5 row-cols-2">
          <div class="footer-column footer-store-info col-12 mb-4 mb-lg-0">
            <div class="logo">
              <a href="{{route('home.index')}}">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="" class="logo__image d-block" height="100"/>
              </a>
            </div>
            <p class="footer-address">Selangor, Japan</p>
            <p class="m-0"><strong class="fw-medium">contact@HAHAHA.com</strong></p>
            <p><strong class="fw-medium"></strong></p>

            <svg class="d-none">
              
              <symbol id="icon_user" viewBox="0 0 20 20">
                <g clip-path="url(#clip0_6_29)">
                  <path
                    d="M10 11.2652C3.99077 11.2652 0.681274 14.108 0.681274 19.2701C0.681274 19.6732 1.00803 20 1.4112 20H18.5888C18.992 20 19.3187 19.6732 19.3187 19.2701C19.3188 14.1083 16.0093 11.2652 10 11.2652ZM2.16768 18.5402C2.45479 14.6805 5.08616 12.7251 10 12.7251C14.9139 12.7251 17.5453 14.6805 17.8326 18.5402H2.16768Z"
                    fill="currentColor" />
                  <path
                    d="M10 0C7.23969 0 5.1582 2.12336 5.1582 4.93895C5.1582 7.83699 7.33023 10.1944 10 10.1944C12.6698 10.1944 14.8419 7.83699 14.8419 4.93918C14.8419 2.12336 12.7604 0 10 0ZM10 8.7348C8.13508 8.7348 6.61805 7.03211 6.61805 4.93918C6.61805 2.92313 8.04043 1.45984 10 1.45984C11.9283 1.45984 13.382 2.95547 13.382 4.93918C13.382 7.03211 11.865 8.7348 10 8.7348Z"
                    fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_6_29">
                    <rect width="20" height="20" fill="white" />
                  </clipPath>
                </defs>
              </symbol>
              <symbol id="icon_cart" viewBox="0 0 20 20">
                <path
                  d="M17.6562 4.6875H15.2755C14.9652 2.05164 12.7179 0 10 0C7.28215 0 5.0348 2.05164 4.72445 4.6875H2.34375C1.91227 4.6875 1.5625 5.03727 1.5625 5.46875V19.2188C1.5625 19.6502 1.91227 20 2.34375 20H17.6562C18.0877 20 18.4375 19.6502 18.4375 19.2188V5.46875C18.4375 5.03727 18.0877 4.6875 17.6562 4.6875ZM10 1.5625C11.8548 1.5625 13.3992 2.91621 13.6976 4.6875H6.30238C6.60082 2.91621 8.14516 1.5625 10 1.5625ZM16.875 18.4375H3.125V6.25H4.6875V8.59375C4.6875 9.02523 5.03727 9.375 5.46875 9.375C5.90023 9.375 6.25 9.02523 6.25 8.59375V6.25H13.75V8.59375C13.75 9.02523 14.0998 9.375 14.5312 9.375C14.9627 9.375 15.3125 9.02523 15.3125 8.59375V6.25H16.875V18.4375Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_heart" viewBox="0 0 20 20">
                <g clip-path="url(#clip0_6_54)">
                  <path
                    d="M18.3932 3.30806C16.218 1.13348 12.6795 1.13348 10.5049 3.30806L9.99983 3.81285L9.49504 3.30806C7.32046 1.13319 3.78163 1.13319 1.60706 3.30806C-0.523361 5.43848 -0.537195 8.81542 1.57498 11.1634C3.50142 13.3041 9.18304 17.929 9.4241 18.1248C9.58775 18.2578 9.78467 18.3226 9.9804 18.3226C9.98688 18.3226 9.99335 18.3226 9.99953 18.3223C10.202 18.3317 10.406 18.2622 10.575 18.1248C10.816 17.929 16.4982 13.3041 18.4253 11.1631C20.5371 8.81542 20.5233 5.43848 18.3932 3.30806ZM17.1125 9.98188C15.6105 11.6505 11.4818 15.0919 9.99953 16.3131C8.51724 15.0922 4.38944 11.6511 2.88773 9.98218C1.41427 8.34448 1.40044 6.01214 2.85564 4.55693C3.59885 3.81402 4.57488 3.44227 5.5509 3.44227C6.52693 3.44227 7.50295 3.81373 8.24616 4.55693L9.3564 5.66718C9.48856 5.79934 9.65516 5.87822 9.82999 5.90589C10.1137 5.96682 10.4216 5.88764 10.6424 5.66747L11.7532 4.55693C13.2399 3.07082 15.6582 3.07111 17.144 4.55693C18.5992 6.01214 18.5854 8.34448 17.1125 9.98188Z"
                    fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_6_54">
                    <rect width="20" height="20" fill="white" />
                  </clipPath>
                </defs>
              </symbol>
              <symbol id="icon_star" viewBox="0 0 9 9">
                <path
                  d="M4.0172 0.313075L2.91869 2.64013L0.460942 3.0145C0.0201949 3.08129 -0.15644 3.64899 0.163185 3.97415L1.94131 5.78447L1.52075 8.34177C1.44505 8.80402 1.91103 9.15026 2.30131 8.93408L4.5 7.72661L6.69869 8.93408C7.08897 9.14851 7.55495 8.80402 7.47925 8.34177L7.05869 5.78447L8.83682 3.97415C9.15644 3.64899 8.97981 3.08129 8.53906 3.0145L6.08131 2.64013L4.9828 0.313075C4.78598 -0.101718 4.2157 -0.10699 4.0172 0.313075Z" />
              </symbol>
              <symbol id="icon_next_sm" viewBox="0 0 7 11">
                <path
                  d="M6.83968 5.89247C7.05344 5.67871 7.05344 5.32158 6.83968 5.10728L1.90756 0.162495C1.69106 -0.0540023 1.33996 -0.0540023 1.12401 0.162495C0.90751 0.378993 0.90751 0.730642 1.12401 0.94714L5.66434 5.50012L1.12346 10.0526C0.906962 10.2696 0.906962 10.6207 1.12346 10.8377C1.33996 11.0542 1.69106 11.0542 1.90701 10.8377L6.83968 5.89247Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_prev_sm" viewBox="0 0 7 11">
                <path
                  d="M0.160318 5.10778C-0.0534392 5.32153 -0.0534392 5.67866 0.160318 5.89297L5.09244 10.8377C5.30894 11.0542 5.66004 11.0542 5.87599 10.8377C6.09249 10.6213 6.09249 10.2696 5.87599 10.0531L1.33566 5.50012L5.87654 0.947687C6.09304 0.730642 6.09304 0.379541 5.87654 0.162495C5.66004 -0.0540027 5.30894 -0.0540027 5.09299 0.162495L0.160318 5.10778Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_next_md" viewBox="0 0 25 25">
                <path
                  d="M19.017 13.3923L7.77464 24.631C7.28133 25.123 6.48209 25.123 5.98753 24.631C5.49423 24.1389 5.49423 23.3397 5.98753 22.8476L16.3382 12.5007L5.98878 2.15376C5.49547 1.66169 5.49547 0.862455 5.98878 0.369148C6.48209 -0.122915 7.28257 -0.122915 7.77588 0.369148L19.0183 11.6078C19.5041 12.0948 19.5041 12.9066 19.017 13.3923Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_prev_md" viewBox="0 0 25 25">
                <path
                  d="M5.98293 11.6078L17.2253 0.369152C17.7186 -0.12291 18.5179 -0.12291 19.0124 0.369152C19.5057 0.861216 19.5057 1.66045 19.0124 2.15252L8.66176 12.4994L19.0112 22.8463C19.5045 23.3384 19.5045 24.1376 19.0112 24.631C18.5179 25.123 17.7174 25.123 17.2241 24.631L5.98168 13.3924C5.49595 12.9054 5.49595 12.0936 5.98293 11.6078Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_shield" viewBox="0 0 52 52">
                <g clip-path="url(#clip0_23_87)">
                  <path
                    d="M48.0886 14.1089L48.0871 14.0684C48.0644 13.569 48.0494 13.0405 48.0402 12.4526C47.9978 9.58543 45.7186 7.21379 42.851 7.05352C36.8724 6.71987 32.2473 4.77035 28.2955 0.918523L28.2618 0.886388C26.9728 -0.295463 25.0285 -0.295463 23.7391 0.886388L23.7054 0.918523C19.7536 4.77035 15.1285 6.71987 9.14984 7.05391C6.28269 7.21379 4.00309 9.58543 3.96064 12.453C3.95192 13.037 3.93644 13.5654 3.91383 14.0684L3.91145 14.1625C3.79521 20.259 3.6508 27.8464 6.18906 34.7332C7.58475 38.5203 9.69851 41.8124 12.4712 44.5185C15.6292 47.6002 19.7655 50.0469 24.765 51.7901C24.9277 51.8468 25.0967 51.8928 25.2689 51.9274C25.5117 51.9758 25.7561 52 26.0004 52C26.2448 52 26.4896 51.9758 26.732 51.9274C26.9042 51.8928 27.0744 51.8464 27.2378 51.7893C32.2314 50.0429 36.3634 47.5951 39.5185 44.5137C42.2901 41.8068 44.4038 38.514 45.8007 34.726C48.3485 27.8186 48.2045 20.2169 48.0886 14.1089ZM42.9379 33.6704C40.2608 40.9289 34.7959 45.9138 26.2309 48.909C26.2004 48.9194 26.1679 48.9285 26.1341 48.9352C26.0457 48.9527 25.9556 48.9527 25.866 48.9348C25.8326 48.9281 25.8001 48.9194 25.7699 48.909C17.1959 45.9193 11.7274 40.9372 9.05224 33.6783C6.71274 27.3303 6.84525 20.3653 6.96228 14.2208L6.96308 14.1867C6.98688 13.6586 7.00275 13.1056 7.01148 12.4978C7.03052 11.2247 8.04456 10.1714 9.32004 10.1004C12.7033 9.91154 15.6756 9.25773 18.4067 8.10167C21.1342 6.94719 23.5566 5.31982 25.8116 3.12671C25.9263 3.02991 26.075 3.02951 26.1893 3.12671C28.4447 5.31982 30.8671 6.94719 33.5942 8.10167C36.3253 9.25773 39.2976 9.91154 42.6812 10.1004C43.9567 10.1714 44.9708 11.2247 44.9894 12.4982C44.9985 13.1092 45.0144 13.6622 45.0382 14.1867C45.1548 20.3383 45.2842 27.3088 42.9379 33.6704Z"
                    fill="currentColor" />
                  <path
                    d="M25.9997 13.042C18.8538 13.042 13.0405 18.8557 13.0405 26.0011C13.0405 33.147 18.8538 38.9607 25.9997 38.9607C33.1451 38.9607 38.9588 33.147 38.9588 26.0011C38.9588 18.8557 33.1451 13.042 25.9997 13.042ZM25.9997 35.909C20.5363 35.909 16.0918 31.4645 16.0918 26.0011C16.0918 20.5378 20.5363 16.0932 25.9997 16.0932C31.4626 16.0932 35.9072 20.5378 35.9072 26.0011C35.9072 31.4645 31.4626 35.909 25.9997 35.909Z"
                    fill="currentColor" />
                  <path
                    d="M29.7242 21.9775L23.7051 27.9966L22.0713 26.3629C21.4755 25.767 20.5094 25.767 19.9135 26.3629C19.318 26.9588 19.318 27.9248 19.9135 28.5203L22.6264 31.2332C22.9243 31.5311 23.3147 31.6799 23.7051 31.6799C24.0954 31.6799 24.4858 31.5311 24.7838 31.2332L31.882 24.1349C32.4775 23.539 32.4775 22.573 31.882 21.9775C31.2862 21.3812 30.3201 21.3812 29.7242 21.9775Z"
                    fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_23_87">
                    <rect width="52" height="52" fill="white" />
                  </clipPath>
                </defs>
              </symbol>
              <symbol id="icon_headphone" viewBox="0 0 53 52">
                <path
                  d="M53 28.4375C53 24.2062 49.9411 20.7319 46.0792 20.4368C45.6211 18.9222 44.3835 17.7338 42.824 17.3216C41.7841 8.93425 34.8423 2.53906 26.5 2.53906C18.1577 2.53906 11.2159 8.93425 10.1761 17.3216C8.61664 17.7338 7.3789 18.9221 6.92095 20.4368C6.7868 20.4471 6.65367 20.4612 6.52159 20.4791V10.5625C6.52159 9.72116 5.82638 9.03906 4.96885 9.03906C4.11133 9.03906 3.41612 9.72116 3.41612 10.5625V21.6984C1.36268 23.1288 0 25.6143 0 28.4375C0 32.6688 3.05889 36.1432 6.92085 36.4382C7.37746 37.948 8.60867 39.1334 10.1612 39.5492C10.8227 43.3268 14.1828 46.2109 18.2188 46.2109H18.5778C19.2275 48.098 21.0477 49.4609 23.1875 49.4609H29.8125C32.4952 49.4609 34.6777 47.3196 34.6777 44.6875C34.6777 42.0554 32.4952 39.9141 29.8125 39.9141H23.1875C21.0477 39.9141 19.2275 41.277 18.5778 43.1641H18.2188C15.8707 43.1641 13.8908 41.5903 13.3156 39.4615C15.1425 38.8432 16.459 37.1404 16.459 35.1406V21.7344C16.459 19.7276 15.1334 18.02 13.2966 17.4072C14.2665 10.6781 19.8332 5.58594 26.5 5.58594C33.1668 5.58594 38.7335 10.6781 39.7034 17.4072C37.8666 18.02 36.541 19.7276 36.541 21.7344V35.1406C36.541 37.6607 38.6307 39.7109 41.1992 39.7109H41.6133C43.7224 39.7109 45.5076 38.3281 46.0792 36.4382C49.9411 36.1432 53 32.6688 53 28.4375ZM23.1875 42.9609H29.8125C30.7829 42.9609 31.5723 43.7355 31.5723 44.6875C31.5723 45.6395 30.7829 46.4141 29.8125 46.4141H23.1875C22.2171 46.4141 21.4277 45.6395 21.4277 44.6875C21.4277 43.7355 22.2171 42.9609 23.1875 42.9609ZM3.10547 28.4375C3.10547 26.0216 4.7022 23.9415 6.72852 23.5334V33.3415C4.7022 32.9335 3.10547 30.8534 3.10547 28.4375ZM13.3535 35.1406C13.3535 35.9806 12.657 36.6641 11.8008 36.6641H11.3867C10.5305 36.6641 9.83398 35.9806 9.83398 35.1406C9.83398 30.252 9.83398 26.2535 9.83398 21.7344C9.83398 20.8944 10.5305 20.2109 11.3867 20.2109H11.8008C12.657 20.2109 13.3535 20.8944 13.3535 21.7344V35.1406ZM43.166 35.1406C43.166 35.9806 42.4695 36.6641 41.6133 36.6641H41.1992C40.343 36.6641 39.6465 35.9806 39.6465 35.1406V21.7344C39.6465 20.8944 40.343 20.2109 41.1992 20.2109H41.6133C42.4695 20.2109 43.166 20.8944 43.166 21.7344V35.1406ZM46.2715 33.3416V23.5335C48.2978 23.9416 49.8945 26.0217 49.8945 28.4376C49.8945 30.8535 48.2978 32.9335 46.2715 33.3416Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_shipping" viewBox="0 0 52 52">
                <path
                  d="M47.125 43.875H43.875V21.125C43.875 20.2276 43.1475 19.5 42.25 19.5H33.3125H25.1875H17.875V7.3125C17.875 5.36027 17.1146 3.52402 15.7328 2.14104C14.3509 0.760398 12.5146 0 10.5625 0C6.53037 0 3.25 3.28037 3.25 7.3125C3.25 8.20991 3.97749 8.9375 4.875 8.9375C5.77251 8.9375 6.5 8.20991 6.5 7.3125C6.5 5.07244 8.32244 3.25 10.5625 3.25C11.6472 3.25 12.6676 3.6727 13.4347 4.43909C14.2023 5.20731 14.625 6.22781 14.625 7.3125V21.125V39.2057C11.8246 39.9291 9.75 42.4768 9.75 45.5C9.75 49.0841 12.6659 52 16.25 52C19.2732 52 21.8209 49.9254 22.5443 47.125H42.25H47.125C48.0225 47.125 48.75 46.3974 48.75 45.5C48.75 44.6026 48.0225 43.875 47.125 43.875ZM31.6875 22.75V26H26.8125V22.75H31.6875ZM16.25 48.75C14.4579 48.75 13 47.2921 13 45.5C13 43.7079 14.4579 42.25 16.25 42.25C18.0421 42.25 19.5 43.7079 19.5 45.5C19.5 47.2921 18.0421 48.75 16.25 48.75ZM22.5443 43.875C21.9552 41.5942 20.1558 39.7948 17.875 39.2057V22.75H23.5625V27.625C23.5625 28.5224 24.29 29.25 25.1875 29.25H33.3125C34.21 29.25 34.9375 28.5224 34.9375 27.625V22.75H40.625V43.875H22.5443Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_home" viewBox="0 0 18 18">
                <g clip-path="url(#clip0_171_682)">
                  <path
                    d="M17.6977 8.0467L16.1771 6.66115V2.06683C16.1771 1.77451 15.9401 1.53748 15.6477 1.53748H11.9874C11.6951 1.53748 11.4581 1.77447 11.4581 2.06683V2.36123L9.62165 0.687897C9.26717 0.364846 8.73262 0.364881 8.37828 0.687862L0.302275 8.04673C0.0183538 8.30548 -0.0754781 8.70415 0.0632483 9.06236C0.20201 9.42057 0.539861 9.652 0.924012 9.652H2.21386V17.025C2.21386 17.3173 2.45085 17.5544 2.7432 17.5544H7.16983C7.46215 17.5544 7.69917 17.3174 7.69917 17.025V12.5483H10.3008V17.025C10.3008 17.3174 10.5378 17.5544 10.8301 17.5544H15.2566C15.5489 17.5544 15.7859 17.3174 15.7859 17.025V9.65204H17.076C17.4601 9.65204 17.798 9.42057 17.9368 9.0624C18.0755 8.70415 17.9817 8.30548 17.6977 8.0467ZM15.2566 8.59334C14.9642 8.59334 14.7272 8.83033 14.7272 9.12269V16.4957H11.3595V12.019C11.3595 11.7267 11.1225 11.4897 10.8301 11.4897H7.16983C6.8775 11.4897 6.64048 11.7266 6.64048 12.019V16.4957H3.27252V9.12269C3.27252 8.83037 3.03553 8.59334 2.74317 8.59334H1.27424L9.00002 1.55365L11.631 3.95099C11.7859 4.09218 12.0096 4.12857 12.2013 4.04395C12.3931 3.95922 12.5168 3.76931 12.5168 3.55971V2.59618H15.1184V6.89494C15.1184 7.0439 15.1811 7.1859 15.2913 7.28623L16.7257 8.59334H15.2566Z"
                    fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_171_682">
                    <rect width="18" height="18" fill="white" />
                  </clipPath>
                </defs>
              </symbol>
              <symbol id="icon_hanger" viewBox="0 0 18 18">
                <g clip-path="url(#clip0_171_678)">
                  <path
                    d="M16.8037 12.0285L11.9362 9.10027C11.2525 8.68897 10.492 8.42791 9.70506 8.32972V7.59625C9.70506 7.18302 9.94168 6.79836 10.3225 6.59223C11.2687 6.08013 11.8258 5.09383 11.7763 4.01814C11.7108 2.59335 10.5588 1.43964 9.13226 1.37414C7.53307 1.30122 6.2246 2.5744 6.2246 4.14846C6.2246 4.53683 6.53949 4.85159 6.92772 4.85159C7.31609 4.85159 7.63085 4.53683 7.63085 4.14846C7.63085 3.37008 8.2778 2.74249 9.06758 2.77888C9.76659 2.81101 10.3394 3.38381 10.3715 4.08282C10.3961 4.61483 10.1208 5.10249 9.65302 5.35558C8.81778 5.80767 8.29881 6.66625 8.29881 7.59625V8.32931C7.51521 8.42654 6.75743 8.6854 6.07559 9.09341L1.20123 12.0104H1.2011C0.461305 12.4532 0.000978114 13.2638 1.68088e-05 14.1261C-0.00149381 15.4906 1.1014 16.5962 2.46604 16.5979L15.5281 16.6131H15.5311C16.8911 16.6131 17.9984 15.5074 18 14.147C18.001 13.2848 17.5426 12.4729 16.8037 12.0285ZM15.5311 15.2069C15.5307 15.2069 15.5302 15.2069 15.5299 15.2069L2.46782 15.1916C1.8817 15.191 1.40558 14.7137 1.40627 14.1278C1.40668 13.7566 1.60484 13.4076 1.92331 13.217H1.92317L6.79767 10.3001C8.15613 9.48713 9.85324 9.48837 11.2113 10.3052L16.0789 13.2335C16.3968 13.4248 16.5942 13.7743 16.5938 14.1453C16.5931 14.7309 16.1165 15.2069 15.5311 15.2069Z"
                    fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_171_678">
                    <rect width="18" height="18" fill="white" />
                  </clipPath>
                </defs>
              </symbol>
              <symbol id="icon_sharing" viewBox="0 0 16 19">
                <path
                  d="M12.8 11.8044C11.9413 11.8044 11.1606 12.1445 10.5853 12.6969L7.16295 10.5766C7.35822 10.1241 7.46667 9.6256 7.46667 9.10222C7.46667 8.57885 7.35822 8.08039 7.16292 7.62788L10.5853 5.50759C11.1606 6.05995 11.9413 6.4 12.8 6.4C14.5645 6.4 16 4.96448 16 3.2C16 1.43552 14.5645 0 12.8 0C11.0355 0 9.6 1.43552 9.6 3.2C9.6 3.72092 9.72519 4.21316 9.94695 4.64825L6.60469 6.71893C5.91932 5.89461 4.88661 5.36889 3.73333 5.36889C1.67477 5.36889 0 7.04366 0 9.10222C0 11.1608 1.67477 12.8356 3.73333 12.8356C4.88661 12.8356 5.91932 12.3098 6.60469 11.4855L9.94695 13.5562C9.72519 13.9913 9.6 14.4835 9.6 15.0044C9.6 16.7689 11.0355 18.2044 12.8 18.2044C14.5645 18.2044 16 16.7689 16 15.0044C16 13.24 14.5645 11.8044 12.8 11.8044ZM12.8 1.06667C13.9763 1.06667 14.9333 2.02368 14.9333 3.2C14.9333 4.37632 13.9763 5.33333 12.8 5.33333C11.6237 5.33333 10.6667 4.37632 10.6667 3.2C10.6667 2.02368 11.6237 1.06667 12.8 1.06667ZM3.73333 11.7689C2.26293 11.7689 1.06667 10.5726 1.06667 9.10222C1.06667 7.63182 2.26293 6.43556 3.73333 6.43556C5.20373 6.43556 6.4 7.63182 6.4 9.10222C6.4 10.5726 5.20373 11.7689 3.73333 11.7689ZM12.8 17.1378C11.6237 17.1378 10.6667 16.1808 10.6667 15.0044C10.6667 13.8281 11.6237 12.8711 12.8 12.8711C13.9763 12.8711 14.9333 13.8281 14.9333 15.0044C14.9333 16.1808 13.9763 17.1378 12.8 17.1378Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_close" viewBox="0 0 12 12">
                <path d="M0.311322 10.6261L10.9374 0L12 1.06261L1.37393 11.6887L0.311322 10.6261Z" fill="currentColor" />
                <path d="M1.06261 0.106781L11.6887 10.7329L10.6261 11.7955L0 1.16939L1.06261 0.106781Z" fill="currentColor" />
              </symbol>
              <symbol id="icon_view" viewBox="0 0 18 18">
                <path
                  d="M17.6785 8.58827C17.5212 8.38709 13.7733 3.6604 9.00022 3.6604C4.22675 3.6604 0.478773 8.38709 0.321484 8.58827L0 8.99976L0.321484 9.41125C0.478773 9.61243 4.22675 14.3393 9.00022 14.3393C13.7733 14.3393 17.5212 9.61243 17.6785 9.41125L18 8.99976L17.6785 8.58827ZM9.00022 13.0028C5.64324 13.0028 2.71312 10.0963 1.72773 8.99998C2.71357 7.90341 5.64346 4.99736 9.00022 4.99736C12.3568 4.99736 15.2869 7.90364 16.2725 8.99998C15.2864 10.0965 12.3565 13.0028 9.00022 13.0028Z"
                  fill="currentColor" />
                <path
                  d="M9.00007 5.34314C6.98339 5.34314 5.34277 6.98353 5.34277 8.99999C5.34277 11.0169 6.98339 12.6575 9.00007 12.6575C11.0168 12.6575 12.6574 11.0169 12.6574 8.99999C12.6574 6.98353 11.0168 5.34314 9.00007 5.34314ZM9.00007 11.3206C7.72038 11.3206 6.67951 10.2795 6.67951 8.99977C6.67951 7.72052 7.72038 6.67965 9.00007 6.67965C10.2796 6.67965 11.3206 7.72052 11.3206 8.99977C11.3206 10.2795 10.2796 11.3206 9.00007 11.3206Z"
                  fill="currentColor" />
              </symbol>
              <symbol id="icon_gift" viewBox="0 0 45 45">
                <g clip-path="url(#clip0_103_552)">
                  <path
                    d="M42.3288 13.1443L40.0744 6.95021C39.3286 4.90095 37.0545 3.84037 35.0053 4.58648L30.8603 6.09521C30.867 6.05469 30.8739 6.01417 30.8797 5.9733C31.1516 4.06194 30.3512 2.21668 28.7391 1.03736C27.2149 -0.0777035 25.2643 -0.309207 23.5216 0.417824C21.7787 1.14494 20.5711 2.69393 20.2922 4.55501L19.7 8.37447L16.6377 5.66753C15.2227 4.41676 13.302 4.00613 11.4996 4.56969C7.53123 5.80983 6.44534 10.8941 9.52248 13.6558C9.57777 13.7054 9.63419 13.7532 9.69115 13.8003L5.27359 15.4082C3.21985 16.1557 2.16217 18.423 2.90995 20.4772L5.16443 26.6713L7.97183 25.6558V41.0451C7.97183 43.2258 9.72841 45.0001 11.9092 45.0001C12.2951 45.0001 37.4585 45.0001 38.2757 45.0001C40.4565 45.0001 42.2307 43.2259 42.2307 41.0451V21.0944C41.3836 21.0944 20.4865 21.0944 20.4865 21.0944L42.3288 13.1443ZM35.9071 7.06411C36.59 6.81556 37.3482 7.16897 37.5967 7.85205L38.9495 11.5685L26.5613 16.0775L24.7578 11.1222L35.9071 7.06411ZM22.8987 4.95228C23.0405 4.00534 23.6529 3.21995 24.5366 2.85125C25.4121 2.48598 26.4021 2.5947 27.1823 3.16537C28.9536 4.46123 28.5289 6.94353 26.5088 7.67908C26.1701 7.80231 23.9626 8.60589 23.8559 8.64465L22.2347 9.23466L22.8987 4.95228ZM22.28 12.024L24.0835 16.9791C23.217 17.2946 22.4724 17.5655 21.6059 17.881L19.8023 12.9257L22.28 12.024ZM12.2859 7.08609C13.1885 6.80413 14.1647 7.00048 14.8914 7.64278L18.3086 10.6636C17.3172 11.0245 14.9729 11.8777 14.0221 12.2236C13.065 12.5718 12.0413 12.3736 11.2835 11.6933C9.69774 10.2702 10.3022 7.70607 12.2859 7.08609ZM6.74013 23.2918L5.38741 19.5753C5.13815 18.8909 5.4905 18.1348 6.17535 17.8855L17.3247 13.8275L19.1282 18.7827L6.74013 23.2918ZM29.0473 23.7311H39.6115V41.0451C39.6115 41.772 39.0025 42.3634 38.2756 42.3634H29.0473V23.7311ZM23.774 23.7311H26.4282V42.3634H23.774V23.7311ZM21.1549 23.7311V42.3634H11.9091C11.1821 42.3634 10.5907 41.7719 10.5907 41.045V24.6961L13.242 23.7311H21.1549Z"
                    fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_103_552">
                    <rect width="45" height="45" fill="white" />
                  </clipPath>
                </defs>
              </symbol>
       
            </svg>
        
          </div>
  
          <div class="footer-column footer-menu mb-4 mb-lg-0">
            <h6 class="sub-menu__title text-uppercase">Company</h6>
            <ul class="sub-menu__list list-unstyled">
              <li class="sub-menu__item"><a href="about-2.html" class="menu-link menu-link_us-s">About Us</a></li>
              <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Careers</a></li>
              <li class="sub-menu__item"><a href="contact-2.html" class="menu-link menu-link_us-s">Contact Us</a></li>
            </ul>
          </div>
  
          <div class="footer-column footer-menu mb-4 mb-lg-0">
            <h6 class="sub-menu__title text-uppercase">Shop</h6>
            <ul class="sub-menu__list list-unstyled">
              <li class="sub-menu__item"><a href="shop4.html" class="menu-link menu-link_us-s">Men</a></li>
              <li class="sub-menu__item"><a href="shop5.html" class="menu-link menu-link_us-s">Women</a></li>
            </ul>
          </div>
  
          <div class="footer-column footer-menu mb-4 mb-lg-0">
            <h6 class="sub-menu__title text-uppercase">Help</h6>
            <ul class="sub-menu__list list-unstyled">
              <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Customer Service</a></li>
              <li class="sub-menu__item"><a href="account_dashboard.html" class="menu-link menu-link_us-s">My Account</a>
              </li>
            </ul>
          </div>
  
        </div>
      </div>
    </footer>
  
  
    {{-- <footer class="footer-mobile container w-100 px-5 d-md-none bg-body">
      <div class="row text-center">
        <div class="col-4">
          <a href="{{route('home.index')}}" class="footer-mobile__link d-flex flex-column align-items-center">
            <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_home" />
            </svg>
            <span>Home</span>
          </a>
        </div>
  
        <div class="col-4">
          <a href="{{route('home.index')}}" class="footer-mobile__link d-flex flex-column align-items-center">
            <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_hanger" />
            </svg>
            <span>Shop</span>
          </a>
        </div>
  
        <div class="col-4">
          <a href="{{route('home.index')}}" class="footer-mobile__link d-flex flex-column align-items-center">
            <div class="position-relative">
              <svg class="d-block" width="18" height="18" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_heart" />
              </svg>
              <span class="wishlist-amount d-block position-absolute js-wishlist-count">3</span>
            </div>
            <span>Wishlist</span>
          </a>
        </div>
      </div>
    </footer> --}}
  
    {{-- <div id="scrollTop" class="visually-hidden end-0"></div>
    <div class="page-overlay"></div>
   --}}
    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/countdown.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/theme.js') }}""></script>
    @stack("scripts")
  </body>

</html>

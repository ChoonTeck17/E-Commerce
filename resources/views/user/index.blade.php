@extends('layouts.app')
@section('content')
@if (session('status'))
    <script>
        alert('{{ session('status') }}');
    </script>
@endif

<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">My Account</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
                <div class="col-lg-9">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Dashboard</h5>
                            <p class="mb-2">Hello <strong>{{ auth()->user()->name ?? 'User' }}</strong></p>
                            <p class="mb-0">
                                From your account dashboard, you can view your recent orders, manage your shipping addresses, and edit your password and account details
                            </p>
                        </div>
                    </div>
                </div>
      </div>
    </section>
  </main>

@endsection
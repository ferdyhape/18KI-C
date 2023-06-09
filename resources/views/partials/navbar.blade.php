<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="bg-white rounded-circle shadow-sm" src="{{ asset('assets/image/logo.png') }}" alt="Bootstrap"
                width="40">
        </a>
        <a class="navbar-brand text-white fw-bold" href="#">18KI-C</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link text-white {{ request()->is('produk') ? 'border-bottom border-2' : '' }}"
                        href="{{ url('/produk') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('kategori') ? 'border-bottom border-2' : '' }}"
                        href="{{ url('/kategori') }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('transaksi') || Route::currentRouteName() == 'transaksi.id' ? 'border-bottom border-2' : '' }}"
                        href="{{ url('/transaksi') }}">Transaksi</a>
                </li>
                <li
                    class="nav-item dropdown {{ Route::currentRouteName() == 'cart.id' ? 'border-bottom border-2' : '' }}">
                    <a class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Cart
                    </a>
                    <ul class="dropdown-menu">
                        @php
                            use App\Models\Cart;
                            $carts = Cart::where('user_id', 'like', Auth::user()->id)->get();
                            $split = explode(' ', auth()->user()->nama);
                            $firstname = $split[0];
                        @endphp

                        @foreach ($carts as $cart)
                            <li><a class="dropdown-item" href="/cart/{{ $cart->id }}">{{ $firstname }}'s
                                    Cart {{ $loop->iteration }}</a>
                            </li>
                        @endforeach
                        <li><a class="dropdown-item" href="/cart/add">Tambah cart</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link text-white bg-transparent border-0">
                            <a>Logout</a>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

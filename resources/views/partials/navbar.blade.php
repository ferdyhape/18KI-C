<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">18KI-C</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link text-white {{ request()->is('produk') ? 'border-bottom border-2' : '' }}"
                        href="{{ url('/produk') }}">Produk</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white {{ request()->is('kategori') ? 'border-bottom border-2' : '' }}"
                        href="{{ url('/kategori') }}">Kategori</a>
                </li>
                <li
                    class="nav-item dropdown {{ Route::currentRouteName() == 'cart.id' ? 'border-bottom border-2' : '' }}">
                    <a class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Cart
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($carts as $cart)
                            <li><a class="dropdown-item" href="/cart/{{ $cart->id }}">Cart {{ $cart->id }}</a>
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

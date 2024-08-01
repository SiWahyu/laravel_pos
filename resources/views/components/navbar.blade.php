<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ auth()->user()->username }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->roles[0]->name }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ asset('assets/compiled/jpg/5.jpg') }}" alt="profile">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ auth()->user()->username }}</h6>
                        </li>
                        @hasrole('Customer')
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i>
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.cart.data') }}"><i
                                        class="icon-mid bi bi-cart me-2 "></i>
                                    Cart</a></li>
                            <li><a class="dropdown-item" href="{{ route('customer.order.data') }}"><i
                                        class="icon-mid bi bi-wallet me-2 "></i>
                                    Order</a></li>
                        @endhasrole
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                    class="icon-mid bi bi-box-arrow-left me-2"></i>
                                Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

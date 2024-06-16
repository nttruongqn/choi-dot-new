@php
    $route_name = Request::route()->getName();
@endphp
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="{{ $route_name === 'admin.index' ? 'active' : '' }} nav-link" href="">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Trang tổng quan
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                aria-expanded="false" aria-controls="collapseLayouts" id="collapse-system">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                Hệ thống
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="{{ $route_name === 'user.index' ? 'active' : '' }} nav-link"
                        href="{{ route('user.index') }}"">Tài khoản</a>
                    <a class="{{ $route_name === 'category.index' ? 'active' : '' }} nav-link"
                        href="{{ route('category.index') }}">Danh
                        mục</a>
                    <a class="{{ $route_name === 'product.index' ? 'active' : '' }} nav-link"
                        href="{{ route('product.index') }}">Sản
                        phẩm</a>
                    <a class="{{ $route_name === 'article.index' ? 'active' : '' }} nav-link"
                        href="{{ route('article.index') }}">Bài viết</a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                aria-expanded="false" aria-controls="collapsePages" id="collapsed-cart">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-box-open"></i></div>
                Đơn hàng
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>

            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="{{ $route_name === 'checkout.index' ? 'active' : '' }} nav-link" href="">Danh
                        sách</a>
                </nav>
            </div>

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Copyright &copy; TruongNT 2023</div>
    </div>
</nav>

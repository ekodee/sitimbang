<div class="header-wrapper"> <!-- [Mobile Media Block] start -->
    <div class="me-auto pc-mob-drp">
        <ul class="list-unstyled">
            <!-- ======= Menu collapse Icon ===== -->
            <li class="pc-h-item pc-sidebar-collapse">
                <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                    <svg width="20" height="20" class="icon">
                        <use xlink:href="#icon-menu-2"></use>
                    </svg>

                </a>
            </li>
            <li class="pc-h-item pc-sidebar-popup">
                <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                    <svg width="20" height="20" class="icon">
                        <use xlink:href="#icon-menu-2"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
    <!-- [Mobile Media Block end] -->
    <div class="ms-auto">
        <ul class="list-unstyled">
            <li class="dropdown pc-h-item header-user-profile">
                <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                    <img src="{{ asset('template/dist') }}/assets/images/user/avatar-2.jpg" alt="user-image"
                        class="user-avtar">
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                    <div class="dropdown-header">
                        <div class="d-flex mb-1">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('template/dist') }}/assets/images/user/avatar-2.jpg" alt="user-image"
                                    class="user-avtar wid-35">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">{{ Auth::user()->name }}</h6>
                                <h6 class="mb-1">{{ Auth::user()->jabatan }}</h6>
                            </div>
                        </div>
                    </div>
                    <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="drp-t1" data-bs-toggle="tab"
                                data-bs-target="#drp-tab-2" type="button" role="tab" aria-controls="drp-tab-1"
                                aria-selected="false"><i class="ti ti-info-circle"></i>Informasi Pengguna</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="mysrpTabContent">
                        <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t2"
                            tabindex="0">
                            <span class="dropdown-item">Username : {{ Auth::user()->username }}</span>
                            <span class="dropdown-item">Email : {{ Auth::user()->email }}</span>
                            <span class="dropdown-item">NIK/NIP : {{ Auth::user()->nik }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0 m-0">
                                @csrf
                                <button type="submit"
                                    class="w-100 text-start border-0 bg-transparent d-flex align-items-center px-3 py-2">
                                    <i class="ti ti-power text-danger me-2"></i>
                                    <span class="text-danger">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    {{-- Tentang --}}
    {{-- <div class="">
        <ul class="list-unstyled">
            <li class="dropdown pc-h-item header-user-profile">
                <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                    <span>Tentang</span>
                </a>
                <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                    <div class="dropdown-header text-wrap">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo, laborum voluptate eos
                            eveniet consequuntur, qui, tenetur fugit quasi odit officia animi vel velit temporibus
                            nostrum. Est nisi labore harum, repudiandae odio perferendis saepe aperiam pariatur unde
                            iure, ipsam ratione non facere sint dolorem? Quam dignissimos harum quas odio impedit
                            cupiditate.
                    </div>
                </div>
            </li>
        </ul>
    </div> --}}
</div>

@php
    $isActive['user_management'] = isActiveMenu(['user.*', 'role.*']);
    $isActive['settings'] = isActiveMenu(['setting.*', 'mail.*', 'user.profile']);

@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ showDefaultImage('storage/' . $siteData['primary_logo']) }}" alt="Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">{{ $siteData['site_short_name'] }}</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @can('dashboard')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link @if (Route::is('dashboard')) active @endif">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endcan



                @canany(['general.setting', 'mail.setup', 'setting.qr_code', 'setting.privacy_policy', 'setting.terms_and_condition'])
                    <li class="nav-item {{ $isActive['settings'] == 'true' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-sliders2"></i>
                            <p>Site Configuration
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @can('general.setting')
                                <li class="nav-item">
                                    <a href="{{ route('setting.index') }}" class="nav-link @if (Route::is('setting.index')) active @endif">
                                        <i class="nav-icon bi bi-gear"></i>
                                        <p>General Setting</p>
                                    </a>
                                </li>
                            @endcan
                            @can('mail.setup')
                                <li class="nav-item">
                                    <a href="{{ route('mail.setup') }}" class="nav-link @if (Route::is('mail.*')) active @endif">
                                        <i class="nav-icon bi bi-envelope-plus"></i>
                                        <p>Mail Setup</p>
                                    </a>
                                </li>
                            @endcan
                            @can('setting.qr_code')
                                <li class="nav-item">
                                    <a href="{{ route('setting.qr_code') }}" class="nav-link @if (Route::is('setting.qr_code')) active @endif">
                                        <i class="nav-icon bi bi-qr-code"></i>
                                        <p>QR Code Setting</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcanany
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>

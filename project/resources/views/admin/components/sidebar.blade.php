@php
    $route = Route::current()->getName();
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MR <sup>x</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $route == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ in_array($route, ['home.seo', 'about.seo', 'contact.seo', 'resume.seo']) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Seo Properties</span>
        </a>
        <div id="collapsePages"
            class="collapse {{ in_array($route, ['home.seo', 'about.seo', 'contact.seo', 'resume.seo']) ? 'show' : '' }}"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ 'home.seo' == $route ? 'active' : '' }}" href="{{ route('home.seo') }}">Home
                    Page</a>
                <a class="collapse-item {{ 'about.seo' == $route ? 'active' : '' }}"
                    href="{{ route('about.seo') }}">Project Page</a>
                <a class="collapse-item {{ 'resume.seo' == $route ? 'active' : '' }}"
                    href="{{ route('resume.seo') }}">Resume Page</a>
                <a class="collapse-item {{ 'contact.seo' == $route ? 'active' : '' }}"
                    href="{{ route('contact.seo') }}">Contact Page</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Hero Section -->
    <li class="nav-item {{ $route == 'hero.properties' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('hero.properties') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Hero Section</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - About Section -->
    <li class="nav-item {{ $route == 'about.info' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('about.info') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>About Section</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - About Section -->
    <li class="nav-item {{ $route == 'resume.link' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('resume.link') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Resume link</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Projects -->
    <li class="nav-item {{ $route == 'all.project' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('all.project') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Projects</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Skills -->
    <li class="nav-item {{ $route == 'all.skill' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('all.skill') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Skills</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Educations -->
    <li class="nav-item {{ $route == 'all.education' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('all.education') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Educations</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Experience -->
    <li class="nav-item {{ $route == 'all.experience' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('all.experience') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Experiences</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Languages -->
    <li class="nav-item {{ $route == 'all.language' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('all.language') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Languages</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Socials -->
    <li class="nav-item {{ $route == 'social.link' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('social.link') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Socials</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

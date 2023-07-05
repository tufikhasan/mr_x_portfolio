@php
    $route = Route::current()->getName();
@endphp
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container px-5">
        <a class="navbar-brand" href="{{ route('home.page') }}"><span class="fw-bolder text-primary">MR. X</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                <li class="nav-item"><a class="nav-link {{ 'home.page' == $route ? 'active' : '' }}"
                        href="{{ route('home.page') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ 'resume.page' == $route ? 'active' : '' }}"
                        href="{{ route('resume.page') }}">Resume</a></li>
                <li class="nav-item"><a class="nav-link {{ 'project.page' == $route ? 'active' : '' }}"
                        href="{{ route('project.page') }}">Projects</a></li>
                <li class="nav-item"><a class="nav-link {{ 'contact.page' == $route ? 'active' : '' }}"
                        href="{{ route('contact.page') }}">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

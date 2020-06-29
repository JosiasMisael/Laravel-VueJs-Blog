<nav class="custom-wrapper" id="menu">
    <div class="pure-menu"></div>
    <ul class="container-flex list-unstyled">
        <li><a href="{{ route('page.home') }}" class="text-uppercase {{ setActiveRoute('page.home') }}">Inicio</a></li>
        <li><a href="{{ route('page.about')}}"  class="text-uppercase {{ setActiveRoute('page.about') }}">Nosotros</a></li>
        <li><a href="{{ route('page.archive')}} " class="text-uppercase {{ setActiveRoute('page.archive') }}">Archivo</a></li>
        <li><a href="{{ route('page.contact')}} " class="text-uppercase {{ setActiveRoute('page.contact') }}">Contacto</a></li>
    </ul>
</nav>

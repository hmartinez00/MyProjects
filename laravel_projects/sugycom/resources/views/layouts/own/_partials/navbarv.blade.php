<nav class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
    <ul class="nav nav-pills flex-column">
        {{-- <li><a href="{{ route('priority.index') }}" class="nav-link text-white">Priorities</a></li> --}}
        <button type="button" class="btn btn-primary mb-4">
            <a class="nav-link text-white" href="{{ route('priority.create') }}">Crear nuevo item</a>
        </button>
    </ul>
</nav>
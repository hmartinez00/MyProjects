@extends('layouts.own.app')
@section('content')

    <div class="content">
        <table class="table table-sm table-dark table-hover">
            <tbody>
                <tr>
                    <td>
                        <a class="ms-5" href="{{ route('trigger.index') }}">Back</a>
                    </td>
                    <td>
                        <form action="{{ route('trigger.compress') }}" method="POST">
                            @csrf
                            {{-- @method('DELETE') --}}
                            <input type="submit" class="btn btn-success m-2 ms-5" value="Download All">
                        </form>
                    </td>
                </tr>                
            </tbody>
        </table>

        <div class="accordion mb-4" id="accordionExample">
            @forelse ($directories as $directory)
                @if ( $directory !== '.' && $directory !== '..' && strpos($directory, '.zip') === false )

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ str_replace(" ", "_", $directory) }}" aria-expanded="false" aria-controls="{{ str_replace(" ", "_", $directory) }}">
                                {{ $directory }}
                            </button>
                        </h2>
                        <div id="{{ str_replace(" ", "_", $directory) }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    @foreach ($files as $file)
                                        @if ( strpos($file, $directory) !== false )
                                            <li>
                                                {{ basename(str_replace("\\", "/", $file)) }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                                {{-- button --}}
                            </div>
                        </div>
                    </div>

                @endif
            @empty
                <p>No data.</p>
            @endforelse

        </div>
            
    </div>

@endsection
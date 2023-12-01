@extends('layouts.base')

@section('body')
    <div class="min-h-screen bg-gray-100">

        <nav class="bg-white border-b border-gray-200">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">

                    <div class="flex items-center">
                        @auth
                            <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        @endauth
                    </div>
                    <div class="flex items-center">
                        @auth
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                                sign out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex">


            <div class="bg-gray-800 text-white w-64 min-h-screen">
                <ul class="py-4">
                    <li class="px-4 py-2">
                        <a href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="px-4 py-2 {{ request()->is('user/portafolio') ? 'bg-gray-700' : '' }}">
                        <a href="{{ route('portafolio.index') }}">Portafolios</a>
                    </li>

                </ul>
            </div>



            <div class="flex-1">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </div>
        </main>


        @isset($slot)
            {{ $slot }}
        @endisset
    </div>
@endsection

<x-guest-layout>
    @if ($greeting->is_public)
        <div class="flex flex-col items-center justify-between">
            <div>
                @if ($greeting->picture)
                    <x-avatar size="w-36 h-36" rounded="xl" src="{{asset('storage/'.$greeting->picture)}}" />
                @endif
            </div>
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{$greeting->title}}
                </h2>
            </div>
        </div>
        <p class="mt-4 mb-12 text-xs">{{$greeting->body}}</p>
        <div class="flex items-center justify-between">
            <h3 class="text-sm">Made by: {{$user->name}}</h3>
            <livewire:greetings.heart-react :greeting="$greeting" />
        </div>
    @else
        @auth
            <div class="flex flex-col items-center justify-between">
                <div>
                    @if ($greeting->picture)
                        <x-avatar size="w-36 h-36" rounded="xl" src="{{asset('storage/'.$greeting->picture)}}" />
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        {{$greeting->title}}
                    </h2>
                </div>
            </div>
            <p class="mt-4 mb-12 text-xs">{{$greeting->body}}</p>
            <div class="flex items-center justify-between">
                <h3 class="text-sm">Made by: {{$user->name}}</h3>
                <livewire:greetings.heart-react :greeting="$greeting" />
            </div>
        @else
            <h1 class="text-2xl font-bold text-center text-gray-800">Opps! The greeting is set to private! You need to log in to see it.</h1>
            <div class="flex justify-center mt-10 space-x-6">
                <div>
                    <x-button rose lg href="{{route('login')}}">Login</x-button>
                </div>
                <div>
                    <x-button outline primary lg href="{{route('register')}}">Register</x-button>
                </div>
            </div>
        @endauth
    @endif

</x-guest-layout>

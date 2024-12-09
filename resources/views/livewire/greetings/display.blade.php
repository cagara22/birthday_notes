<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Greeting;

new class extends Component {

    use WithPagination;

    public function with(){
        return [
            'greetings' => Auth::user()->greetings()->orderBy('send_date', 'desc')->paginate(12)
        ];
    }

    public function deleteGreeting($greeting_id){
        $greeting = Greeting::where('id', $greeting_id)->first();
        $this->authorize('delete', $greeting);
        $greeting->delete();
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($greetings->isEmpty())
            <div class="text-center">
                <p class="text-xl font bold">No notes yet!</p>
                <p class="text-sm">Click the button bellow to add your first notes</p>
                <x-button primary right-icon="plus" class="mt-6" href="{{route('greetings.create')}}" wire:navigate>Create Greeting</x-button>
            </div>
        @else
            <x-button primary right-icon="plus" class="mt-6" href="{{route('greetings.create')}}" wire:navigate>Create Greeting</x-button>
            {{ $greetings->links() }}
            <div class="grid grid-cols-3 gap-4">
                @foreach ($greetings as $greeting)
                    <x-card wire:key='{{$greeting->id}}'>
                        <div class="flex justify-between">
                            <div>
                                <div class="flex items-center justify-between space-x-1">
                                    <div>
                                        @if ($greeting->picture)
                                            <x-avatar lg src="{{asset('storage/'.$greeting->picture)}}" rounded="xl" />
                                        @else
                                            <x-avatar lg icon="users" positive rounded="xl" />
                                        @endif
                                    </div>
                                    <div>
                                        @can('update', $greeting)
                                            <a href="{{route('greetings.edit', $greeting)}}" wire:navigate class="text-xl font-bold hover:underline hover:text-blue-500">{{Str::limit($greeting->title, '25')}}</a>
                                        @else
                                            <p class="text-xl font-bold text-gray-500">{{Str::limit($greeting->title, '25')}}</p>
                                        @endcan
                                    </div>
                                </div>
                                <p class="mt-2 text-xs">{{Str::limit($greeting->body, 30)}}</p>
                            </div>
                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($greeting->send_date)->format('M-d-Y')}}</div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">Recipient: <span class="font-semi-bold">{{$greeting->recipient}}</span></p>
                            <div>
                                <x-mini-button rounded info icon="eye" href="{{route('greetings.show', $greeting)}}"></x-mini-button>
                                <x-mini-button rounded negative icon="trash" wire:click="deleteGreeting('{{$greeting->id}}')"></x-mini-button>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
            {{ $greetings->links() }}
        @endif
    </div>
</div>

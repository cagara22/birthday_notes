<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Greeting;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules\File;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;

    public Greeting $greeting;
    public $title;
    public $body;
    public $old_picture;
    public $picture;
    public $recipient;
    public $is_public;
    public $send_date;

    public function mount(Greeting $greeting){
        $this->authorize('update', $greeting);
        $this->greeting = $greeting;
        $this->title = $greeting->title;
        $this->body = $greeting->body;
        $this->old_picture = $greeting->picture;
        $this->recipient = $greeting->recipient;
        $this->is_public = $greeting->is_public;
        $this->send_date = $greeting->send_date;
    }

    public function with(){
        return [
            'old_picture' => $this->old_picture
        ];
    }

    public function updateGreeting(){
        $validated = $this->validate([
            'title' => 'required|min:6',
            'body' => 'required|min:6',
            'picture' => ['nullable', File::types(['png', 'jpg', 'jpeg'])],
            'recipient' => 'required|email',
            'send_date' => 'required|date'
        ]);

        if(is_null($this->picture)){
            unset($validated['picture']);
        }

        $validated['is_public'] = $this->is_public;

        if($this->picture){
            if ($this->old_picture && Storage::disk('public')->exists($this->old_picture)) {
                Storage::disk('public')->delete($this->old_picture);
            }

            $validated['picture'] = $this->picture->store('pictures', 'public');
            $this->old_picture = $this->picture;
        }

        $this->greeting->update($validated);

        $this->dispatch('greeting-updated');
    }
}; ?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Greeting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form wire:submit="updateGreeting" enctype="multipart/form-data" class="space-y-4">
                        <x-errors />
                        <x-action-message on="greeting-updated">
                            <x-alert title="Greeting updated successfully!" positive />
                        </x-action-message>
                        <x-input wire:model="title" label="Title" placeholder="Put your greeting title here..."  />
                        <x-textarea wire:model="body" label="Message" placeholder="Put your birthday message here..." />
                        <div class="flex items-center justify-start space-x-3">
                            <div>
                                @if ($old_picture)
                                    <x-avatar size="w-32 h-32" rounded="xl" src="{{asset('storage/'.$old_picture)}}" primary />
                                @else
                                    <x-heroicons::solid.photo class="w-32 h-32 text-negative-600"/>
                                @endif
                            </div>
                            <div class="grow">
                                <x-input wire:model="picture" icon="photo" type="file" label="Picture" />
                            </div>
                        </div>

                        <x-input wire:model="recipient" icon="user" label="Email" placeholder="friend@emai.com"/>
                        <x-datetime-picker wire:model="send_date" label="Send Date" parse-format="YYYY-MM-DD" display-format="YYYY-MM-DD" :without-time="true" :min="now()" placeholder="The birtday of your recipient..."  />
                        <x-checkbox label="Set Greeting to Public" wire:model='is_public' />

                        <div class="flex justify-between pt-4">
                            <x-button type="submit" info right-icon="pencil" spinner>Update Greeting</x-button>
                            <x-button href="{{route('greetings.index')}}" flat secondary>Back to Greetings</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

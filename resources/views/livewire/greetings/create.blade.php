<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules\File;

new class extends Component {
    use WithFileUploads;

    public $title;
    public $body;
    public $picture;
    public $recipient;
    public $send_date;

    public function submit(){
        $validated = $this->validate([
            'title' => 'required|min:6',
            'body' => 'required|min:6',
            'picture' => ['nullable', File::types(['png', 'jpg', 'jpeg'])],
            'recipient' => 'required|email',
            'send_date' => 'required|date'
        ]);

        if($validated['picture']){
            $validated['picture'] = $validated['picture']->store('pictures', 'public');
        }

        auth()->user()->greetings()->create($validated);

        redirect(route('greetings.index'));
    }
}; ?>

<div>
    <form wire:submit="submit" enctype="multipart/form-data" class="space-y-2">
        <x-errors />
        <x-input wire:model="title" label="Title" placeholder="Put your greeting title here..."  />
        <x-textarea wire:model="body" label="Message" placeholder="Put your birthday message here..." />
        <x-input wire:model="picture" icon="photo" type="file" label="Picture" />
        <x-input wire:model="recipient" icon="user" label="Email" placeholder="friend@emai.com"/>
        <x-datetime-picker wire:model="send_date" label="Send Date" parse-format="YYYY-MM-DD" display-format="YYYY-MM-DD" :without-time="true" :min="now()" placeholder="The birtday of your recipient..."  />

        <div class="pt-4">
            <x-button type="submit" primary right-icon="calendar" spinner>Schedule Greeting</x-button>
        </div>
    </form>
</div>

<?php

use Livewire\Volt\Component;
use App\Models\Greeting;

new class extends Component {
    public Greeting $greeting;
    public $heart_count;

    public function mount(Greeting $greeting){
        $this->greeting = $greeting;
        $this->heart_count = $greeting->heart_count;
    }

    public function increaseHeartCount(){
        $this->greeting->update([
            'heart_count' => $this->heart_count + 1
        ]);

        $this->heart_count = $this->greeting->heart_count;
    }

}; ?>

<div>
    <x-button xs wire:click='increaseHeartCount' rose icon="heart" spinner>{{$heart_count}}</x-button>
</div>

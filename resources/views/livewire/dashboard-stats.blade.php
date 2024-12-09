<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(){
        return [
            'greetings_total' => Auth::user()->greetings()->count(),
            'heart_total' => Auth::user()->greetings->sum('heart_count'),
            'greetings_to_be_sent' => Auth::user()->greetings()->where('send_date', '>', now())->count(),
            'greetings_sent' => Auth::user()->greetings()->where('send_date', '<=', now())->count()
        ];
    }
}; ?>

<div>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-2">
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items center">
                <div>
                    <p class="text-lg font-medium leading-6 text-gray-900">Total Greetings:</p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">{{$greetings_total}}</p>
            </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items center">
                <div>
                    <p class="text-lg font-medium leading-6 text-gray-900">Hearts earned:</p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">{{$heart_total}}</p>
            </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items center">
                <div>
                    <p class="text-lg font-medium leading-6 text-gray-900">Greetings to be sent:</p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">{{$greetings_to_be_sent}}</p>
            </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items center">
                <div>
                    <p class="text-lg font-medium leading-6 text-gray-900">Greetings sent:</p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">{{$greetings_sent}}</p>
            </div>
        </div>
    </div>
</div>

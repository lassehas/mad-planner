<div class="">
    <div class="flex flex-col justify-center items-center gap-3 p-6">
        @foreach ($week_plans as $week_plan)
            <div>
                <button wire:click="show({{ $week_plan->id }})" class="w-44 py-2 border-2 rounded-lg">{{ $week_plan->name }}</button>
            </div>
        @endforeach
    </div>
    <div class="fixed bottom-16 right-6">
        <button wire:click="create" class="bg-green-500 text-white p-4 rounded-full shadow-lg flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
    </div>
</div>

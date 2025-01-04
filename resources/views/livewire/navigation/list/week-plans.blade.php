<div>
    @foreach ($week_plans as $week_plan)
        <div>
            {{ $week_plan->name }}
            <button wire:click="show({{ $week_plan->id }})">Vis</button>
        </div>
    @endforeach
</div>

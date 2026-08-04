<?php

use Livewire\Component;
use App\Models\Amenity;
use Livewire\Attributes\Validate;

new class extends Component
{
    #[Validate('required|string|max:100')]
    public $name = '';

    #[Validate('required|string|max:50')]
    public $icon_key = '';

    public function submit(){
        $this->validate();

        Amenity::create([
            'name' => $this->name,
            'icon_key' => $this->icon_key
        ]);

        session()->flash('success', 'Amenity created successfully!');

        return $this->redirect(route('amenities.index'));

    }
};
?>

<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <flux:heading size="xl">{{ __('Add Amenity') }}</flux:heading>
            <flux:button href="{{ route('amenities.index') }}">
                <flux:icon.arrow-left />
                {{ __('Back') }}
            </flux:button>
        </div>

        <form wire:submit="submit" method="POST">
            @csrf
            <div class="flex gap-4 items-start">
                <flux:field class="flex-1">
                    <flux:label for="name">{{ __('Name') }}</flux:label>
                    <flux:input wire:model.live.blur="name" id="name" type="text" name="name" placeholder="{{ __('Enter amenity name') }}" />
                    @error('name')
                        <flux:text class="text-red-500">{{ $message }}</flux:text>
                    @enderror
                </flux:field>

                <flux:field class="flex-1">
                    <flux:label for="icon_key">{{ __('Icon Key') }}</flux:label>
                    <flux:input wire:model.live.blur="icon_key" id="icon_key" type="text" name="icon_key" placeholder="{{ __('Enter icon key') }}" />
                    @error('icon_key')
                        <flux:text class="text-red-500">{{ $message }}</flux:text>
                    @enderror
                    <flux:text>
                        {{ __('You can find the icon key from the icon library of ') }}
                        <flux:link href="https://heroicons.com" target="_blank">Heroicons</flux:link>
                    </flux:text>
                </flux:field>
            </div>

            <flux:button type="submit" variant="primary" class="mt-4 cursor-pointer">
                {{ __('Submit') }}
            </flux:button>
        </form>
    </div>
</div>

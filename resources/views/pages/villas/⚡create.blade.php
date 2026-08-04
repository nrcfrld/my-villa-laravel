<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Amenity;

new class extends Component
{
    public $name = ''; // Villa Bogor
    public $slug = ''; // villa-bogor
    public $short_description = '';
    public $base_price_idr = '';
    public $max_occupants_pax = '';
    public $bedrooms = '';
    public $bathrooms = '';
    public $area_sqm = '';
    public $location_district = '';
    public $google_maps_url = '';

    public $selectedAmenities = [1, 2];

    #[Computed]
    public function amenities(){
        return Amenity::all();
    }

    public function save(){
        // Create a new villa record

        // Create VillaAmenity
        foreach($this->selectedAmenities as $amenityId){
            // Create a new VillaAmenity record
            \App\Models\VillaAmenity::create([
                'villa_id' => $villa->id,
                'amenity_id' => $amenityId
            ]);
        }
    }
};
?>

<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <flux:heading size="xl">{{ __('Add Villa') }}</flux:heading>
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
                    <flux:input wire:model.live.blur="name" id="name" type="text" name="name" placeholder="{{ __('Enter villa name') }}" />
                    @error('name')
                        <flux:text class="text-red-500">{{ $message }}</flux:text>
                    @enderror
                </flux:field>

                <flux:field class="flex-1">
                    <flux:label for="slug">{{ __('Slug') }}</flux:label>
                    <flux:input wire:model.live.blur="slug" id="slug" type="text" name="slug" placeholder="{{ __('Enter villa slug') }}" />
                    @error('slug')
                        <flux:text class="text-red-500">{{ $message }}</flux:text>
                    @enderror
                </flux:field>
            </div>

            <div class="flex gap-4 mt-4 items-start">
                {{-- Amenities --}}
                <flux:field class="flex-1">
                    <flux:label for="amenities">{{ __('Amenities') }}</flux:label>
                    @foreach ($this->amenities as $amenity)
                        <fieldset class="flex items-center gap-2">
                            <flux:checkbox wire:model.live="selectedAmenities" id="amenity-{{ $amenity->id }}" value="{{ $amenity->id }}" />
                            <flux:label for="amenity-{{ $amenity->id }}">{{ $amenity->name }}</flux:label>
                        </fieldset>
                    @endforeach
                </flux:field>

                {{ print_r($selectedAmenities) }}
            </div>


            <flux:button type="submit" variant="primary" class="mt-4 cursor-pointer">
                {{ __('Submit') }}
            </flux:button>
        </form>
    </div>
</div>

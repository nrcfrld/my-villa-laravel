<x-layouts::app :title="__('Edit Amenity')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <flux:heading size="xl">{{ __('Edit Amenity') }}</flux:heading>
            <flux:button href="{{ route('amenities.index') }}">
                <flux:icon.arrow-left />
                {{ __('Back') }}
            </flux:button>
        </div>

        <form action="{{ route('amenities.update', $data->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="flex gap-4 items-start">
                <flux:field class="flex-1">
                    <flux:label for="name">{{ __('Name') }}</flux:label>
                    <flux:input value="{{ $data->name }}" id="name" type="text" name="name" placeholder="{{ __('Enter amenity name') }}" />
                    @error('name')
                        <flux:text class="text-red-500">{{ $message }}</flux:text>
                    @enderror
                </flux:field>

                <flux:field class="flex-1">
                    <flux:label for="icon_key">{{ __('Icon Key') }}</flux:label>
                    <flux:input value="{{ $data->icon_key }}" id="icon_key" type="text" name="icon_key" placeholder="{{ __('Enter icon key') }}" />
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
</x-layouts::app>

<x-layouts::app :title="__('Amenities')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <flux:heading size="xl">{{ __('Amenities') }}</flux:heading>
            <flux:button href="{{ route('amenities.create') }}">
                <flux:icon.plus />
                {{ __('Add New') }}
            </flux:button>
        </div>


        @if (session('success'))
            <div class="px-3 py-2 rounded-lg bg-green-100 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <flux:table :paginate="$data">
            <flux:table.columns>
                <flux:table.column> ID </flux:table.column>
                <flux:table.column> Name </flux:table.column>
                <flux:table.column> Icon Key </flux:table.column>
                <flux:table.column> Action </flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($data as $amenity)
                    <flux:table.row>
                        <flux:table.cell> {{  $amenity->id }} </flux:table.cell>
                        <flux:table.cell> {{  $amenity->name }} </flux:table.cell>
                        <flux:table.cell>
                            {{ $amenity->icon_key }}
                            @php
                                $isValid = Flux::componentExists('icon.' . $amenity->icon_key);
                            @endphp

                            @if ($isValid)
                                <flux:icon class="inline" icon="{{ $amenity->icon_key }}" />

                            @else
                                <span class="text-red-500">Invalid Icon Key</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button href="{{ route('amenities.edit', $amenity->id) }}" size="sm">
                                <flux:icon.pencil class="size-4" />
                             </flux:button>
                            <form class="inline" action="{{ route('amenities.destroy', $amenity->id) }}" method="post">
                                @csrf
                                @method("delete")
                                <flux:button size="sm" type="submit" variant="danger" onClick="return confirm('Are you sure you want to delete this amenity?')">
                                    <flux:icon.trash class="size-4" />
                                </flux:button>
                            </form>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
</x-layouts::app>

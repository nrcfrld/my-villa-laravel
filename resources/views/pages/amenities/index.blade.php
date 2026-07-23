<x-layouts::app :title="__('Amenities')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <flux:heading size="xl">{{ __('Amenities') }}</flux:heading>
            <flux:button href="{{ route('amenities.create') }}">
                <flux:icon.plus />
                {{ __('Add New') }}
            </flux:button>
        </div>

        {{-- TODO : 2. Show Success Alert --}}

        <flux:toast position="bottom right" />


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
                        {{-- TODO : 1. Error Handling Display Dynamic Icons --}}
                        <flux:table.cell> {{  $amenity->icon_key }} <flux:icon class="inline" name="{{  $amenity->icon_key }}"  /> </flux:table.cell>
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

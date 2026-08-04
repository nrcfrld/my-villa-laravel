<?php

use Livewire\Component;
use App\Models\Amenity;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

new class extends Component
{
    use WithPagination;

    #[Computed]
    public function amenities()
    {
        // Build the query at render-time so the paginator is not stored on component state
        return Amenity::orderBy('id')->paginate(10);
    }

    public function mount()
    {
        if(session('success')){
            // Flux::toast('Amenity created successfully!', '✅ Success');
            Flux::toast(variant: 'success', text : "Amenity created successfully!", heading: "Success");
        }
    }

    public function delete($id){
        $amenity = Amenity::findOrFail($id);

        $amenity->delete();

        Flux::toast(variant: 'success', text : "Amenity deleted successfully!", heading: "Success");

        Flux::modal('delete-amenity-' . $id)->close();
    }

};
?>

<div>
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <flux:heading size="xl">{{ __('Amenities') }}</flux:heading>
            <flux:button href="{{ route('amenities.create') }}">
                <flux:icon.plus />
                {{ __('Add New') }}
            </flux:button>
        </div>

        <flux:table>
            <flux:table.columns>
                <flux:table.column> ID </flux:table.column>
                <flux:table.column> Name </flux:table.column>
                <flux:table.column> Icon Key </flux:table.column>
                <flux:table.column> Action </flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($this->amenities as $amenity)
                    <flux:table.row>
                        <flux:table.cell> {{  $amenity->id }} </flux:table.cell>
                        <flux:table.cell> {{  $amenity->name }} </flux:table.cell>
                        <flux:table.cell>
                            {{ $amenity->icon_key }}

                            @php
                                $iconKey = trim((string) $amenity->icon_key);
                                $isValid = $iconKey !== '' && \Flux\Flux::componentExists('icon.' . $iconKey);
                            @endphp

                            @if ($isValid)
                                <flux:icon class="inline" :name="$iconKey" />
                            @else
                                <flux:icon class="inline text-zinc-400" name="layout-grid" />
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button href="{{ route('amenities.edit', $amenity->id) }}" size="sm">
                                <flux:icon.pencil class="size-4" />
                             </flux:button>

                             <flux:modal.trigger name="delete-amenity-{{ $amenity->id }}">
                                <flux:button size="sm" variant="danger">
                                    <flux:icon.trash class="size-4" />
                                </flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-amenity-{{ $amenity->id }}" class="min-w-[22rem]">
                                <div class="space-y-6">
                                    <div>
                                        <flux:heading size="lg">Delete Amenity?</flux:heading>
                                        <flux:text class="mt-2">
                                            You're about to delete this amenity.<br>
                                            This action cannot be reversed.
                                        </flux:text>
                                    </div>
                                    <div class="flex gap-2">
                                        <flux:spacer />
                                        <flux:modal.close>
                                            <flux:button variant="ghost">Cancel</flux:button>
                                        </flux:modal.close>
                                        <flux:button wire:click="delete({{ $amenity->id }})" type="submit" variant="danger">Delete amenity</flux:button>
                                    </div>
                                </div>
                            </flux:modal>


                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>

        {{ $this->amenities->links() }}
    </div>
</div>

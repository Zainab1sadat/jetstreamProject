<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer mt-5 w-full font-semibold text-lg text-white" wire:click.prevent="create()">create Todo</button>
            @if($UpdatePost)
            @include('livewire.todo-list-create')
            @endif

        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
            <h1 class="font-semibold text-xl text-gray-900 leading-tight mb-4 text-center">Todo Lists</h1>
            <div class="text-center my-6">

                @include('livewire.todo-list-search')
            </div>
            <div class="card ">
                <div class="card-body py-6">
                    @foreach($todos as $todo)
                    @include('livewire.todo-list-card')
                    @endforeach
                </div>
            </div>
            {{$todos->links()}}
        </div>
    </div>
</div>
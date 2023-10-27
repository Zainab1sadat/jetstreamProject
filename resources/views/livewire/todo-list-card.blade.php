<div wire:key="{{$todo->id}}" class="flex justify-between">
    <div>
        <h3 class=" text-xl text-semibold  text-gray-900 leading-tight">{{$todo->name}}</h3>
        <span class="mt-6 text-gray-500 leading-relaxed">{{$todo->created_at->DiffForhumans()}}</span>
    </div>
    <div class="float-right flex">

        <x-button wire:click="edit({{$todo->id}})" type="submit" class="flex px-4 py-2 bg-gray-900 text-gray-900 cursor-pointer mt-5">edit</x-button>

        <x-danger-button wire:click="delete({{$todo->id}})" class="flex px-4 py-2 bg-gray-900 text-gray-900 cursor-pointer mt-5">Delete</x-danger-button>
    </div>
</div>
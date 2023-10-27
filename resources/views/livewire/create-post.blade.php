<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Post') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
        <div class="col-sm-6 text-end">
            <x-button wire:click="confirmPostAdd" class="mb-6 w-full">
                Add item
            </x-button>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8">
            <table class="table w-full p-5 m-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <div wire:key="{{$post->id}}">
                        <tr class="text-center">
                            <td>{{$post->id}}</td>
                            <td>{{$post->name}}</td>
                            <td>{{$author}}</td>
                            <td>{{$post->price}}</td>
                            <td>{{$post->status ? 'Active' : 'Not-Active'}}</td>
                            <td>
                                <x-danger-button wire:click="delete({{$post->id}})" wire:loading.attr="disabled">
                                    Delete
                                </x-danger-button>


                            </td>
                        </tr>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">

            {{$posts->links()}}
        </div>
    </div>
    <!-- Add User Confirmation Modal -->
    <x-dialog-modal wire:model.live="confirmingPostAdd">
        <x-slot name="title">
            Add Post
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="price" value="{{ __('Price') }}" />
                <x-input id="price" type="number" class="mt-1 block w-full" wire:model="price" required />
                <x-input-error for="price" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label class="flex items-center" />
                <x-input type="checkbox" wire:model.defer="status" class="form-checkbox" />
                <span class="ml-2 text-sm">Active</span>
                <x-input-error for="status" class="mt-2" />

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingPostAdd',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <form>
                <x-danger-button type="submit" wire:click.prevent="savePost" class="ml-3" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-danger-button>
            </form>

        </x-slot>
    </x-dialog-modal>
</div>
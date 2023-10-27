<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;

class CreatePost extends Component
{
    #[Layout('layouts.app')]
    #[Title('Create Post')]
    #[Rule(
        'required'
    )]
    public $name, $price, $status;
    public $post;

    public $confirmingPostAdd = false;

    protected $rules = [
        'name' => 'required',
        'price' => 'required|number',
        'status' => 'boolean'
    ];
    public function render()
    {
        $post = Post::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('livewire.create-post', [
            'posts' => $post,
        ])->with([
            'author' => Auth::user()->name
        ]);
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Studen deleted.');
        return redirect(request()->header('Referer'));
    }
    public function confirmPostAdd()
    {
        $this->reset(['post']);
        $this->confirmingPostAdd = true;
    }
    public function savePost()
    {
        $this->validate();
        auth()->user()->posts()->create([
            'name' => $this->name,
            'price' => $this->price,
            'status' => $this->status ?? 0
        ]);
       
        $this->confirmingPostAdd = false;
        return redirect(request()->header('Referer'));
    }
}

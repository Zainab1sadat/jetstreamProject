<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    #[Layout('layouts.app')]

    #[Rule('required')]
    public $name, $todo_id;
    public $search;

    public $UpdatePost = 0;

    public function openModalPopover()
    {
        $this->UpdatePost = true;
    }
    public function closeModalPopover()
    {
        $this->UpdatePost = false;
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    private function resetCreateForm()
    {
        $this->name = '';
    }

    public function delete(Todo $todo)
    {
        $todo->delete();
    }

    public function edit($id)
    {

        $todo = Todo::findOrfail($id);
        $this->todo_id = $todo->id;
        $this->name = $todo->name;

        $this->openModalPopover();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Todo::updateOrCreate(['id' => $this->todo_id], [
            'name' => $this->name,
        ]);
        $this->closeModalPopover();
        $this->resetCreateForm();
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(4)
        ]);
    }
}

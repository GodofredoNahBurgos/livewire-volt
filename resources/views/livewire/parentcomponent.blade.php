<?php

use Livewire\Volt\Component;

use App\Models\Employee;

new class extends Component {

    public $message;

    public $employees;

    public function mount()
    {
        $this->employees = Employee::all();   
        $this->message = "Hola desde el componente padre.";
    }
    
}; ?>

<div>
    <h1>Componente Padre</h1>

    <h1>{{$message}}</h1>

    <hr>         

    @foreach ($employees as $employee)
    @livewire('childcomponent', [
        'employee' => $employee,
        'message' => $message 
        ], key($employee->id)) 
    @endforeach

    {{-- @livewire('child-component', ['message' => $message])
    {{now()}} --}}
    {{-- Refresca solo el componente donde este $refresh --}}
    {{-- <button wire:click="$refresh">Refresh</button> --}}
</div>

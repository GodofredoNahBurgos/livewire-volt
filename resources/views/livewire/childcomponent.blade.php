<?php

use Livewire\Volt\Component;
use App\Models\Employee;
use Illuminate\Contracts\Database\ModelIdentifier;

new class extends Component {
    public $message = "Hola desde el componente hijo.";
    public $employee;

    public function mount(Employee $employee, string $message = null)
    {
        $this->employee = $employee;
        $this->message = $message;
    }
}; ?>

<div>
    <h1>Componente Hijo</h1>
    <h1>{{$message}}</h1>
    <h1>Nombre: {{$employee->name}} {{now()}}</h1>
    <h1>Correo: {{$employee->email}} {{now()}}</h1>
    {{-- Refresca el componente. --}}
    <button wire:click="$refresh">Refresh</button>
</div>

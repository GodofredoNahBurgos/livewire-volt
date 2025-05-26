<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\User;

new class extends Component {
    
    /* Propiedades publicas. Aceptan todo tipo de datos.*/
    public $message = "Probando el componente";

    /* public $message; */
    public $funciona = false;

    public $counter = 0;

    public function add($counterParameter) {
        return $this->counter+= $counterParameter;        
    }

    public function store(){
        return $this->counter = 20;
    }

    /* public $message: = "Hola Mundo"; */

    /* Esta funcion de puede chacer con magic actions. */
    /* public function changeMessage($value){
        return $this->message = $value;
    } */

    public $mostrar = true;

    public $state;

    public function changeState($value){
        $this->state = $value;
    }

    /* Lifecicle Hooks */

    /* 
    Initial Requets

    <livewire:component>
    mount() Solo corre una vez antes del render
    render()
    dehydrate() interpreta las variables y funciones y manda las vistas

    Subsequent Request

    hydrate() desde uestra vista lo interpreta para php o las funciones y los procesa
    increment()
    render()
    dehydrate()
    */

    /* mount se ejecuta antes que el render. */
    /* public $categories; */

    /* public function mount()
    {
        $this->message = 'Otro nombre';
        $this-categories = Category::all();    
    } */
   
    /* 
    
    public $count = 1;

    public function increment()
    {
        $this->count++;   
    } */

    public $name = "Inicial Name";
    public $count = 0;

    public function mount(){
        /* $this->name = "Godofredo Nah"; */
        $this->count++;
    }

/*     public function hydrate(){
        $this->count++;
    } */

    public function updated(){
        $this->count++;
    }

    public function updateName($name){
        $this->name = $name;
    }

    /* public $name; */
    public $email;
    public $user;

    /* Listeners */
    /* protected $listeners = ['resetForm' => 'resetData']; */

    public function save()
    {
        $this->dispatch('success');
    }

    /* Podemos recibir parametros con eventos. */
    
    #[On('resetForm')]
    public function resetData(User $user)
    {
        /* Reinicia el componente. */
        $this->reset();
        $this->user = $user;
    }

}; ?>

<div>

    <hr>

    <h1>{{$message}}</h1>

    {{-- Asociamos wire:model con la variable, lo que ingresamos lo renderiza arriba. --}}
    {{-- A esto se le llama Data Binding --}}

    {{-- Agregar lazy impite que se hagan muchas peticiones. --}}
    {{-- <input type="text" wire:model.lazy="message" > --}}

    {{-- Hace peticion cada determinados segundos. --}}
    {{-- <input type="text" wire:model.debounce.5s="message" > --}}

    {{-- No lo solicita hasta que algo desencadene que se envie la data. --}}
    {{-- <input type="text" wire:model.debounce.defer="message" >
    <button class="btn btn-success">Enviar</button> --}}

    <input type="checkbox" wire:model.lazy="funciona" id="">
    <h1>{{$funciona ? 'True' : 'False'}}</h1>

    <hr>
    <h1>Contador</h1>
    <h1>{{$counter}}</h1>

    <flux:button wire:click="add(2)">Agregar</flux:button>
    {{-- Ejecuta la funcion cuando pasan el mause. --}}
    {{-- <button wire:mouseover="add(2)" class="btn btn success">Agregar</button> --}}

    {{-- .prevent Para evitar el comportamiento que tiene el form por default --}}
    <form wire:submit.prevent="store">
        <flux:button type="submit">Agregar + 20</flux:button>
    </form>

    {{-- <h1>{{$message}}</h1> --}}

    @if ($mostrar)
    <div>
        <h1>Nuevo Div</h1>
    </div>        
    @endif

    {{-- Recibe la variable y el valor Magic Actions. --}}
    <button wire:click="$set('message', 'Usando magic actions.')">
        Cambiar Nombre
    </button>

    {{-- Toggle estara alternando entre false y true --}}
    <button wire:click="$toggle('mostrar')">
        Agregar Div
    </button>

    <div>Estado: {{$state}}</div>

    <select wire:change="changeState($event.target.value)">
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
    </select>

    {{-- Lifecyce Hooks - Metodos que actuan con el ciclo de vida del componente no de las variables. --}}

    {{-- <h1>{{$name}}</h1>
    <h2>Counter: {{$count}}</h2> --}}

    {{-- Probaremos aca el updated. --}}
    <h1>Cambiaremos a batman: </h1>
    <input type="text" wire:model="name" />

    <button wire:click="updateName('Batman')">Aumentar</button>

    <form wire:submit.prevent="save">

        <label>Nombre: </label>
        <flux:input wire:model="name" />

        <label>Email:</label>
        <flux:input type="email" wire:model="email" />

        <flux:button type="submit">Guardar</flux:button>
        {{-- Se puede hacer con funciones. --}}
        {{-- Se le puede pasar parametros. --}}
        <flux:button wire:click="$dispatch('resetForm', { user: {{auth()->user()->id}} })" type="button">Limpiar</flux:button>        
    </form>

</div>

@script
<script>
    Livewire.on('success', event => {
        Swal.fire({
  title: 'Registro Exitoso',
  icon: 'success'
})
    });
</script>
@endscript
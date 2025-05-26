<?php

use Livewire\Volt\Component;
use App\Models\Employee;
use App\Models\Category;

/* Validacion en tiepo real. */
use Livewire\Attributes\Validate;

new class extends Component {

    #[Validate] 
    public $name;
    public $email;
    public $category_id;   
    public $categories;
    public $message;

    protected $rules = [
        'name' => ['required', 'min:5', 'max:255'],
        'email' => ['required', 'email'],
        'category_id' => ['required', 'integer']
    ];

    protected $messages = [
        'name.required' => 'El nombre es requerido.',
        'email.required' => 'El correo es requerido.',
        'email.email' => 'El correo es invalido.'
];

public function mount()
{
    $this->categories = Category::all();
}

    public function save()
    {
        $validationData = $this->validate();

        /* Employee::create([
            'name' => $this->name,
            'email' => $this->email
        ]);   */
        
        Employee::create($validationData);

        return redirect()->route('products.index')->with('success', 'Registro exitoso.');

    }

    public function updated()
    {
        
    }

}; ?>

<div>
    <h1>Componente Create</h1>

    <form wire:submit.prevet="save" class="border p-2">
    <label for="">Nombre</label>
    <input type="text" wire:model="name" class="border p-2 m-2">
    <div class="text-red-600">@error('name') {{ $message }} @enderror</div>
 
    <label for="">Correo</label>
    <input type="text" wire:model.blur="email" class="border p-2 m-2">
    <div class="text-red-600">@error('email') {{ $message }} @enderror</div>

    <div wire:ignore>
        <flux:select size="sm" class="p-2 m-2 select2" wire:model="category_id" placeholder="Elige una categoria...">
            @foreach ($categories as $category)
            <flux:select.option value="{{$category->id}}">{{$category->name}}</flux:select.option>
            @endforeach
        </flux:select>
    </div>
    
    <flux:button type="submit">Guardar</flux:button>
</form>

</div>

<script>
    $(document).ready(function(){
        $('.select2').select2()
    })
    $('.select2').on('change', function(){
        $this.set('category_id', $(this).val())
    })
</script>
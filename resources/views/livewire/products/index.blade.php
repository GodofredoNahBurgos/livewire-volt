<?php

use Livewire\Volt\Component;
use App\Models\Employee;
use App\Models\Category;
/* Para paginar */
use Livewire\WithPagination;

new class extends Component {

  use WithPagination;

  public function getEmployeesProperty()
    {
        return Employee::paginate(5);
    }

    public function mount()
    {
       
    }
      
};

?>

<div>
    <h1>Componente Index</h1>

    {{-- Pasar esto arriba --}}
    {{-- @php
        $employees = Employee::paginate(5);
    @endphp --}}
    
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif

    <flux:button href="products/create">Nuevo Producto</flux:button>

    <table class="w-full border-collapse border border-gray-400 ...">
  <thead>
    <tr>
      <th class="border border-gray-300 ...">Nombre</th>
      <th class="border border-gray-300 ...">Correo</th>
      <th class="border border-gray-300 ...">Categoria</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($this->employees as $employee)
    <tr>
      <td class="border border-gray-300 ...">{{$employee->name}}</td>
      <td class="border border-gray-300 ...">{{$employee->email}}</td>
      <td class="border border-gray-300 ...">{{Category::find($employee->category_id)->name}}</td>
    </tr>
    @endforeach
  
  </tbody>
</table>

{{ $this->employees->links() }}

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
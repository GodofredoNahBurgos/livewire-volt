<?php

use Livewire\Volt\Component;
use App\Models\File;

new class extends Component {

    public $files;

    public function mount()
    {
        $this->files = File::all();
    }

}; ?>

<div>

    <h1>Imagenes</h1>

    <flux:button href="files/create">Nueva Imagen</flux:button>

    <table class="w-full border-collapse border border-gray-400 ...">
  <thead>
    <tr>
      <th class="border border-gray-300 ...">Archivo</th>
      <th class="border border-gray-300 ...">Extension</th>
      <th class="border border-gray-300 ...">Ruta</th>
      <th class="border border-gray-300 ...">Previsualización</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($this->files as $file)
    <tr>
      <td class="border border-gray-300 ...">{{$file->file_name}}</td>
      <td class="border border-gray-300 ...">{{$file->file_extension}}</td>
      <td class="border border-gray-300 ...">{{$file->file_path}}</td>
      <td class="border border-gray-300 ...">
        @if ($file->file_extension == 'pdf')
        <a href="{{asset($file->file_path)}}" target="_blank">Ver Archivo</a>
        @else 
        <img src="{{asset($file->file_path)}}" width="150" height="150" class="img-fliud"></img>    
        @endif
      </td>
    </tr>
    @endforeach
  
  </tbody>
</table>
</div>

<?php

use Livewire\Volt\Component;
use App\Models\File;
/* Para trabajar con archivos. */
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    /* public $file; */

    public $files = [];

    protected $rules = [
        /* 'file' => ['required', 'mimes:pdf,png,jpg,jpeg'] */
        'files.*' => ['required', 'mimes:pdf,png,jpg,jpeg']
    ];
    
    public function save()
    {
        $this->validate();

        foreach ($this->files as $key => $file) {
        $file_save = new File();
        $file_save->file_name = $file->getClientOriginalName();
        $file_save->file_extension = $file->extension();
        /* Si no existe la carpeta files la crea en el directorio public. */
        $file_save->file_path = 'storage/'.$file->store('files', 'public');        
        $file_save->save();
        }
        /* $file_save = new File();
        $file_save->file_name = $this->file->getClientOriginalName();
        $file_save->file_extension = $this->file->extension(); */
        /* Si no existe la carpeta files la crea en el directorio public. */
        /* $file_save->file_path = 'storage/'.$this->file->store('files', 'public');        
        $file_save->save();
 */
        return redirect()->route('files.index');
    }
}; ?>

<div>
    <h1>Componente de Creacion</h1>

    <form wire:submit.prevent="save">
        {{-- <flux:input type="file" wire:model="file" label="Archivo"/> --}}
        {{-- Multiple --}}
        <flux:input type="file" wire:model="files" label="Archivo" multiple/>
        {{-- Solo si no es pdf --}}
        @if ($files)
        <h3>Prevista</h3>
        @foreach ($files as $file)
        <img src="{{$file->temporaryURL()}}" height="200" width="200" class="img-fliud">
        @endforeach
        @endif
        <flux:button type="submit">Guardar Archivo</flux:button>
    </form>
</div>

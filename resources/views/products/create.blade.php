@extends('layouts.app')

@section('title', 'Nuevo Producto')

@section('content')
    <div class="page-header">
        <a href="{{ route('products.index') }}" class="btn-flat waves-effect" style="margin-bottom: 16px;">
            <i class="material-icons left">arrow_back</i>
            Volver a Productos
        </a>
        <h4>
            <i class="material-icons">add_box</i>
            Nuevo Producto
        </h4>
    </div>

    <div class="row">
        <div class="col s12 l8 offset-l2">
            <div class="card animate-fade-in">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <h5
                                    style="font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                                    <i class="material-icons" style="color: var(--primary-color);">info</i>
                                    Información del Producto
                                </h5>
                            </div>

                            <div class="col s12">
                                <div class="input-field">
                                    <i class="material-icons prefix">label</i>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                                    <label for="name">Nombre del Producto</label>
                                    @error('name')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12">
                                <div class="input-field">
                                    <i class="material-icons prefix">description</i>
                                    <textarea id="description" name="description" class="materialize-textarea"
                                        style="min-height: 100px;">{{ old('description') }}</textarea>
                                    <label for="description">Descripción</label>
                                    @error('description')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12 m6">
                                <div class="input-field">
                                    <i class="material-icons prefix">attach_money</i>
                                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01"
                                        min="0" required>
                                    <label for="price">Precio</label>
                                    @error('price')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12" style="margin-top: 20px;">
                                <h5
                                    style="font-weight: 600; margin-bottom: 16px; display: flex; align-items: center; gap: 12px;">
                                    <i class="material-icons" style="color: var(--primary-color);">image</i>
                                    Imagen del Producto
                                </h5>

                                <div id="image-preview" style="display: none; margin-bottom: 20px;">
                                    <img id="preview-img" src="" alt="Preview"
                                        style="max-width: 100%; max-height: 300px; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
                                </div>

                                <div class="file-field input-field">
                                    <div class="btn blue waves-effect waves-light">
                                        <span><i class="material-icons left">cloud_upload</i>Subir</span>
                                        <input type="file" name="image" id="image-input" accept="image/*">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Seleccionar imagen">
                                    </div>
                                </div>
                                @error('image')
                                    <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                @enderror
                                <p style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 8px;">
                                    <i class="material-icons tiny" style="vertical-align: middle;">info</i>
                                    Formatos: JPG, PNG, GIF, WebP. Máximo 2MB.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-action" style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('products.index') }}" class="btn-flat waves-effect">Cancelar</a>
                        <button type="submit" class="btn waves-effect waves-light blue">
                            <i class="material-icons left">save</i>
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('image-input').addEventListener('change', function (e) {
                const preview = document.getElementById('image-preview');
                const previewImg = document.getElementById('preview-img');

                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.style.display = 'none';
                }
            });
        </script>
    @endpush
@endsection
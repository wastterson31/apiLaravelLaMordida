@csrf

<!-- name -->
<div>
    <label class="form-label" for="name">Nombre:</label>
    <input class="form-control" type="text" name="name" id="name" placeholder="Ingrese el nombre"
        value="{{ old('name', optional($category)['name']) }}"
        @error('name')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror </div>


    <!-- Selección de imagen -->
    <div>
        <label class="form-label" for="image">Seleccionar imagen:</label>
        <input class="form-control" type="file" name="image" id="image" accept="image/*">
        @error('image')
            <div class="text-small text-danger">{{ $message }}</div>
        @enderror
    </div>

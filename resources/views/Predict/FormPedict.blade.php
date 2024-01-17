@csrf
<!-- category -->
<div>
    <label class="form-label" for="category_id">Categoría:</label>
    <select class="form-control" name="category_id" id="category_id">
        <option value="0" selected>Seleccione una categoría </option>
        <!-- old() función que obtiene el valor anterior en la recarga de un formulario
            o el valor asignado  -->
        @isset($categories)
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @isset($product)
                        @selected(old('category_id', $product) == $category->id)
                    @else
                        @selected(old('category_id', $product) == $category->id)
                    @endisset>
                    {{ $category->name }}
                </option>
            @endforeach
        @endisset
    </select>
    @error('category_id')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>
<!-- name -->
<div>
    <label class="form-label" for="name">Nombre:</label>
    <input class="form-control" type="text" name="name" id="name" placeholder="Ingrese el nombre"
        value="">
    @error('name')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Formulario de descripción del producto -->
<div>
    <label class="form-label" for="description">Descripción del producto:</label>
    <input class="form-control" type="text" name="description" id="description"
        placeholder="Ingrese la descripción del producto" value="{{ old('description', $product) }}">
    @error('description')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- price -->
<div>
    <label class="form-label" for="price">Precio:</label>
    <input class="form-control" type="number" name="price" id="price" placeholder="Ingrese el Precio"
        value="{{ old('price', $product) }}">
    @error('price')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Selección de imagen -->
<div>
    <label class="form-label" for="image">Seleccionar imagen:</label>
    <input class="form-control" type="file" name="image" id="image" accept="image/*">
    @error('image')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- discount -->
<div>
    <label class="form-label" for="discount">Descuento:</label>
    <input class="form-control" type="number" name="discount" id="discount" value="{{ old('discount', $product) }}"
        placeholder="Ingrese un descuento">
    @error('discount')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

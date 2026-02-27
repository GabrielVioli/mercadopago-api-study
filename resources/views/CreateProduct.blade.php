<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo produto</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Produto</h1>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('produto.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Nome do Produto</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">Quantidade</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}">
                @error('quantity')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="unit_price">Preço Unitário</label>
                <input type="number" step="0.01" name="unit_price" id="unit_price" value="{{ old('unit_price') }}">
                @error('unit_price')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Salvar Produto</button>
        </form>
    </div>
</body>
</html>
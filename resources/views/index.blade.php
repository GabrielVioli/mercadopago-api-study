<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>

    <div>
        <h1>comprar Produto</h1>

        <form action="{{route('checkout.process')}}" method="post">
            @csrf

            <div>
                <label for="title">Título</label>
                <input type="text" name="title" id="title" required>
            </div>

            <br>

            <div>
                <label for="quantity">Quantidade</label>
                <input type="number" name="quantity" id="quantity" min="1" required>
            </div>

            <br>

            <div>
                <label for="unit_price">Preço Unitário</label>
                <input type="number" name="unit_price" id="unit_price" step="0.01" min="0" required>
            </div>

            <br>

            <button type="submit">Enviar</button>
        </form>
    </div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>

    
</body>
</html>



@if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mechanic.store') }}" method="POST">
        @csrf
        <div>
            <label for="ProductName">Name:</label>
            <input type="text" name="ProductName" id="ProductName" required>
        </div>
        <div>
            <label for="Description">Description:</label>
            <textarea name="Description" id="Description"></textarea>
        </div>
        <div>
            <label for="Price">Price:</label>
            <input type="text" name="Price" id="Price" required>
        </div>
        <div>
            <label for="Inventory">Inventory:</label>
            <input type="text" name="Inventory" id="Inventory" required>
        </div>
        <button type="submit">Add Product</button>
    </form>
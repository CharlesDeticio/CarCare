
<!DOCTYPE html>
<html>
<head>
    <title>Add Service</title>
</head>
<body>
    <h1>Add Service</h1>

    
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

    <form action="{{ route('mechanic.storage') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" required>
        </div>


        <button type="submit">Add Service</button>
    </form>
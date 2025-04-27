<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #4361ee;
      --primary-dark: #3a56d4;
      --secondary: #3f37c9;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --light-gray: #e9ecef;
      --success: #4bb543;
      --danger: #dc3545;
      --warning: #ffc107;
      --border-radius: 8px;
      --box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      --transition: all 0.3s ease;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f7ff;
      color: var(--dark);
      line-height: 1.6;
    }
    
    /* Header */
    header {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 1.5rem;
      text-align: center;
      box-shadow: var(--box-shadow);
      position: relative;
    }
    
    header h1 {
      font-weight: 600;
      font-size: 1.8rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
    }
    
    /* Main Container */
    .main-container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 0 1rem;
    }
    
    /* Card */
    .card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      overflow: hidden;
      margin-bottom: 2rem;
    }
    
    .card-header {
      padding: 1.25rem 1.5rem;
      border-bottom: 1px solid var(--light-gray);
      background-color: #f8f9fa;
    }
    
    .card-header h2 {
      font-size: 1.4rem;
      font-weight: 600;
      color: var(--primary);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .card-body {
      padding: 1.5rem;
    }
    
    /* Error Messages */
    .alert-danger {
      background-color: #f8d7da;
      color: var(--danger);
      padding: 1rem;
      border-radius: var(--border-radius);
      margin-bottom: 1.5rem;
      border-left: 4px solid var(--danger);
    }
    
    .alert-danger ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }
    
    .alert-danger li {
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .alert-danger li::before {
      content: "⚠️";
    }
    
    /* Form Styles */
    .form-group {
      margin-bottom: 1.25rem;
      position: relative;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--dark);
    }
    
    .form-control {
      width: 100%;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      border: 1px solid var(--light-gray);
      border-radius: var(--border-radius);
      transition: var(--transition);
      background-color: #f8f9fa;
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
      background-color: white;
    }
    
    textarea.form-control {
      min-height: 120px;
      resize: vertical;
    }
    
    /* File Input */
    .file-input-wrapper {
      position: relative;
      overflow: hidden;
      display: inline-block;
      width: 100%;
    }
    
    .file-input-wrapper input[type="file"] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    
    .file-input-label {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0.75rem 1rem;
      background-color: var(--light);
      border: 2px dashed var(--gray);
      border-radius: var(--border-radius);
      color: var(--gray);
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition);
    }
    
    .file-input-label:hover {
      border-color: var(--primary);
      color: var(--primary);
    }
    
    .file-input-label i {
      margin-right: 0.5rem;
    }
    
    /* Image Preview */
    .image-preview-container {
      margin-top: 1rem;
      text-align: center;
    }
    
    .image-preview {
      max-width: 100%;
      max-height: 300px;
      border-radius: var(--border-radius);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border: 1px solid var(--light-gray);
    }
    
    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      font-weight: 500;
      border-radius: var(--border-radius);
      cursor: pointer;
      transition: var(--transition);
      border: none;
      text-decoration: none;
    }
    
    .btn-primary {
      background-color: var(--primary);
      color: white;
    }
    
    .btn-primary:hover {
      background-color: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }
    
    .btn-outline {
      background-color: transparent;
      border: 1px solid var(--primary);
      color: var(--primary);
    }
    
    .btn-outline:hover {
      background-color: rgba(67, 97, 238, 0.1);
    }
    
    .btn-block {
      display: flex;
      width: 100%;
    }
    
    .btn i {
      margin-right: 0.5rem;
    }
    
    /* Loading State */
    .btn-loading {
      position: relative;
      pointer-events: none;
    }
    
    .btn-loading::after {
      content: "";
      display: inline-block;
      width: 1rem;
      height: 1rem;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top-color: white;
      animation: spin 1s linear infinite;
      margin-left: 0.5rem;
    }
    
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    /* Grid Layout for Product Specs */
    .specs-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    
    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .main-container {
        padding: 0 0.5rem;
      }
      
      .card-header h2 {
        font-size: 1.2rem;
      }
      
      .specs-grid {
        grid-template-columns: 1fr;
      }
      
      .action-buttons {
        flex-direction: column;
      }
      
      .btn {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1><i class="fas fa-box-open"></i> Edit Product</h1>
  </header>
  
  <div class="main-container">
    <!-- Error Messages -->
    @if ($errors->any())
      <div class="alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <div class="card">
      <div class="card-header">
        <h2><i class="fas fa-edit"></i> Product Information</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('mechanic.update', $product->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          
          <div class="form-group">
            <label for="ProductName">Product Name</label>
            <input type="text" id="ProductName" name="ProductName" class="form-control" value="{{ $product->ProductName }}" required placeholder="Enter product name" readonly>
          </div>
          
          <div class="form-group">
            <label for="Description">Description</label>
            <textarea id="Description" name="Description" class="form-control" placeholder="Describe the product features and benefits...">{{ $product->Description }}</textarea>
          </div>
          
          <div class="form-group">
            <label for="Price">Price ($)</label>
            <input type="number" id="Price" name="Price" class="form-control" step="0.01" min="0" value="{{ $product->Price }}" required placeholder="Enter Price">
        </div>

          
          <input type="hidden" id="Inventory" name="Inventory" min="0" value="{{ $product->Inventory }}" required>
          
          <div class="specs-grid">
            <div class="form-group">
              <label for="Color">Color</label>
              <input type="text" id="Color" name="color" class="form-control" value="{{ $product->color }}" required placeholder="Product color">
            </div>
            
            <div class="form-group">
              <label for="Width">Width</label>
              <input type="text" id="Width" name="width" class="form-control" value="{{ $product->width }}" required placeholder="In inches">
            </div>
            
            <div class="form-group">
              <label for="Weight">Weight</label>
              <input type="text" id="Weight" name="weight" class="form-control" value="{{ $product->weight }}" required placeholder="In pounds">
            </div>
            
            <div class="form-group">
              <label for="Height">Height</label>
              <input type="text" id="Height" name="height" class="form-control" value="{{ $product->height }}" required placeholder="In inches">
            </div>
          </div>
          
          <div class="form-group">
            <label for="Category">Category</label>
            <input type="text" id="Category" name="category" class="form-control" value="{{ $product->category }}" required placeholder="Product category">
          </div>
          
          <div class="form-group">
            <label for="image">Product Image</label>
            <div class="file-input-wrapper">
              <div class="file-input-label">
                <i class="fas fa-cloud-upload-alt"></i>
                <span id="file-label">Choose an image file</span>
              </div>
              <input type="file" id="image" name="image" accept="image/*">
            </div>
            
            <div class="image-preview-container">
              @if($product->image)
                <img src="{{ asset('upload/' . $product->image) }}" alt="Current Product Image" class="image-preview" id="image-preview">
              @endif
            </div>
          </div>
          
          <button type="submit" id="updateBtn" class="btn btn-primary btn-block">
            <i class="fas fa-save"></i> Update Product
          </button>
        </form>
      </div>
    </div>
    
    <div class="action-buttons">
      <a href="{{ route('mechanic.productdashboard') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
      </a>
    </div>
  </div>

  <script>
    // Image Preview Functionality
    document.getElementById('image').addEventListener('change', function(event) {
      const fileInput = event.target;
      const fileLabel = document.getElementById('file-label');
      const imagePreview = document.getElementById('image-preview');
      
      if (fileInput.files.length > 0) {
        fileLabel.textContent = fileInput.files[0].name;
        
        const reader = new FileReader();
        reader.onload = function(e) {
          if (!imagePreview) {
            // Create new image preview if it doesn't exist
            const newPreview = document.createElement('img');
            newPreview.id = 'image-preview';
            newPreview.className = 'image-preview';
            newPreview.src = e.target.result;
            newPreview.alt = "New Product Image";
            document.querySelector('.image-preview-container').appendChild(newPreview);
          } else {
            // Update existing preview
            imagePreview.src = e.target.result;
          }
        };
        reader.readAsDataURL(fileInput.files[0]);
      } else {
        fileLabel.textContent = 'Choose an image file';
        if (imagePreview && !"{{ $product->image }}") {
          imagePreview.remove();
        }
      }
    });
    
    // Loading State for Button
    document.querySelector('form').addEventListener('submit', function() {
      const updateBtn = document.getElementById('updateBtn');
      updateBtn.innerHTML = '<i class="fas fa-spinner"></i> Updating...';
      updateBtn.classList.add('btn-loading');
      updateBtn.disabled = true;
    });
    
    // Initialize file label if there's an existing image
    document.addEventListener('DOMContentLoaded', function() {
      const fileInput = document.getElementById('image');
      const fileLabel = document.getElementById('file-label');
      
      if ("{{ $product->image }}") {
        fileLabel.textContent = 'Change current image';
      }
    });
  </script>
</body>
</html>
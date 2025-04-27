<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Product | Carcare</title>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    /* Your existing CSS styles */
    :root {
      --primary-color: #4361ee;
      --primary-hover: #3a56d4;
      --success-color: #4cc9f0;
      --danger-color: #f72585;
      --light-bg: #f8f9fa;
      --dark-text: #2b2d42;
      --gray-text: #6c757d;
      --border-radius: 12px;
      --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light-bg);
      color: var(--dark-text);
      line-height: 1.6;
    }

    /* Header Styles */
    header {
      background: linear-gradient(135deg, var(--primary-color), #5a72ef);
      color: white;
      padding: 1.5rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
      position: relative;
      overflow: hidden;
    }

    header h1 {
      font-size: 1.8rem;
      font-weight: 600;
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.8rem;
    }

    header::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
      z-index: 1;
    }

    /* Main Container */
    .main-container {
      max-width: 800px;
      width: 90%;
      margin: 2rem auto;
      animation: fadeIn 0.5s ease-out;
    }

    /* Form Card */
    .form-card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      padding: 2rem;
      margin-bottom: 1.5rem;
    }

    /* Error Messages */
    .error-messages {
      background-color: #fef2f2;
      color: #dc2626;
      padding: 1rem;
      margin: 1.5rem auto;
      width: 90%;
      max-width: 800px;
      border-radius: var(--border-radius);
      border-left: 4px solid #dc2626;
      animation: slideDown 0.3s ease-out;
    }

    .error-messages ul {
      list-style: none;
    }

    .error-messages li {
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .error-messages li::before {
      content: '⚠';
      font-size: 1.1rem;
    }

    /* Form Grid Layout */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
    }

    @media (max-width: 768px) {
      .form-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Form Styles */
    .form-group {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .form-group.full-width {
      grid-column: span 2;
    }

    @media (max-width: 768px) {
      .form-group.full-width {
        grid-column: span 1;
      }
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: var(--dark-text);
    }

    .form-control {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 1px solid #e2e8f0;
      border-radius: var(--border-radius);
      font-size: 1rem;
      transition: var(--transition);
      background-color: #f8fafc;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
      background-color: white;
    }

    textarea.form-control {
      min-height: 120px;
      resize: vertical;
    }

    /* Styled Select */
    select.form-control {
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 1rem;
      padding-right: 2.5rem;
    }

    /* File Upload Custom Style */
    .file-upload {
      position: relative;
      overflow: hidden;
      display: inline-block;
      width: 100%;
    }

    .file-upload-btn {
      width: 100%;
      padding: 0.8rem 1rem;
      background-color: #f8fafc;
      border: 1px dashed #cbd5e1;
      border-radius: var(--border-radius);
      color: var(--gray-text);
      text-align: center;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .file-upload-btn:hover {
      border-color: var(--primary-color);
      color: var(--primary-color);
    }

    .file-upload input[type="file"] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }

    /* Image Preview */
    .image-preview-container {
      margin-top: 1rem;
      text-align: center;
      display: none;
    }

    .image-preview {
      max-width: 100%;
      max-height: 200px;
      border-radius: var(--border-radius);
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .remove-image {
      display: inline-block;
      margin-top: 0.5rem;
      color: var(--danger-color);
      cursor: pointer;
      font-size: 0.9rem;
      transition: var(--transition);
    }

    .remove-image:hover {
      text-decoration: underline;
    }

    /* Button Styles */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.8rem 1.5rem;
      border-radius: var(--border-radius);
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      border: none;
    }

    .btn-primary {
      background-color: var(--primary-color);
      color: white;
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }

    .btn-primary:hover {
      background-color: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
    }

    .btn-outline {
      background-color: transparent;
      border: 2px solid var(--primary-color);
      color: var(--primary-color);
    }

    .btn-outline:hover {
      background-color: rgba(67, 97, 238, 0.05);
    }

    .btn-block {
      width: 100%;
    }

    /* Loading State */
    .btn-loading .btn-text {
      display: none;
    }

    .btn-loading::after {
      content: '';
      display: inline-block;
      width: 1.2rem;
      height: 1.2rem;
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top-color: white;
      animation: spin 1s ease-in-out infinite;
    }

    /* Action Buttons Container */
    .action-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
      grid-column: span 2;
    }

    @media (max-width: 768px) {
      .action-buttons {
        grid-column: span 1;
      }
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      header h1 {
        font-size: 1.5rem;
      }

      .main-container {
        width: 95%;
        margin: 1rem auto;
      }

      .form-card {
        padding: 1.5rem;
      }

      .action-buttons {
        flex-direction: column;
      }

      .btn {
        width: 100%;
      }
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      border-radius: var(--border-radius);
      padding: 2rem;
      max-width: 500px;
      width: 90%;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      animation: fadeIn 0.3s ease-out;
    }

    .modal h3 {
      color: var(--danger-color);
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .modal button {
      background-color: var(--danger-color);
      color: white;
      border: none;
      padding: 0.7rem 1.5rem;
      border-radius: var(--border-radius);
      cursor: pointer;
      transition: var(--transition);
    }

    .modal button:hover {
      background-color: #e63946;
    }

    /* Loading indicator for product name check */
    .form-control.loading {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234361ee' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M21 12a9 9 0 1 1-6.219-8.56'%3E%3C/path%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 1rem;
      padding-right: 2.5rem;
    }
  </style>
</head>
<body>
  <header>
    <h1><i class="fas fa-cube"></i> Add New Product</h1>
  </header>

  <div class="main-container">
    <!-- Displaying error messages if any -->
    @if ($errors->any())
      <div class="error-messages">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="form-card">
      <form action="{{ route('mechanic.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        
        <!-- Hidden field with existing product names -->
        @php
            $mechanicProducts = Auth::guard('mechanic')->user()->products()->pluck('ProductName')->toArray();
        @endphp
        <input type="hidden" id="existingProducts" value="{{ json_encode($mechanicProducts) }}">
        
        <div class="form-grid">
          <!-- Product Name -->
          <div class="form-group full-width">
            <label for="ProductName">Product Name</label>
            <input type="text" 
                   id="ProductName" 
                   name="ProductName" 
                   class="form-control" 
                   placeholder="e.g. Premium Brake Pads" 
                   required
                   value="{{ old('ProductName') }}">
            <small class="text-muted" id="productNameFeedback"></small>
          </div>
          
          <!-- Product Description -->
          <div class="form-group full-width">
            <label for="Description">Description</label>
            <textarea id="Description" 
                      name="Description" 
                      class="form-control" 
                      placeholder="Describe the product features and specifications...">{{ old('Description') }}</textarea>
          </div>
          
          <!-- Price and Inventory -->
          <div class="form-group">
            <label for="Price">Price (₱)</label>
            <input type="number" 
                   id="Price" 
                   name="Price" 
                   class="form-control" 
                   step="0.01" 
                   min="0" 
                   placeholder="0.00"
                   required
                   value="{{ old('Price') }}">
          </div>
          
          <div class="form-group">
            <label for="Inventory">Inventory</label>
            <input type="number" 
                   id="Inventory" 
                   name="Inventory" 
                   class="form-control" 
                   min="0" 
                   required
                   value="{{ old('Inventory', 0) }}">
          </div>
          
          <!-- Product Dimensions -->
          <div class="form-group">
            <label for="width">Width (cm)</label>
            <input type="number" 
                   id="width" 
                   name="width" 
                   class="form-control" 
                   step="0.1" 
                   min="0"
                   value="{{ old('width') }}">
          </div>
          
          <div class="form-group">
            <label for="height">Height (cm)</label>
            <input type="number" 
                   id="height" 
                   name="height" 
                   class="form-control" 
                   step="0.1" 
                   min="0"
                   value="{{ old('height') }}">
          </div>
          
          <div class="form-group">
            <label for="weight">Weight (kg)</label>
            <input type="number" 
                   id="weight" 
                   name="weight" 
                   class="form-control" 
                   step="0.1" 
                   min="0"
                   value="{{ old('weight') }}">
          </div>
          
          <div class="form-group">
            <label for="color">Color</label>
            <input type="text" 
                   id="color" 
                   name="color" 
                   class="form-control" 
                   placeholder="e.g. Black, Silver"
                   value="{{ old('color') }}">
          </div>
          
          <!-- Category Dropdown -->
          <div class="form-group full-width">
            <label for="category">Category</label>
            <select id="category" 
                    name="category" 
                    class="form-control" 
                    required>
              <option value="">-- Select Category --</option>
              <option value="Engine Parts" {{ old('category') == 'Engine Parts' ? 'selected' : '' }}>Engine Parts</option>
              <option value="Brakes" {{ old('category') == 'Brakes' ? 'selected' : '' }}>Brakes</option>
              <option value="Suspension" {{ old('category') == 'Suspension' ? 'selected' : '' }}>Suspension</option>
              <option value="Electrical" {{ old('category') == 'Electrical' ? 'selected' : '' }}>Electrical</option>
              <option value="Body Parts" {{ old('category') == 'Body Parts' ? 'selected' : '' }}>Body Parts</option>
              <option value="Accessories" {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
            </select>
          </div>
          
          <!-- Product Image -->
          <div class="form-group full-width">
            <label for="image">Product Image</label>
            <div class="file-upload">
              <div class="file-upload-btn" id="fileUploadLabel">
                <i class="fas fa-cloud-upload-alt"></i> Choose an image file
              </div>
              <input type="file" 
                     id="image" 
                     name="image" 
                     accept="image/*"
                     onchange="previewImage(this)"
                     required>
            </div>
            
            <!-- Image Preview -->
            <div class="image-preview-container" id="imagePreviewContainer">
              <img src="#" alt="Preview" class="image-preview" id="imagePreview">
              <div class="remove-image" onclick="removeImage()">
                <i class="fas fa-times"></i> Remove Image
              </div>
            </div>
          </div>
          
          <!-- Form Actions -->
          <div class="action-buttons">
            <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
              <span class="btn-text"><i class="fas fa-save"></i> Save Product</span>
            </button>
            <a href="{{ route('mechanic.productdashboard') }}" class="btn btn-outline btn-block">
              <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <!-- Duplicate Product Modal -->
  <div id="duplicateModal" class="modal">
    <div class="modal-content">
      <h3><i class="fas fa-exclamation-triangle"></i> Duplicate Product</h3>
      <p>A product with this name already exists in your inventory. Please choose a different name.</p>
      <button onclick="closeDuplicateModal()" class="modal-btn">
        OK
      </button>
    </div>
  </div>

  <script>
    // Image Preview Functionality
    function previewImage(input) {
      const previewContainer = document.getElementById('imagePreviewContainer');
      const previewImage = document.getElementById('imagePreview');
      const fileUploadLabel = document.getElementById('fileUploadLabel');
      
      if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate image file
        if (!file.type.startsWith('image/')) {
          alert('Please select a valid image file (JPEG, PNG, etc.)');
          input.value = '';
          return;
        }
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
          previewImage.src = e.target.result;
          previewContainer.style.display = 'block';
          fileUploadLabel.innerHTML = `<i class="fas fa-check-circle"></i> ${file.name}`;
        }
        
        reader.readAsDataURL(file);
      }
    }
    
    // Remove Image Functionality
    function removeImage() {
      const input = document.getElementById('image');
      const previewContainer = document.getElementById('imagePreviewContainer');
      const fileUploadLabel = document.getElementById('fileUploadLabel');
      
      input.value = '';
      previewContainer.style.display = 'none';
      fileUploadLabel.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Choose an image file';
    }
    
    // Show duplicate product modal
    function showDuplicateModal() {
      const modal = document.getElementById('duplicateModal');
      modal.style.display = 'flex';
    }
    
    // Close duplicate product modal
    function closeDuplicateModal() {
      const modal = document.getElementById('duplicateModal');
      modal.style.display = 'none';
    }
    
    // Check for duplicate product name
    function checkForDuplicateProduct() {
      const productNameInput = document.getElementById('ProductName');
      const productName = productNameInput.value.trim();
      const existingProducts = JSON.parse(document.getElementById('existingProducts').value);
      const feedbackElement = document.getElementById('productNameFeedback');
      
      if (!productName) {
        feedbackElement.textContent = '';
        return false;
      }
      
      if (existingProducts.includes(productName)) {
        feedbackElement.textContent = 'You already have a product with this name';
        feedbackElement.style.color = 'var(--danger-color)';
        return true;
      } else {
        feedbackElement.textContent = 'Product name is available';
        feedbackElement.style.color = 'var(--success-color)';
        return false;
      }
    }
    
    // Form Submission Handling
    document.getElementById('productForm').addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      
      // First check client-side validation
      const imageInput = document.getElementById('image');
      if (!imageInput.files || !imageInput.files[0]) {
        e.preventDefault();
        alert('Please upload a product image');
        imageInput.focus();
        return;
      }
      
      // Check for duplicates
      if (checkForDuplicateProduct()) {
        e.preventDefault();
        showDuplicateModal();
        document.getElementById('ProductName').focus();
        return;
      }
      
      // Add loading state
      submitBtn.classList.add('btn-loading');
      submitBtn.disabled = true;
    });
    
    // Price input formatting
    document.getElementById('Price').addEventListener('blur', function(e) {
      const value = parseFloat(this.value);
      if (!isNaN(value)) {
        this.value = value.toFixed(2);
      }
    });
    
    // Add event listener for blur on product name
    document.getElementById('ProductName').addEventListener('blur', checkForDuplicateProduct);
    document.getElementById('ProductName').addEventListener('input', function() {
      document.getElementById('productNameFeedback').textContent = '';
    });
  </script>
</body>
</html>
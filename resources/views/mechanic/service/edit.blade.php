<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Service</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      position: relative;
    }
    
    header h1 {
      font-weight: 600;
      font-size: 1.8rem;
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
      border-radius: 10px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      margin-bottom: 2rem;
    }
    
    .card-header {
      padding: 1.5rem;
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
      border-radius: 8px;
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
      margin-bottom: 1.5rem;
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
      border-radius: 8px;
      transition: all 0.3s ease;
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
      border: 1px dashed var(--gray);
      border-radius: 8px;
      color: var(--gray);
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
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
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: {{ $service->image ? 'inline-block' : 'none' }};
    }
    
    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      font-weight: 500;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
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
    <h1><i class="fas fa-tools"></i> Edit Service</h1>
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
        <h2><i class="fas fa-edit"></i> Service Details</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('mechanic.service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          
          <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $service->name }}" required placeholder="e.g., Engine Tune-up" readonly>
          </div>
          
          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" placeholder="Describe the service in detail...">{{ $service->description }}</textarea>
          </div>
          
          <div class="form-group">
            <label for="price">Price ($)</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" min="0" value="{{ $service->price }}" required placeholder="0.00">
          </div>
          
          <div class="form-group">
            <label for="image">Service Image</label>
            <div class="file-input-wrapper">
              <div class="file-input-label">
                <i class="fas fa-cloud-upload-alt"></i>
                <span id="file-label">Choose an image file</span>
              </div>
              <input type="file" id="image" name="image" accept="image/*">
            </div>
            
            <div class="image-preview-container">
              @if ($service->image)
                <img id="image-preview" class="image-preview" src="{{ asset('upload/' . $service->image) }}" alt="Current Service Image">
              @else
                <img id="image-preview" class="image-preview" src="" alt="Image Preview" style="display: none;">
              @endif
            </div>
          </div>
          
          <button type="submit" id="updateBtn" class="btn btn-primary btn-block">
            <i class="fas fa-save"></i> Update Service
          </button>
        </form>
      </div>
    </div>
    
    <div class="action-buttons">
      <a href="{{ route('mechanic.dashboard') }}" class="btn btn-outline">
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
          imagePreview.src = e.target.result;
          imagePreview.style.display = 'inline-block';
        };
        reader.readAsDataURL(fileInput.files[0]);
      } else {
        fileLabel.textContent = 'Choose an image file';
        imagePreview.style.display = 'none';
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
      
      if (fileInput.files.length > 0) {
        fileLabel.textContent = fileInput.files[0].name;
      } else if ("{{ $service->image }}") {
        fileLabel.textContent = 'Change current image';
      }
    });
  </script>
</body>
</html>
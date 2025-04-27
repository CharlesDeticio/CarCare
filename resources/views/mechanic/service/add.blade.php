<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Service | Carcare</title>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
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
      max-width: 700px;
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
      margin-bottom: 1.5rem;
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

    /* Form Styles */
    .form-group {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .form-group label {
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
    /* Add these new styles for duplicate service validation */
    .name-feedback {
      margin-top: 0.5rem;
      font-size: 0.875rem;
    }
    
    .name-available {
      color: var(--success-color);
    }
    
    .name-taken {
      color: var(--danger-color);
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
  </style>
</head>
<body>
  <header>
    <h1><i class="fas fa-plus-circle"></i> Add New Service</h1>
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
      <form action="{{ route('mechanic.storage') }}" method="POST" enctype="multipart/form-data" id="serviceForm">
        @csrf
        
        <!-- Hidden field with existing service names -->
        @php
            $mechanicServices = Auth::guard('mechanic')->user()->services()->pluck('name')->toArray();
        @endphp
        <input type="hidden" id="existingServices" value="{{ json_encode($mechanicServices) }}">
        
        <!-- Service Name -->
        <div class="form-group">
          <label for="name">Service Name</label>
          <input type="text" 
                 name="name" 
                 id="name" 
                 class="form-control" 
                 placeholder="e.g. Engine Tune-up" 
                 required
                 value="{{ old('name') }}">
          <div id="nameFeedback" class="name-feedback"></div>
        </div>
        
        <!-- Service Description -->
        <div class="form-group">
          <label for="description">Service Description</label>
          <textarea name="description" 
                    id="description" 
                    class="form-control" 
                    placeholder="Describe the service details...">{{ old('description') }}</textarea>
        </div>
        
        <!-- Service Price -->
        <div class="form-group">
          <label for="price">Service Price (₱)</label>
          <input type="number" 
                 name="price" 
                 id="price" 
                 class="form-control" 
                 step="0.01" 
                 min="0" 
                 placeholder="0.00"
                 required
                 value="{{ old('price') }}">
        </div>
        
        <!-- Service Image -->
        <div class="form-group">
          <label for="image">Service Image</label>
          <div class="file-upload">
            <div class="file-upload-btn" id="fileUploadLabel">
              <i class="fas fa-cloud-upload-alt"></i> Choose an image file
            </div>
            <input type="file" 
                   name="image" 
                   id="image" 
                   accept="image/*"
                   onchange="previewImage(this)">
          </div>
          
          <!-- Image Preview -->
          <div class="image-preview-container" id="imagePreviewContainer">
            <img src="" alt="Preview" class="image-preview" id="imagePreview">
            <div class="remove-image" onclick="removeImage()">
              <i class="fas fa-times"></i> Remove Image
            </div>
          </div>
        </div>
        
        <!-- Form Actions -->
        <div class="action-buttons">
          <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
            <span class="btn-text"><i class="fas fa-save"></i> Save Service</span>
          </button>
          <a href="{{ route('mechanic.dashboard') }}" class="btn btn-outline btn-block">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
          </a>
        </div>
      </form>
    </div>
  </div>

  <!-- Duplicate Service Modal -->
  <div id="duplicateModal" class="modal">
    <div class="modal-content">
      <h3><i class="fas fa-exclamation-triangle"></i> Duplicate Service</h3>
      <p>You already have a service with this name. Please choose a different name.</p>
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
        const reader = new FileReader();
        
        reader.onload = function(e) {
          previewImage.src = e.target.result;
          previewContainer.style.display = 'block';
          fileUploadLabel.innerHTML = `<i class="fas fa-check-circle"></i> ${input.files[0].name}`;
        }
        
        reader.readAsDataURL(input.files[0]);
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
    
    // Show duplicate service modal
    function showDuplicateModal() {
      const modal = document.getElementById('duplicateModal');
      modal.style.display = 'flex';
    }
    
    // Close duplicate service modal
    function closeDuplicateModal() {
      const modal = document.getElementById('duplicateModal');
      modal.style.display = 'none';
    }
    
    // Check for duplicate service name
    function checkForDuplicateService() {
      const serviceNameInput = document.getElementById('name');
      const serviceName = serviceNameInput.value.trim();
      const existingServices = JSON.parse(document.getElementById('existingServices').value);
      const feedbackElement = document.getElementById('nameFeedback');
      
      if (!serviceName) {
        feedbackElement.textContent = '';
        return false;
      }
      
      if (existingServices.includes(serviceName)) {
        feedbackElement.textContent = 'You already have a service with this name';
        feedbackElement.className = 'name-feedback name-taken';
        return true;
      } else {
        feedbackElement.textContent = 'Service name is available';
        feedbackElement.className = 'name-feedback name-available';
        return false;
      }
    }
    
    // Form Submission Handling
    document.getElementById('serviceForm').addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      
      // Check for duplicates
      if (checkForDuplicateService()) {
        e.preventDefault();
        showDuplicateModal();
        document.getElementById('name').focus();
        return;
      }
      
      // Add loading state
      submitBtn.classList.add('btn-loading');
      submitBtn.disabled = true;
    });
    
    // Price input formatting
    document.getElementById('price').addEventListener('blur', function(e) {
      const value = parseFloat(this.value);
      if (!isNaN(value)) {
        this.value = value.toFixed(2);
      }
    });
    
    // Add event listener for blur on service name
    document.getElementById('name').addEventListener('blur', checkForDuplicateService);
    document.getElementById('name').addEventListener('input', function() {
      document.getElementById('nameFeedback').textContent = '';
    });
  </script>
</body>
</html>
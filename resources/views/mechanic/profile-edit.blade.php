<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shop Profile</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --secondary-color: #64748b;
            --light-bg: #f8fafc;
            --card-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: #334155;
            line-height: 1.6;
        }
        
        .container {
            max-width: 800px;
        }
        
        .profile-card {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            border: none;
            padding: 2rem;
        }
        
        .page-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .page-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #10b981);
            position: absolute;
            bottom: 0;
            left: 0;
            border-radius: 2px;
        }
        
        .form-label {
            font-weight: 500;
            color: #475569;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }
        
        .img-thumbnail {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 0.25rem;
            transition: transform 0.3s ease;
        }
        
        .img-thumbnail:hover {
            transform: scale(1.05);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #6366f1);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-hover), #4f46e5);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background-color: #f1f5f9;
            color: var(--secondary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background-color: #e2e8f0;
            color: #475569;
        }
        
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: none;
            border-radius: 10px;
            padding: 1rem;
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        
        .file-upload-btn {
            background-color: #f1f5f9;
            color: var(--secondary-color);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .file-upload-btn:hover {
            background-color: #e2e8f0;
        }
        
        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .image-preview-container {
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
            align-items: flex-end;
        }
        
        @media (max-width: 768px) {
            .profile-card {
                padding: 1.5rem;
            }
            
            .btn-group {
                width: 100%;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="profile-card">
        <h1 class="page-title">Edit Shop Profile</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('mechanic.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $mechanic->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email', $mechanic->email) }}" required>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="ContactNo" class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" id="ContactNo" name="ContactNo" 
                           value="{{ old('ContactNo', $mechanic->ContactNo) }}">
                </div>

                <div class="col-md-6">
                    <label for="shopname" class="form-label">Shop Name</label>
                    <input type="text" class="form-control" id="shopname" name="shopname" 
                           value="{{ old('shopname', $mechanic->shopname) }}">
                </div>
            </div>

            <div class="mb-4">
                <label for="Address" class="form-label">Shop Address</label>
                <input type="text" class="form-control" id="Address" name="Address" 
                       value="{{ old('Address', $mechanic->Address) }}">
            </div>

            <div class="mb-4">
                <label class="form-label">Shop Image</label>
                <div class="file-upload mb-2">
                    <label class="file-upload-btn">
                        <i class="bi bi-cloud-arrow-up"></i> Choose Image
                        <input type="file" class="file-upload-input" name="image" accept="image/*">
                    </label>
                </div>
                
                @if($mechanic->image)
                <div class="image-preview-container">
                    <div>
                        <p class="small text-muted mb-1">Current Image:</p>
                        <img src="{{ asset($mechanic->image) }}" alt="Shop Image" 
                             class="img-thumbnail" width="150">
                    </div>
                </div>
                @endif
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
                <a href="{{ route('mechanic.profile') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Update Profile
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Simple image preview for file upload
    document.querySelector('.file-upload-input')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const previewContainer = document.querySelector('.image-preview-container');
                if (!previewContainer) return;
                
                // Remove existing preview if any
                const existingPreview = document.querySelector('.new-image-preview');
                if (existingPreview) existingPreview.remove();
                
                // Create new preview
                const previewDiv = document.createElement('div');
                previewDiv.innerHTML = `
                    <div>
                        <p class="small text-muted mb-1">New Image:</p>
                        <img src="${event.target.result}" alt="Preview" 
                             class="img-thumbnail new-image-preview" width="150">
                    </div>
                `;
                previewContainer.appendChild(previewDiv);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>
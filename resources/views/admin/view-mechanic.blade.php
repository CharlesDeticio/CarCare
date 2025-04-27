<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mechanic Profile Review - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-dark: #4338CA;
            --success-color: #22C55E;
            --success-dark: #16A34A;
            --danger-color: #EF4444;
            --danger-dark: #DC2626;
            --warning-color: #F59E0B;
            --warning-dark: #E67E22;
            --gray-color: #6B7280;
            --gray-dark: #4B5563;
            --light-color: #F9FAFB;
            --dark-color: #111827;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F3F4F6;
            color: var(--dark-color);
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .profile-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 40px;
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .profile-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .profile-subtitle {
            color: var(--gray-color);
            font-size: 1rem;
        }
        
        .profile-content {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        
        .profile-image-section {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #EEE;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            transition: var(--transition);
            cursor: pointer;
        }
        
        .profile-image:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
        
        .profile-details {
            flex: 2;
            min-width: 300px;
        }
        
        .detail-card {
            background-color: var(--light-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            transition: var(--transition);
        }
        
        .detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        }
        
        .detail-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            border-bottom: 2px solid #EEE;
            padding-bottom: 8px;
        }
        
        .detail-item {
            display: flex;
            margin-bottom: 12px;
        }
        
        .detail-label {
            font-weight: 500;
            color: var(--gray-color);
            min-width: 120px;
        }
        
        .detail-value {
            font-weight: 400;
            color: var(--dark-color);
        }
        
        .gallery-section {
            margin-top: 40px;
        }
        
        .gallery-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .gallery-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            cursor: pointer;
            aspect-ratio: 1;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .gallery-item:hover .gallery-image {
            transform: scale(1.05);
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            color: white;
            padding: 15px 10px 5px;
            opacity: 0;
            transition: var(--transition);
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-caption {
            font-size: 0.85rem;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .empty-gallery {
            text-align: center;
            color: var(--gray-color);
            padding: 40px 0;
            grid-column: 1 / -1;
        }
        
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-approve {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn-approve:hover {
            background-color: var(--success-dark);
        }
        
        .btn-deny {
            background-color: var(--danger-color);
            color: white;
        }
        
        .btn-deny:hover {
            background-color: var(--danger-dark);
        }
        
        .btn-delete {
            background-color: var(--gray-color);
            color: white;
        }
        
        .btn-delete:hover {
            background-color: var(--gray-dark);
        }
        
        .btn-back {
            background-color: var(--gray-color);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }
        
        .btn-back:hover {
            background-color: var(--gray-dark);
            color: white;
            transform: translateY(-2px);
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.875rem;
            margin-top: 10px;
        }
        
        .status-approved {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success-color);
        }
        
        /* Lightbox Styles */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            overflow: auto;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .lightbox.show {
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }
        
        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            text-align: center;
        }
        
        .lightbox-image {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
        
        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
            z-index: 1001;
        }
        
        .lightbox-close:hover {
            color: var(--danger-color);
            transform: rotate(90deg);
        }
        
        .lightbox-caption {
            color: white;
            padding: 15px;
            font-size: 1rem;
            margin-top: 10px;
        }
        
        .lightbox-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            padding: 0 20px;
            z-index: 1001;
        }
        
        .lightbox-btn {
            color: white;
            font-size: 40px;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.3);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        
        .lightbox-btn:hover {
            background: rgba(0, 0, 0, 0.6);
            transform: scale(1.1);
        }
        
        .lightbox-prev {
            left: 20px;
        }
        
        .lightbox-next {
            right: 20px;
        }
        
        @media (max-width: 768px) {
            .profile-content {
                flex-direction: column;
            }
            
            .profile-image {
                width: 150px;
                height: 150px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 15px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
            
            .lightbox-btn {
                width: 40px;
                height: 40px;
                font-size: 30px;
            }
            
            .lightbox-close {
                top: 10px;
                right: 15px;
                font-size: 30px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>

        <div class="profile-card">
            <div class="profile-header">
                <h1 class="profile-title">Mechanic Profile Review</h1>
                <p class="profile-subtitle">Review and verify mechanic registration details</p>
            </div>

            <div class="profile-content">
                <div class="profile-image-section">
                    @if($mechanic->image)
                        <img src="{{ asset($mechanic->image) }}" alt="Mechanic Profile" class="profile-image" onclick="openLightbox('{{ asset($mechanic->image) }}', 'Profile Image')">
                    @else
                        <img src="{{ asset('img/avatar.png') }}" alt="Default Profile" class="profile-image" onclick="openLightbox('{{ asset('img/avatar.png') }}', 'Default Profile Image')">
                    @endif
                    
                    @if($mechanic->verified)
                        <span class="status-badge status-approved">
                            <i class="fas fa-check-circle"></i> Approved
                        </span>
                    @endif
                </div>

                <div class="profile-details">
                    <div class="detail-card">
                        <h3 class="detail-title">Basic Information</h3>
                        <div class="detail-item">
                            <span class="detail-label">Shop Name:</span>
                            <span class="detail-value">{{ $mechanic->shopname }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">{{ $mechanic->email }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Contact No:</span>
                            <span class="detail-value">{{ $mechanic->ContactNo }}</span>
                        </div>
                    </div>
                    
                    <div class="detail-card">
                        <h3 class="detail-title">Location Details</h3>
                        <div class="detail-item">
                            <span class="detail-label">Address:</span>
                            <span class="detail-value">{{ $mechanic->Address }}</span>
                        </div>
                    </div>
                    
                    <div class="detail-card">
                        <h3 class="detail-title">Registration Info</h3>
                        <div class="detail-item">
                            <span class="detail-label">Registered On:</span>
                            <span class="detail-value">{{ $mechanic->created_at->format('F j, Y g:i A') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated:</span>
                            <span class="detail-value">{{ $mechanic->updated_at->format('F j, Y g:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certificates Gallery -->
            <div class="gallery-section">
                <h3 class="gallery-title">Certificates & Documents</h3>
                
                @if($mechanic->mechanicImages && $mechanic->mechanicImages->count() > 0)
                    <div class="gallery-grid" id="gallery">
                        @foreach($mechanic->mechanicImages as $index => $image)
                            <div class="gallery-item" onclick="openLightbox('{{ asset($image->image_path) }}', 'Certificate {{ $index + 1 }}', {{ $index }})">
                                <img src="{{ asset($image->image_path) }}" alt="Certificate Image {{ $index + 1 }}" class="gallery-image">
                                <div class="gallery-overlay">
                                    <p class="gallery-caption">Certificate {{ $index + 1 }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-gallery">
                        <i class="fas fa-image fa-2x" style="color: #DDD; margin-bottom: 10px;"></i>
                        <p>No certificates or documents uploaded</p>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                @if(!$mechanic->verified)
                    <!-- Approve Button -->
                    <form id="approve-form" action="{{ route('admin.approveMechanic', $mechanic->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-approve">
                            <i class="fas fa-check"></i> Approve Application
                        </button>
                    </form>

                    <!-- Deny Button -->
                    <form id="deny-form" action="{{ route('admin.denyMechanic', $mechanic->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-deny" onclick="confirmDeny()">
                            <i class="fas fa-times"></i> Deny Application
                        </button>
                    </form>
                @else
                    <!-- Delete Button -->
                    <form id="delete-form" action="{{ route('admin.mechanic.destroy', $mechanic->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-delete" onclick="confirmDelete()">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        <div class="lightbox-nav">
            <div class="lightbox-btn lightbox-prev" onclick="changeImage(-1)">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="lightbox-btn lightbox-next" onclick="changeImage(1)">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
        <div class="lightbox-content">
            <img id="lightboxImage" class="lightbox-image" src="">
            <div id="lightboxCaption" class="lightbox-caption"></div>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Lightbox functionality
        let currentImageIndex = 0;
        const images = [];
        
        // Initialize images array if gallery exists
        @if($mechanic->mechanicImages && $mechanic->mechanicImages->count() > 0)
            @foreach($mechanic->mechanicImages as $image)
                images.push({
                    src: '{{ asset($image->image_path) }}',
                    caption: 'Certificate {{ $loop->iteration }}'
                });
            @endforeach
        @endif
        
        // Also add profile image to the lightbox
        images.unshift({
            src: '{{ $mechanic->image ? asset($mechanic->image) : asset('img/avatar.png') }}',
            caption: 'Profile Image'
        });
        
        function openLightbox(imageSrc, caption, index = 0) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightboxImage');
            const lightboxCaption = document.getElementById('lightboxCaption');
            
            currentImageIndex = index;
            lightboxImg.src = imageSrc;
            lightboxCaption.textContent = caption;
            lightbox.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        
        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
        
        function changeImage(direction) {
            currentImageIndex += direction;
            
            // Wrap around if at beginning or end
            if (currentImageIndex >= images.length) {
                currentImageIndex = 0;
            } else if (currentImageIndex < 0) {
                currentImageIndex = images.length - 1;
            }
            
            const lightboxImg = document.getElementById('lightboxImage');
            const lightboxCaption = document.getElementById('lightboxCaption');
            
            lightboxImg.src = images[currentImageIndex].src;
            lightboxCaption.textContent = images[currentImageIndex].caption;
            
            // Add fade effect
            lightboxImg.style.opacity = 0;
            setTimeout(() => {
                lightboxImg.style.opacity = 1;
            }, 100);
        }
        
        // Close lightbox when clicking outside the image
        window.addEventListener('click', (event) => {
            const lightbox = document.getElementById('lightbox');
            if (event.target === lightbox) {
                closeLightbox();
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', (event) => {
            const lightbox = document.getElementById('lightbox');
            if (!lightbox.classList.contains('show')) return;
            
            if (event.key === 'Escape') {
                closeLightbox();
            } else if (event.key === 'ArrowLeft') {
                changeImage(-1);
            } else if (event.key === 'ArrowRight') {
                changeImage(1);
            }
        });
        
        // Confirm delete action
        function confirmDelete() {
            Swal.fire({
                title: 'Delete Mechanic Profile?',
                text: "This action cannot be undone. All associated data will be permanently removed.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                backdrop: `
                    rgba(0,0,0,0.7)
                    url("/images/trash-icon.png")
                    center top
                    no-repeat
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
        
        // Confirm deny action
        function confirmDeny() {
            Swal.fire({
                title: 'Deny Mechanic Application?',
                text: "Are you sure you want to deny this mechanic's registration?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Yes, deny application',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deny-form').submit();
                }
            });
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-dark: #4338CA;
            --danger-color: #EF4444;
            --danger-dark: #DC2626;
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .profile-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin-top: 80px;
            margin-bottom: 40px;
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
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
            min-width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .profile-image {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #EEE;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
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
        }
        
        .btn-delete {
            background-color: var(--danger-color);
            color: white;
        }
        
        .btn-delete:hover {
            background-color: var(--danger-dark);
        }
        
        .user-activity {
            margin-top: 30px;
        }
        
        .activity-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #EEE;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-info {
            flex: 2;
        }
        
        .activity-time {
            flex: 1;
            text-align: right;
            color: var(--gray-color);
            font-size: 0.875rem;
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
            
            .activity-item {
                flex-direction: column;
            }
            
            .activity-time {
                text-align: left;
                margin-top: 5px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="{{ route('admin.indexuser') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Users
        </a>

        <div class="profile-card">
            <div class="profile-header">
                <h1 class="profile-title">User Profile</h1>
                <p class="profile-subtitle">Detailed information about this user</p>
            </div>

            <div class="profile-content">
                <div class="profile-image-section">
                    @if($user->image)
                        <img src="{{ asset('upload/' . $user->image) }}" alt="User Profile" class="profile-image">
                    @else
                        <div class="profile-image" style="background-color: #EEE; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="font-size: 3rem; color: #999;"></i>
                        </div>
                    @endif
                </div>

                <div class="profile-details">
                    <div class="detail-card">
                        <h3 class="detail-title">Personal Information</h3>
                        <div class="detail-item">
                            <span class="detail-label">Full Name:</span>
                            <span class="detail-value">{{ $user->first_name }} {{ $user->last_name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">{{ $user->email }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Phone:</span>
                            <span class="detail-value">{{ $user->phone_number ?? 'Not provided' }}</span>
                        </div>
                    </div>
                    
                    <div class="detail-card">
                        <h3 class="detail-title">Address Information</h3>
                        <div class="detail-item">
                            <span class="detail-label">Address:</span>
                            <span class="detail-value">{{ $user->address ?? 'Not provided' }}</span>
                        </div>
                    </div>
                    
                    <div class="detail-card">
                        <h3 class="detail-title">Account Information</h3>
                        <div class="detail-item">
                            <span class="detail-label">Member Since:</span>
                            <span class="detail-value">{{ $user->created_at->format('F j, Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated:</span>
                            <span class="detail-value">{{ $user->updated_at->format('F j, Y g:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Activity Section -->
            <div class="user-activity">
                <h3 class="detail-title">Recent Activity</h3>
                
                <div class="activity-item">
                    <div class="activity-info">
                        <strong>Account Created</strong>
                    </div>
                    <div class="activity-time">
                        {{ $user->created_at->diffForHumans() }}
                    </div>
                </div>
                
                @if($user->updated_at != $user->created_at)
                <div class="activity-item">
                    <div class="activity-info">
                        <strong>Profile Updated</strong>
                    </div>
                    <div class="activity-time">
                        {{ $user->updated_at->diffForHumans() }}
                    </div>
                </div>
                @endif
                
                <!-- Add more activity items here as needed -->
                
                <!--<div class="activity-item">-->
                <!--    <div class="activity-info">-->
                <!--        <em>More activity records would appear here...</em>-->
                <!--    </div>-->
                <!--</div>-->
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <form id="delete-form" action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-delete" onclick="confirmDelete()">
                        <i class="fas fa-trash-alt"></i> Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Confirm delete action
        function confirmDelete() {
            Swal.fire({
                title: 'Delete User Account?',
                text: "This will permanently delete the user and all associated data. This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: var(--danger-color),
                cancelButtonColor: var(--gray-color),
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                backdrop: `
                    rgba(0,0,0,0.7)
                    url("/images/warning-icon.png")
                    center top
                    no-repeat
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
</body>
</html>
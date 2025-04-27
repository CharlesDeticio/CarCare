<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Profile</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }

        .container {
            max-width: 640px;
            margin: 40px auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #1e293b;
            font-weight: 600;
            font-size: 28px;
            position: relative;
        }

        h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #10b981);
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .card {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }

        .card-body {
            padding: 40px;
        }

        /* Profile Image */
        .profile-image-container {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto 25px;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            background-color: #f1f5f9;
        }

        .profile-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #3b82f6;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            border: 2px solid white;
        }

        /* Info Items */
        .info-item {
            display: flex;
            margin-bottom: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            min-width: 140px;
            color: #64748b;
            font-weight: 500;
            font-size: 15px;
        }

        .info-value {
            color: #1e293b;
            font-weight: 500;
            flex-grow: 1;
        }

        /* Buttons */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 15px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            flex: 1;
        }

        .btn i {
            margin-right: 8px;
            font-size: 14px;
        }

        .btn-back {
            background-color: #f1f5f9;
            color: #64748b;
        }

        .btn-back:hover {
            background-color: #e2e8f0;
            color: #475569;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.35);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 30px;
            }
            
            .info-item {
                flex-direction: column;
                gap: 5px;
            }
            
            .info-label {
                min-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            .card-body {
                padding: 25px;
            }

            .profile-image-container {
                width: 120px;
                height: 120px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Shop Profile</h2>
        <div class="card">
            <div class="card-body">

                <!-- Profile Image -->
                <div class="profile-image-container">
                    <img src="{{ $mechanic->image ? asset($mechanic->image) : asset('img/avatar.png') }}" 
                         alt="Profile Image" 
                         class="profile-image"
                         onerror="this.src='{{ asset('img/avatar.png') }}'">
                    <div class="profile-badge">
                        <i class="fas fa-wrench"></i>
                    </div>
                </div>

                <!-- Mechanic Info -->
                <div class="info-item">
                    <span class="info-label">Shop Name:</span>
                    <span class="info-value">{{ auth()->guard('mechanic')->user()->shopname }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ auth()->guard('mechanic')->user()->email }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Contact Number:</span>
                    <span class="info-value">{{ auth()->guard('mechanic')->user()->ContactNo }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Address:</span>
                    <span class="info-value">{{ auth()->guard('mechanic')->user()->Address }}</span>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <a href="{{ route('mechanic.overview') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <a href="{{ route('mechanic.profile.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
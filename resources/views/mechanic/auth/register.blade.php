<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Carcare - Shop Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon & Fonts -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Leaflet CSS & JS (DO NOT REMOVE) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/mechanic.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            min-height: 100vh;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background-color: rgba(255, 255, 255, 0.85); */
            z-index: -1;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header-panel {
            background: rgba(12, 46, 91, 0.9);
            color: white;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(5px);
        }

        .header-panel h1 {
            margin: 0;
            font-size: 2rem;
        }

        .header-panel p {
            margin: 10px 0 0;
            font-size: 1rem;
        }

        .content-container {
            display: flex;
            flex: 1;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .form-wrapper {
            width: 100%;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 40px;
            backdrop-filter: blur(5px);
        }

        .form-wrapper h2 {
            color: #0C2E5B;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .password-group {
            flex: 1;
            min-width: calc(50% - 10px);
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9fafb;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus {
            border-color: #0C2E5B;
            outline: none;
        }

        #image-preview {
            margin-top: 10px;
            max-width: 120px;
            display: none;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        #map {
            height: 300px;
            width: 100%;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px solid #ddd;
        }

        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        #pac-input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: #f9fafb;
            box-sizing: border-box;
        }

        .autocomplete-suggestions {
            border: 1px solid #ddd;
            border-top: none;
            max-height: 200px;
            overflow-y: auto;
            position: absolute;
            width: 100%;
            z-index: 1000;
            background: white;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .autocomplete-suggestion {
            padding: 10px;
            cursor: pointer;
            font-size: 14px;
            color: #333;
        }

        .autocomplete-suggestion:hover {
            background-color: #f0f0f0;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s;
            width: 100%;
            color: #fff;
            border: none;
            box-sizing: border-box;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: #6c757d;
            margin-bottom: 15px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .error-message {
            color: #e3342f;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .error-summary {
            background-color: #fdecea;
            color: #e3342f;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-summary ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .button-row {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .button-row .btn-cancel {
            flex: 1;
            padding: 12px 25px;
            border-radius: 8px;
            border: 1px solid #0C2E5B;
            background-color: #fff;
            color: #0C2E5B;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .button-row .btn-cancel:hover {
            background-color: #f0f0f0;
        }

        .button-row .btn-register {
            flex: 1;
            padding: 12px 25px;
            border-radius: 8px;
            border: none;
            background-color: #0C2E5B;
            color: #fff;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-row .btn-register:hover {
            background-color: #092046;
        }

        @media (max-width: 768px) {
            .form-wrapper {
                padding: 30px 20px;
                max-width: 90%;
            }
            
            .button-row {
                flex-direction: column;
            }
            
            .content-container {
                padding: 20px 15px;
            }

            .form-group, .password-group {
                min-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .form-wrapper {
                padding: 25px 15px;
            }
            
            .form-wrapper h2 {
                font-size: 1.5rem;
            }
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .full-width {
            width: 100%;
            flex: 0 0 100%;
        }

        .image-upload-section {
            margin-top: 15px;
        }

        .additional-images-section {
            margin-top: 15px;
        }
        .password-wrapper {
    position: relative;
}

.password-wrapper input {
    width: 100%;
    padding-right: 40px;
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #777;
    font-size: 1.1rem;
}

    </style>
</head>

<body>

    <div class="main-container">
        <!-- Header Panel -->
        <div class="header-panel">
            <h1>CarCare</h1>
            <p>Join our trusted mechanics network. Expand your service and reach more customers!</p>
        </div>

        <!-- Content Container -->
        <div class="content-container">
            <div class="form-wrapper">
                <h2>Register as a Shop Owner</h2>

                @if ($errors->any())
                    <div class="error-summary">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mechanic.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name</label>
<input type="text" name="name" id="name" value="{{ old('name') }}" required 
    pattern="[A-Za-z\s]+" title="Letters and spaces only" 
    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="ContactNo">Contact Number</label>
                            <input type="text" name="ContactNo" id="ContactNo" value="{{ old('ContactNo') }}" 
    pattern="[0-9]{10,11}" maxlength="11" required 
    oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
    title="Enter 10 to 11 digit contact number (numbers only)">

                            @error('ContactNo')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="shopname">Shop Name</label>
<input type="text" name="shopname" id="shopname" value="{{ old('shopname') }}" required 
    pattern="[A-Za-z\s]+" title="Letters and spaces only" 
    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                            @error('shopname')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row image-upload-section">
                        <div class="form-group">
                            <label for="image">Shop Image</label>
                            <input type="file" name="image" id="image" accept="image/*" required>
                            @error('image')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                            <img id="image-preview" alt="Preview Image">
                        </div>
                    </div>

                    

                    <div class="form-row">
                        <div class="form-group full-width">
        <label>Certification Documents</label>
        <p class="help-text" style="font-size: 0.85rem; color: #666; margin-bottom: 10px;">
            Upload images of your certifications, licenses, or documents (max 5 files, 2MB each, JPG/PNG/PDF)
        </p>                            <div id="additional-images-container">
                                <input type="file" name="additional_images[]" class="additional-image-input" accept="image/*" required>
                            </div>
    
                            <button type="button" id="add-image-btn" class="btn btn-secondary" style="margin-top: 10px;">
                                Add Another Image
                            </button>

                            @error('additional_images')
                                <span class="error-message">{{ $message }}</span>
                            @enderror

                            <div id="additional-images-preview" style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;"></div>
                        </div>
                    </div>
                    
                    <div class="form-row">
    <div class="password-group">
        <label for="password">Password</label>
        <div class="password-wrapper">
            <input type="password" name="password" id="password" required>
            <span toggle="#password" class="fa fa-eye-slash toggle-password"></span>
        </div>
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="password-group">
        <label for="password_confirmation">Confirm Password</label>
        <div class="password-wrapper">
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            <span toggle="#password_confirmation" class="fa fa-eye-slash toggle-password"></span>
        </div>
        @error('password_confirmation')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>
</div>

                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Search for Your Location</label>
                            <div class="search-container">
                                <input id="pac-input" type="text" placeholder="Search for your shop location...">
                                <div id="autocomplete-results" class="autocomplete-suggestions"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group full-width">
                            <button type="button" id="locateMeBtn" class="btn btn-secondary">
                                Use My Current Location
                            </button>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Pin Your Shop Location</label>
                            <div id="map"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="Address">Address</label>
                            <input type="text" name="Address" id="Address" value="{{ old('Address') }}" required>
                            @error('Address')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                    <div class="button-row">
                        <a href="{{ route('mechanic.login') }}" class="btn-cancel">
                            Cancel
                        </a>
                    
                        <button type="submit" class="btn-register">
                            Register
                        </button>
                    </div>                                 
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const defaultLat = 10.312537;
            const defaultLng = 123.960223;

            const map = L.map('map').setView([defaultLat, defaultLng], 12);

            L.tileLayer('https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=gPDa74mAZTitZuCiw7vl', {
                attribution: '&copy; <a href="https://www.maptiler.com/">MapTiler</a> contributors'
            }).addTo(map);

            const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

            function updateLatLng(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            }

            function reverseGeocode(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('Address').value = data.display_name || 'Address not found';
                    });
            }

            marker.on('dragend', function (event) {
                const position = event.target.getLatLng();
                updateLatLng(position.lat, position.lng);
                reverseGeocode(position.lat, position.lng);
            });

            reverseGeocode(defaultLat, defaultLng);
            updateLatLng(defaultLat, defaultLng);

            // Autocomplete search
            const searchInput = document.getElementById('pac-input');
            const autocompleteResults = document.getElementById('autocomplete-results');

            searchInput.addEventListener('input', function () {
                const query = searchInput.value;

                if (query.length > 2) {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            autocompleteResults.innerHTML = '';

                            if (data.length === 0) {
                                autocompleteResults.innerHTML = '<div class="autocomplete-suggestion">No results found</div>';
                            }

                            data.forEach(result => {
                                const suggestion = document.createElement('div');
                                suggestion.className = 'autocomplete-suggestion';
                                suggestion.textContent = result.display_name;

                                suggestion.addEventListener('click', () => {
                                    searchInput.value = result.display_name;
                                    autocompleteResults.innerHTML = '';

                                    const latlng = [parseFloat(result.lat), parseFloat(result.lon)];
                                    map.setView(latlng, 14);
                                    marker.setLatLng(latlng);

                                    updateLatLng(result.lat, result.lon);
                                    document.getElementById('Address').value = result.display_name;
                                });

                                autocompleteResults.appendChild(suggestion);
                            });
                        });
                } else {
                    autocompleteResults.innerHTML = '';
                }
            });

            document.addEventListener('click', function (event) {
                if (!searchInput.contains(event.target)) {
                    autocompleteResults.innerHTML = '';
                }
            });

            // Locate Me Button
            document.getElementById('locateMeBtn').addEventListener('click', function () {
                if (!navigator.geolocation) {
                    alert('Geolocation is not supported by your browser.');
                    return;
                }

                navigator.geolocation.getCurrentPosition(function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 14);

                    updateLatLng(lat, lng);
                    reverseGeocode(lat, lng);
                }, function () {
                    alert('Unable to retrieve your location.');
                });
            });

            // Preview Image Handler
            document.getElementById('image').addEventListener('change', function (event) {
                const file = event.target.files[0];
                const preview = document.getElementById('image-preview');

                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            });

            // Additional Images Handler
            const container = document.getElementById('additional-images-container');
            const previewContainer = document.getElementById('additional-images-preview');
            const addImageButton = document.getElementById('add-image-btn');

            addImageButton.addEventListener('click', function () {
    const wrapper = document.createElement('div');
    wrapper.style.display = 'flex';
    wrapper.style.alignItems = 'center';
    wrapper.style.gap = '10px';
    wrapper.style.marginTop = '10px';
    wrapper.style.flexWrap = 'wrap';

    const newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.name = 'additional_images[]';
    newInput.classList.add('additional-image-input');
    newInput.accept = 'image/*';

    const img = document.createElement('img');
    img.style.width = '100px';
    img.style.height = '100px';
    img.style.objectFit = 'cover';
    img.style.borderRadius = '8px';
    img.style.marginTop = '5px';
    img.style.display = 'none'; // hide initially

    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.textContent = 'Remove';
    removeBtn.className = 'text-red-500 hover:underline text-sm';
    
    removeBtn.addEventListener('click', function () {
        wrapper.remove();  // Remove input + image + button all at once
    });

    newInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    wrapper.appendChild(newInput);
    wrapper.appendChild(img);
    wrapper.appendChild(removeBtn);

    container.appendChild(wrapper);
});


        });
    </script>
    <script>
    document.querySelectorAll('.toggle-password').forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            const input = document.querySelector(this.getAttribute('toggle'));
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>


</body>

</html>
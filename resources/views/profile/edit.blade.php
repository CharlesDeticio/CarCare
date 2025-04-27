<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="flex items-center mb-6">
            <a href="{{ route('profile.show') }}" class="mr-4 text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Edit Your Profile</h1>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
            @csrf
            
            <div class="p-6 space-y-6">
                <!-- Profile Picture Section -->
                <div class="flex flex-col items-center mb-8">
                    <div class="relative mb-4">
                        <img src="{{ Auth::user()->image ? asset('upload/' . Auth::user()->image) : asset('img/avatar.png') }}" 
                             alt="Profile" 
                             id="profile-image-preview"
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow">
                        <label for="image-upload" class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full cursor-pointer hover:bg-blue-600 transition">
                            <i class="fas fa-camera"></i>
                            <input id="image-upload" 
                                   type="file" 
                                   name="image" 
                                   class="hidden" 
                                   accept="image/*"
                                   onchange="previewImage(this)">
                        </label>
                    </div>
                    <p class="text-sm text-gray-600">Click on the camera to change your profile picture</p>
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Personal Information Section -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <div class="relative">
                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                        @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <div class="relative">
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                        @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <div class="relative">
                            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                        </div>
                        @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Address Section -->
                <!-- Address Section -->
<div class="border-t border-gray-200 pt-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>
    <div class="grid md:grid-cols-2 gap-6">

        <!-- Address Dropdown -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <div class="relative">
                <select name="address" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="" disabled>Select your address</option>
                    <optgroup label="Lapu-Lapu City">
                        <option value="Pajo" {{ $user->address == 'Pajo' ? 'selected' : '' }}>Pajo</option>
                        <option value="Basak" {{ $user->address == 'Basak' ? 'selected' : '' }}>Basak</option>
                        <option value="Marigondon" {{ $user->address == 'Marigondon' ? 'selected' : '' }}>Marigondon</option>
                        <option value="Gun-ob" {{ $user->address == 'Gun-ob' ? 'selected' : '' }}>Gun-ob</option>
                        <option value="Babag" {{ $user->address == 'Babag' ? 'selected' : '' }}>Babag</option>
                    </optgroup>
                    <optgroup label="Mandaue City">
                        <option value="Tipolo" {{ $user->address == 'Tipolo' ? 'selected' : '' }}>Tipolo</option>
                        <option value="Subangdaku" {{ $user->address == 'Subangdaku' ? 'selected' : '' }}>Subangdaku</option>
                        <option value="Banilad" {{ $user->address == 'Banilad' ? 'selected' : '' }}>Banilad</option>
                        <option value="Ibabao-Estancia" {{ $user->address == 'Ibabao-Estancia' ? 'selected' : '' }}>Ibabao-Estancia</option>
                        <option value="Casuntingan" {{ $user->address == 'Casuntingan' ? 'selected' : '' }}>Casuntingan</option>
                    </optgroup>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                </div>
            </div>
            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Province Dropdown -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
            <div class="relative">
                <select name="province" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="" disabled>Select Province</option>
                    <option value="Cebu" {{ $user->province == 'Cebu' ? 'selected' : '' }}>Cebu</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <i class="fas fa-map text-gray-400"></i>
                </div>
            </div>
            @error('province') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Region Dropdown -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Region</label>
            <div class="relative">
                <select name="region" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="" disabled>Select Region</option>
                    <option value="Region VII - Central Visayas" {{ $user->region == 'Region VII - Central Visayas' ? 'selected' : '' }}>
                        Region VII - Central Visayas
                    </option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <i class="fas fa-globe-americas text-gray-400"></i>
                </div>
            </div>
            @error('region') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Zip Code Dropdown -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
            <div class="relative">
                <select name="zip_code" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="" disabled>Select Zip Code</option>
                    <option value="6014" {{ $user->zip_code == 6014 ? 'selected' : '' }}>6014 (Lapu-Lapu)</option>
                    <option value="6015" {{ $user->zip_code == 6015 ? 'selected' : '' }}>6015 (Mandaue)</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <i class="fas fa-mail-bulk text-gray-400"></i>
                </div>
            </div>
            @error('zip_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

    </div>
</div>

                <!-- Cars Section -->
<div class="border-t border-gray-200 pt-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Car Information</h3>

    <div id="car-section" class="space-y-6">
        @foreach($user->cars as $index => $car)
        <div class="grid md:grid-cols-2 gap-6 car-entry relative">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Car Type</label>
                <input type="text" name="car_type[]" value="{{ $car->car_type }}" list="carTypes"
                    placeholder="Type or select car type"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Car Model</label>
                <input type="text" name="car_model[]" value="{{ $car->car_model }}" list="carModels"
                    placeholder="Type or select car model"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
        </div>
        @endforeach
    </div>

    <!-- Add New Car Button -->
    <div class="mt-4">
        <button type="button" onclick="addCarFields()" 
            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none transition">
            <i class="fas fa-plus mr-2"></i> Add Another Car
        </button>
    </div>

    <!-- Datalists (Outside the loop, only once) -->
    <datalist id="carTypes">
        <option value="Sedan">
        <option value="SUV">
        <option value="Hatchback">
        <option value="Pickup">
        <option value="Van">
        <option value="Coupe">
        <option value="Convertible">
    </datalist>

    <datalist id="carModels">
        <option value="Toyota Corolla">
        <option value="Honda Civic">
        <option value="Ford Ranger">
        <option value="Mitsubishi Montero">
        <option value="Hyundai Tucson">
        <option value="Chevrolet Trailblazer">
        <option value="Nissan Navara">
    </datalist>
</div>

                <!-- Password Section -->
                <!--<div class="border-t border-gray-200 pt-6">-->
                <!--    <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>-->
                <!--    <div class="grid md:grid-cols-2 gap-6">-->
                <!--        <div>-->
                <!--            <label class="block text-sm font-medium text-gray-700 mb-1">New Password (optional)</label>-->
                <!--            <div class="relative">-->
                <!--                <input type="password" name="password" -->
                <!--                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">-->
                <!--                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">-->
                <!--                    <i class="fas fa-lock text-gray-400"></i>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror-->
                <!--        </div>-->

                <!--        <div>-->
                <!--            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>-->
                <!--            <div class="relative">-->
                <!--                <input type="password" name="password_confirmation" -->
                <!--                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">-->
                <!--                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">-->
                <!--                    <i class="fas fa-lock text-gray-400"></i>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <p class="mt-2 text-sm text-gray-500">Leave password fields blank if you don't want to change it.</p>-->
                <!--</div>-->
            </div>

            <!-- Form Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <a href="{{ route('profile.show') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const preview = document.getElementById('profile-image-preview');
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
function addCarFields() {
    const carSection = document.getElementById('car-section');

    const carEntry = document.createElement('div');
    carEntry.className = 'grid md:grid-cols-2 gap-6 car-entry relative mt-6';

    carEntry.innerHTML = `
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Car Type</label>
            <input type="text" name="car_type[]" list="carTypes"
                placeholder="Type or select car type"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Car Model</label>
            <input type="text" name="car_model[]" list="carModels"
                placeholder="Type or select car model"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <button type="button" onclick="removeCar(this)" 
            class="absolute top-0 right-0 mt-2 mr-2 text-red-500 hover:text-red-700">
            <i class="fas fa-trash"></i>
        </button>
    `;

    carSection.appendChild(carEntry);
}

function removeCar(button) {
    button.parentElement.remove();
}
</script>



</body>
</html>
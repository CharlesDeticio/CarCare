<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { min-height: 100%; font-family: 'Arial', sans-serif; overflow-x: hidden; }
        body { position: relative; overflow-y: auto; }

        .background-blur {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: url('{{ asset('images/mechanic.jpg') }}') no-repeat center center;
            background-size: cover; filter: blur(8px); z-index: 0;
        }

        .overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5); z-index: 1;
        }

        .container {
            position: relative; z-index: 2;
            display: flex; justify-content: center;
            padding: 40px 20px; flex-direction: column;
        }

        .register-card {
            background: #ffffff; border-radius: 12px;
            width: 100%; max-width: 600px; margin: 40px auto;
            padding: 40px 30px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .logo-container { text-align: center; margin-bottom: 20px; }
        .logo-container img { width: 120px; }

        .register-title {
            text-align: center; font-size: 2rem;
            color: #0C2E5B; margin-bottom: 20px;
        }

        form {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block; margin-bottom: 6px;
            font-weight: 500; color: #333;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="file"], input[type="number"], select {
            width: 100%; padding: 12px;
            border: 1px solid #ccc; border-radius: 6px;
            font-size: 0.95rem;
        }

        .full-width { grid-column: 1 / 3; }

        .btn { padding: 12px; border-radius: 6px; font-size: 1rem; cursor: pointer; transition: 0.3s ease; }
        .btn-register { background: #0C2E5B; color: #fff; border: none; flex: 1; }
        .btn-register:hover { background: #092046; }

        .btn-cancel { background: #fff; color: #0C2E5B; border: 2px solid #0C2E5B; flex: 1; text-align: center; }
        .btn-cancel:hover { background: #f3f3f3; }

        .button-row {
            grid-column: 1 / 3;
            display: flex; gap: 10px; margin-top: 20px;
        }

        #image-preview {
            margin-top: 10px; max-width: 120px;
            max-height: 120px; display: none;
            border-radius: 6px; border: 1px solid #ccc;
        }

        .password-input-group { position: relative; }
        .password-input-group input { width: 100%; padding-right: 40px; }
        .toggle-password {
            position: absolute; top: 50%; right: 12px;
            transform: translateY(-50%); cursor: pointer;
            color: #777; font-size: 1.1rem;
        }

        /* Enhanced Car Information Section */
        .vehicle-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .vehicle-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .vehicle-section-header h4 {
            color: #0C2E5B;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
        }

        .vehicle-section-header i {
            color: #0C2E5B;
        }

        .section-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .car-info {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
            position: relative;
            transition: all 0.3s ease;
        }

        .car-info:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            border-color: #0C2E5B;
        }

        .car-info-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .car-info-header h5 {
            color: #0C2E5B;
            font-size: 1rem;
            margin: 0;
        }

        .delete-car-btn {
            background: #ffebee;
            color: #c62828;
            border: none;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s ease;
        }

        .delete-car-btn:hover:not(:disabled) {
            background: #ffcdd2;
        }

        .delete-car-btn:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .car-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .input-group {
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #444;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .input-group label i {
            font-size: 0.9rem;
            color: #0C2E5B;
        }

        .input-icon-wrapper {
            position: relative;
        }

        .input-icon-wrapper input,
        .input-icon-wrapper select {
            width: 100%;
            padding: 12px 16px;
            padding-right: 35px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .input-icon-wrapper input:focus,
        .input-icon-wrapper select:focus {
            border-color: #0C2E5B;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(12, 46, 91, 0.1);
            outline: none;
        }

        .input-icon-wrapper i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            pointer-events: none;
        }

        .add-car-btn {
            width: 100%;
            background: #f0f7ff;
            color: #0C2E5B;
            border: 1px dashed #0C2E5B;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .add-car-btn:hover {
            background: #e1f0ff;
            border-style: solid;
        }

        .add-car-btn i {
            font-size: 1.1rem;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        @media (max-width: 768px) {
            .register-card { padding: 30px 20px; }
            form { grid-template-columns: 1fr; }
            .full-width { grid-column: 1 / 2; }
            .button-row { flex-direction: column; }
            .logo-container img { width: 100px; }
            .car-info-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 480px) {
            .register-title { font-size: 1.5rem; }
            .logo-container img { width: 80px; }
        }
        /* Add to your existing style section */
.password-row {
    grid-column: 1 / 3;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

@media (max-width: 768px) {
    .password-row {
        grid-template-columns: 1fr;
    }
}
.error-message {
    color: #b30000;
    font-size: 0.85rem;
    margin-top: 5px;
    display: none;
}

/* Add this to show server-side validation errors */
.invalid-input {
    border-color: #ff5e5e !important;
}

.invalid-feedback {
    display: block;
    color: #b30000;
    font-size: 0.85rem;
    margin-top: 5px;
}
    </style>
</head>

<body>
    <div class="background-blur"></div>
    <div class="overlay"></div>

    <div class="container">
        <div class="register-card">
            <div class="logo-container">
                <img src="{{ asset('images/carcare.avif') }}" alt="Carcare Logo">
            </div>

            <h2 class="register-title">Register</h2>
            
            @if ($errors->any())
<div style="background-color: #ffe5e5; border: 1px solid #ff5e5e; padding: 15px; border-radius: 8px; margin-bottom: 20px; color: #b30000;">
    <ul style="list-style-type: none; padding-left: 0;">
        @foreach ($errors->all() as $error)
            <li style="margin-bottom: 5px;"><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                @csrf

                <!-- FIRST NAME -->
                <div>
                    <label for="first_name">First Name</label>
                    <input id="first_name" type="text" name="first_name" required 
                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" placeholder="Enter your first name">
                </div>

                <!-- LAST NAME -->
                <div>
                    <label for="last_name">Last Name</label>
                    <input id="last_name" type="text" name="last_name" required 
                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')" placeholder="Enter your last name">
                </div>

                <!-- EMAIL -->
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required placeholder="Enter your email">
                </div>

                <!-- PHONE NUMBER -->
                <div>
                    <label for="phone_number">Contact Number</label>
                    <input id="phone_number" type="text" name="phone_number"
                        pattern="[0-9]{10,11}" maxlength="11" required
                        placeholder="09XXXXXXXXX"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        title="Enter a valid 10 to 11 digit number (numbers only)">
                </div>

                <!-- ADDRESS -->
                <div class="full-width">
                    <label for="address">Address</label>
                    <div class="input-icon-wrapper">
                        <input type="text" id="address" name="address" required
                               placeholder="Enter your full address (e.g. 123 Main St, Lapu-Lapu City)"
                               pattern="[A-Za-z0-9\s\-,.]+"
                               title="Only letters, numbers, spaces, hyphens, commas and periods are allowed"
                               oninput="this.value = this.value.replace(/[^A-Za-z0-9\s\-,.]/g, '')">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <!-- REGION (now includes all Philippine regions) -->
                <div>
                    <label for="region">Region</label>
                    <select id="region" name="region" required onchange="updateProvinces()">
                        <option value="" disabled selected>Select Region</option>
                        <option value="NCR - National Capital Region">NCR - National Capital Region</option>
                        <option value="CAR - Cordillera Administrative Region">CAR - Cordillera Administrative Region</option>
                        <option value="Region I - Ilocos Region">Region I - Ilocos Region</option>
                        <option value="Region II - Cagayan Valley">Region II - Cagayan Valley</option>
                        <option value="Region III - Central Luzon">Region III - Central Luzon</option>
                        <option value="Region IV-A - CALABARZON">Region IV-A - CALABARZON</option>
                        <option value="Region IV-B - MIMAROPA">Region IV-B - MIMAROPA</option>
                        <option value="Region V - Bicol Region">Region V - Bicol Region</option>
                        <option value="Region VI - Western Visayas">Region VI - Western Visayas</option>
                        <option value="Region VII - Central Visayas">Region VII - Central Visayas</option>
                        <option value="Region VIII - Eastern Visayas">Region VIII - Eastern Visayas</option>
                        <option value="Region IX - Zamboanga Peninsula">Region IX - Zamboanga Peninsula</option>
                        <option value="Region X - Northern Mindanao">Region X - Northern Mindanao</option>
                        <option value="Region XI - Davao Region">Region XI - Davao Region</option>
                        <option value="Region XII - SOCCSKSARGEN">Region XII - SOCCSKSARGEN</option>
                        <option value="Region XIII - Caraga">Region XIII - Caraga</option>
                    </select>
                </div>


                <!-- PROVINCE (now depends on region) -->
                <div>
                    <label for="province">Province</label>
                    <select id="province" name="province" required onchange="updateZipCodes()">
                        <option value="" disabled selected>Select Province</option>
                        <!-- Options will be populated by JavaScript -->
                    </select>
                </div>

                <!-- ZIP CODE (now depends on province) -->
                <div>
                    <label for="zip_code">Zip Code</label>
                    <select id="zip_code" name="zip_code" required>
                        <option value="" disabled selected>Select Zip Code</option>
                        <!-- Options will be populated by JavaScript -->
                    </select>
                </div>

                <!-- PASSWORD ROW (side by side) -->
                <div class="password-row">
                    <!-- PASSWORD -->
                    <div>
                        <label for="password">Password</label>
                        <div class="password-input-group">
                            <input id="password" type="password" name="password" required placeholder="Enter password">
                            <span toggle="#password" class="fa fa-eye-slash toggle-password"></span>
                        </div>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div>
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="password-input-group">
                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm password">
                            <span toggle="#password_confirmation" class="fa fa-eye-slash toggle-password"></span>
                        </div>
                    </div>
                </div>

                <!-- PROFILE IMAGE -->
                <div class="full-width">
                    <label for="image">Profile Image</label>
                    <input id="image" type="file" name="image" accept="image/jpeg, image/png">
                    <div id="image-error" class="error-message" style="display: none; color: #b30000; margin-top: 5px; font-size: 0.85rem;"></div>
                    <img id="image-preview" src="#" alt="Image Preview">
                    <small style="display: block; margin-top: 5px; color: #666;">Max file size: 5MB (JPEG or PNG only)</small>
                </div>

                <!-- CAR INFORMATION -->
                <div class="full-width vehicle-section">
                    <div class="vehicle-section-header">
                        <h4><i class="fas fa-car"></i> Vehicle Information</h4>
                    </div>
                    
                    <div id="car-inputs">
                        <!-- First vehicle (required) -->
                        <div class="car-info" id="car-info-0">
                            <div class="car-info-header">
                                <h5></h5>
                                <button type="button" class="delete-car-btn" onclick="removeCar('car-info-0')" disabled>
                                    <i class="fas fa-lock"></i> Required
                                </button>
                            </div>
                            
                            <div class="car-info-grid">
                                <!-- Brand Input -->
                                <div class="input-group">
                                    <label for="car_model_0"><i class="fas fa-tags"></i> Brand</label>
                                    <div class="input-icon-wrapper">
                                        <input id="car_model_0" name="car_model[]" list="carModels" required 
                                               pattern="[A-Za-z\s]+"
                                               title="Letters only (no numbers or symbols)"
                                               placeholder="e.g. Corolla, Civic"
                                               onkeydown="return /[a-zA-Z\s]/i.test(event.key)">
                                    </div>
                                    <datalist id="carModels">
                                        <option value="Honda">
                                        <option value="Toyota">
                                        <option value="Nissan">
                                        <option value="Subaru">
                                        <option value="KIA">
                                        <option value="Mitsubishi">
                                        <option value="Isuzu">
                                        <option value="Ford">
                                    </datalist>
                                </div>

                                <!-- Model Type Input -->
                                <div class="input-group">
                                    <label for="car_type_0"><i class="fas fa-car-side"></i> Model Type</label>
                                    <div class="input-icon-wrapper">
                                        <input id="car_type_0" name="car_type[]" list="carTypes" required 
                                               pattern="[A-Za-z\s]+"
                                               title="Letters only (no numbers or symbols)"
                                               placeholder="Type or select type"
                                               onkeydown="return /[a-zA-Z\s]/i.test(event.key)">
                                        <datalist id="carTypes">
                                            <option value="Sedan">
                                            <option value="SUV">
                                            <option value="Hatchback">
                                            <option value="Pickup">
                                            <option value="Van">
                                            <option value="Coupe">
                                            <option value="Convertible">
                                        </datalist>
                                    </div>
                                </div>           
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" id="add-car" class="add-car-btn">
                        <i class="fas fa-plus-circle"></i> Add Another Vehicle
                    </button>
                </div>

                <!-- BUTTON ROW -->
                <div class="button-row">
                    <a href="{{ route('login') }}" class="btn btn-cancel">Cancel</a>
                    <button type="submit" class="btn btn-register" id="registerBtn">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Enhanced Region, Province, and Zip Code Data for Philippines
const regionData = {
    "NCR - National Capital Region": {
        provinces: {
            "Manila": ["0900", "0901", "0902", "0903", "0904", "0905", "0906", "0907", "0908", "0909", "0910", "1000", "1001", "1002", "1003", "1004", "1005", "1006", "1007", "1008", "1010", "1011", "1012", "1013", "1014", "1015", "1016", "1017", "1018", "1019", "1020", "1021", "1022", "1023", "1024", "1025", "1026", "1027", "1028", "1029", "1030", "1031", "1032", "1033", "1034", "1035", "1036", "1037", "1038", "1039", "1040", "1041", "1042", "1043", "1044", "1045", "1046", "1047", "1048", "1049", "1050", "1051", "1052", "1053", "1054", "1055", "1056", "1057", "1058", "1059", "1060", "1061", "1062", "1063", "1064", "1065", "1066", "1067", "1068", "1069", "1070", "1071", "1072", "1073", "1074", "1075", "1076", "1077", "1078", "1079", "1080", "1081", "1082", "1083", "1084"],
            "Quezon City": ["1100", "1101", "1102", "1103", "1104", "1105", "1106", "1107", "1108", "1109", "1110", "1111", "1112", "1113", "1114", "1115", "1116", "1117", "1118", "1119", "1120", "1121", "1122", "1123", "1124", "1125", "1126", "1127", "1128", "1129", "1130", "1131", "1132", "1133", "1134", "1135", "1136", "1137", "1138", "1139", "1140", "1141", "1142", "1143", "1144", "1145", "1146", "1147", "1148", "1149", "1150", "1151", "1152", "1153", "1154", "1155", "1156", "1157", "1158", "1159", "1160", "1161", "1162", "1163", "1164", "1165", "1166", "1167", "1168", "1169", "1170", "1171", "1172", "1173", "1174", "1175", "1176", "1177", "1178", "1179", "1180", "1181", "1182", "1183", "1184", "1185", "1186", "1187", "1188", "1189", "1190", "1191", "1192", "1193", "1194", "1195", "1196", "1197", "1198", "1199"],
            "Caloocan": ["1400", "1401", "1402", "1403", "1404", "1405", "1406", "1407", "1408", "1409", "1410", "1411", "1412", "1413", "1414", "1415", "1416", "1417", "1418", "1419", "1420", "1421", "1422", "1423", "1424", "1425", "1426", "1427", "1428", "1429", "1430", "1431", "1432", "1433", "1434", "1435", "1436", "1437", "1438", "1439", "1440", "1441", "1442", "1443", "1444", "1445", "1446", "1447", "1448", "1449", "1450", "1451", "1452", "1453", "1454", "1455", "1456", "1457", "1458", "1459", "1460", "1461", "1462", "1463", "1464", "1465", "1466", "1467", "1468", "1469", "1470", "1471", "1472", "1473", "1474", "1475", "1476", "1477", "1478", "1479", "1480", "1481", "1482", "1483", "1484", "1485", "1486", "1487", "1488", "1489", "1490", "1491", "1492", "1493", "1494", "1495", "1496", "1497", "1498", "1499"],
            // Add more cities in NCR...
        }
    },
    "CAR - Cordillera Administrative Region": {
        provinces: {
            "Abra": ["2800", "2801", "2802", "2803", "2804", "2805", "2806", "2807", "2808", "2809", "2810"],
            "Apayao": ["3800", "3801", "3802", "3803", "3804", "3805", "3806", "3807", "3808", "3809", "3810"],
            "Benguet": ["2600", "2601", "2602", "2603", "2604", "2605", "2606", "2607", "2608", "2609", "2610", "2611", "2612", "2613", "2614", "2615", "2616", "2617", "2618", "2619", "2620"],
            "Ifugao": ["3600", "3601", "3602", "3603", "3604", "3605", "3606", "3607", "3608", "3609", "3610"],
            "Kalinga": ["3800", "3801", "3802", "3803", "3804", "3805", "3806", "3807", "3808", "3809", "3810"],
            "Mountain Province": ["2600", "2601", "2602", "2603", "2604", "2605", "2606", "2607", "2608", "2609", "2610"]
        }
    },
    "Region I - Ilocos Region": {
        provinces: {
            "Ilocos Norte": ["2900", "2901", "2902", "2903", "2904", "2905", "2906", "2907", "2908", "2909", "2910"],
            "Ilocos Sur": ["2700", "2701", "2702", "2703", "2704", "2705", "2706", "2707", "2708", "2709", "2710"],
            "La Union": ["2500", "2501", "2502", "2503", "2504", "2505", "2506", "2507", "2508", "2509", "2510"],
            "Pangasinan": ["2400", "2401", "2402", "2403", "2404", "2405", "2406", "2407", "2408", "2409", "2410", "2411", "2412", "2413", "2414", "2415", "2416", "2417", "2418", "2419", "2420", "2421", "2422", "2423", "2424", "2425", "2426", "2427", "2428", "2429", "2430"]
        }
    },
    "Region II - Cagayan Valley": {
        provinces: {
            "Batanes": ["3900", "3901", "3902", "3903", "3904", "3905"],
            "Cagayan": ["3500", "3501", "3502", "3503", "3504", "3505", "3506", "3507", "3508", "3509", "3510", "3511", "3512", "3513", "3514", "3515", "3516", "3517", "3518", "3519", "3520"],
            "Isabela": ["3300", "3301", "3302", "3303", "3304", "3305", "3306", "3307", "3308", "3309", "3310", "3311", "3312", "3313", "3314", "3315", "3316", "3317", "3318", "3319", "3320"],
            "Nueva Vizcaya": ["3700", "3701", "3702", "3703", "3704", "3705", "3706", "3707", "3708", "3709", "3710"],
            "Quirino": ["3400", "3401", "3402", "3403", "3404", "3405", "3406", "3407", "3408", "3409", "3410"]
        }
    },
    "Region III - Central Luzon": {
        provinces: {
            "Aurora": ["3200", "3201", "3202", "3203", "3204", "3205", "3206", "3207", "3208", "3209", "3210"],
            "Bataan": ["2100", "2101", "2102", "2103", "2104", "2105", "2106", "2107", "2108", "2109", "2110"],
            "Bulacan": ["3000", "3001", "3002", "3003", "3004", "3005", "3006", "3007", "3008", "3009", "3010", "3011", "3012", "3013", "3014", "3015", "3016", "3017", "3018", "3019", "3020"],
            "Nueva Ecija": ["3100", "3101", "3102", "3103", "3104", "3105", "3106", "3107", "3108", "3109", "3110", "3111", "3112", "3113", "3114", "3115", "3116", "3117", "3118", "3119", "3120"],
            "Pampanga": ["2000", "2001", "2002", "2003", "2004", "2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020"],
            "Tarlac": ["2300", "2301", "2302", "2303", "2304", "2305", "2306", "2307", "2308", "2309", "2310", "2311", "2312", "2313", "2314", "2315", "2316", "2317", "2318", "2319", "2320"],
            "Zambales": ["2200", "2201", "2202", "2203", "2204", "2205", "2206", "2207", "2208", "2209", "2210", "2211", "2212", "2213", "2214", "2215", "2216", "2217", "2218", "2219", "2220"]
        }
    },
    // Add more regions as needed...
    "Region VI - Western Visayas": {
        provinces: {
            "Aklan": ["5600", "5601", "5602", "5603", "5604", "5605"],
            "Antique": ["5700", "5701", "5702", "5703", "5704", "5705", "5706", "5707", "5708"],
            "Capiz": ["5800", "5801", "5802", "5803", "5804", "5805", "5806", "5807", "5808"],
            "Guimaras": ["5044", "5045", "5046", "5047", "5048", "5049"],
            "Iloilo": ["5000", "5001", "5002", "5003", "5004", "5005", "5006", "5007", "5008", "5009", "5010", "5011", "5012", "5013", "5014", "5015", "5016", "5017", "5018", "5019", "5020", "5021", "5022", "5023", "5024", "5025", "5026", "5027", "5028", "5029", "5030", "5031", "5032", "5033", "5034", "5035", "5036", "5037", "5038", "5039", "5040", "5041", "5042", "5043"],
            "Negros Occidental": ["6100", "6101", "6102", "6103", "6104", "6105", "6106", "6107", "6108", "6109", "6110", "6111", "6112", "6113", "6114", "6115", "6116", "6117", "6118", "6119", "6120", "6121", "6122", "6123", "6124", "6125", "6126", "6127", "6128", "6129", "6130", "6131", "6132", "6133", "6134", "6135", "6136", "6137", "6138", "6139", "6140", "6141", "6142", "6143", "6144", "6145", "6146", "6147", "6148", "6149", "6150", "6151", "6152", "6153", "6154", "6155", "6156", "6157", "6158", "6159", "6160", "6161", "6162", "6163", "6164", "6165", "6166", "6167", "6168", "6169", "6170", "6171", "6172", "6173", "6174", "6175", "6176", "6177", "6178", "6179", "6180", "6181", "6182", "6183", "6184", "6185", "6186", "6187", "6188", "6189", "6190", "6191", "6192", "6193", "6194", "6195", "6196", "6197", "6198", "6199"]
        }
    },
    "Region VII - Central Visayas": {
        provinces: {
            "Bohol": ["6300", "6301", "6302", "6303", "6304", "6305", "6306", "6307", "6308", "6309", "6310", "6311", "6312", "6313", "6314", "6315", "6316", "6317", "6318", "6319", "6320", "6321", "6322", "6323", "6324", "6325", "6326", "6327", "6328", "6329", "6330", "6331", "6332", "6333", "6334", "6335", "6336", "6337", "6338", "6339", "6340", "6341", "6342", "6343", "6344", "6345", "6346", "6347", "6348", "6349", "6350", "6351", "6352", "6353", "6354", "6355", "6356", "6357", "6358", "6359", "6360", "6361", "6362", "6363", "6364", "6365", "6366", "6367", "6368", "6369", "6370", "6371", "6372", "6373", "6374", "6375", "6376", "6377", "6378", "6379", "6380", "6381", "6382", "6383", "6384", "6385", "6386", "6387", "6388", "6389", "6390", "6391", "6392", "6393", "6394", "6395", "6396", "6397", "6398", "6399"],
            "Cebu": ["6000", "6001", "6002", "6003", "6004", "6005", "6006", "6007", "6008", "6009", "6010", "6011", "6012", "6013", "6014", "6015", "6016", "6017", "6018", "6019", "6020", "6021", "6022", "6023", "6024", "6025", "6026", "6027", "6028", "6029", "6030", "6031", "6032", "6033", "6034", "6035", "6036", "6037", "6038", "6039", "6040", "6041", "6042", "6043", "6044", "6045", "6046", "6047", "6048", "6049", "6050", "6051", "6052", "6053", "6054", "6055", "6056", "6057", "6058", "6059", "6060", "6061", "6062", "6063", "6064", "6065", "6066", "6067", "6068", "6069", "6070", "6071", "6072", "6073", "6074", "6075", "6076", "6077", "6078", "6079", "6080", "6081", "6082", "6083", "6084", "6085", "6086", "6087", "6088", "6089", "6090", "6091", "6092", "6093", "6094", "6095", "6096", "6097", "6098", "6099"],
            "Negros Oriental": ["6200", "6201", "6202", "6203", "6204", "6205", "6206", "6207", "6208", "6209", "6210", "6211", "6212", "6213", "6214", "6215", "6216", "6217", "6218", "6219", "6220", "6221", "6222", "6223", "6224", "6225", "6226", "6227", "6228", "6229", "6230", "6231", "6232", "6233", "6234", "6235", "6236", "6237", "6238", "6239", "6240", "6241", "6242", "6243", "6244", "6245", "6246", "6247", "6248", "6249", "6250", "6251", "6252", "6253", "6254", "6255", "6256", "6257", "6258", "6259", "6260", "6261", "6262", "6263", "6264", "6265", "6266", "6267", "6268", "6269", "6270", "6271", "6272", "6273", "6274", "6275", "6276", "6277", "6278", "6279", "6280", "6281", "6282", "6283", "6284", "6285", "6286", "6287", "6288", "6289", "6290", "6291", "6292", "6293", "6294", "6295", "6296", "6297", "6298", "6299"],
            "Siquijor": ["6225", "6226", "6227", "6228", "6229"]
        }
    },
    "Region VIII - Eastern Visayas": {
        provinces: {
            "Biliran": ["6549", "6550", "6551", "6552", "6553", "6554", "6555", "6556", "6557", "6558", "6559"],
            "Eastern Samar": ["6800", "6801", "6802", "6803", "6804", "6805", "6806", "6807", "6808", "6809", "6810", "6811", "6812", "6813", "6814", "6815", "6816", "6817", "6818", "6819"],
            "Leyte": ["6500", "6501", "6502", "6503", "6504", "6505", "6506", "6507", "6508", "6509", "6510", "6511", "6512", "6513", "6514", "6515", "6516", "6517", "6518", "6519", "6520", "6521", "6522", "6523", "6524", "6525", "6526", "6527", "6528", "6529"],
            "Northern Samar": ["6400", "6401", "6402", "6403", "6404", "6405", "6406", "6407", "6408", "6409", "6410", "6411", "6412", "6413", "6414", "6415", "6416", "6417", "6418", "6419"],
            "Samar": ["6700", "6701", "6702", "6703", "6704", "6705", "6706", "6707", "6708", "6709", "6710", "6711", "6712", "6713", "6714", "6715", "6716", "6717", "6718", "6719"],
            "Southern Leyte": ["6600", "6601", "6602", "6603", "6604", "6605", "6606", "6607", "6608", "6609", "6610", "6611", "6612", "6613", "6614", "6615", "6616", "6617", "6618", "6619"]
        }
    },
    "Region IX - Zamboanga Peninsula": {
        provinces: {
            "Zamboanga del Norte": ["7100", "7101", "7102", "7103", "7104", "7105", "7106", "7107", "7108", "7109", "7110", "7111", "7112", "7113", "7114", "7115", "7116", "7117", "7118", "7119"],
            "Zamboanga del Sur": ["7000", "7001", "7002", "7003", "7004", "7005", "7006", "7007", "7008", "7009", "7010", "7011", "7012", "7013", "7014", "7015", "7016", "7017", "7018", "7019"],
            "Zamboanga Sibugay": ["7000", "7001", "7002", "7003", "7004", "7005", "7006", "7007", "7008", "7009", "7010", "7011", "7012", "7013", "7014", "7015", "7016", "7017", "7018", "7019"],
            "Isabela City": ["7300", "7301", "7302", "7303", "7304", "7305", "7306", "7307", "7308", "7309"]
        }
    },
    "Region X - Northern Mindanao": {
        provinces: {
            "Bukidnon": ["8700", "8701", "8702", "8703", "8704", "8705", "8706", "8707", "8708", "8709", "8710", "8711", "8712", "8713", "8714", "8715", "8716", "8717", "8718", "8719"],
            "Camiguin": ["9100", "9101", "9102", "9103", "9104", "9105", "9106", "9107", "9108", "9109"],
            "Lanao del Norte": ["9200", "9201", "9202", "9203", "9204", "9205", "9206", "9207", "9208", "9209", "9210", "9211", "9212", "9213", "9214", "9215", "9216", "9217", "9218", "9219"],
            "Misamis Occidental": ["7200", "7201", "7202", "7203", "7204", "7205", "7206", "7207", "7208", "7209", "7210", "7211", "7212", "7213", "7214", "7215", "7216", "7217", "7218", "7219"],
            "Misamis Oriental": ["9000", "9001", "9002", "9003", "9004", "9005", "9006", "9007", "9008", "9009", "9010", "9011", "9012", "9013", "9014", "9015", "9016", "9017", "9018", "9019"]
        }
    },
    "Region XI - Davao Region": {
        provinces: {
            "Davao de Oro (Compostela Valley)": ["8800", "8801", "8802", "8803", "8804", "8805", "8806", "8807", "8808", "8809", "8810", "8811", "8812", "8813", "8814", "8815", "8816", "8817", "8818", "8819"],
            "Davao del Norte": ["8100", "8101", "8102", "8103", "8104", "8105", "8106", "8107", "8108", "8109", "8110", "8111", "8112", "8113", "8114", "8115", "8116", "8117", "8118", "8119"],
            "Davao del Sur": ["8000", "8001", "8002", "8003", "8004", "8005", "8006", "8007", "8008", "8009", "8010", "8011", "8012", "8013", "8014", "8015", "8016", "8017", "8018", "8019"],
            "Davao Occidental": ["8010", "8011", "8012", "8013", "8014", "8015", "8016", "8017", "8018", "8019"],
            "Davao Oriental": ["8200", "8201", "8202", "8203", "8204", "8205", "8206", "8207", "8208", "8209", "8210", "8211", "8212", "8213", "8214", "8215", "8216", "8217", "8218", "8219"]
        }
    },
    "Region XII - SOCCSKSARGEN": {
        provinces: {
            "Cotabato (North Cotabato)": ["9400", "9401", "9402", "9403", "9404", "9405", "9406", "9407", "9408", "9409", "9410", "9411", "9412", "9413", "9414", "9415", "9416", "9417", "9418", "9419"],
            "Sarangani": ["9500", "9501", "9502", "9503", "9504", "9505", "9506", "9507", "9508", "9509", "9510", "9511", "9512", "9513", "9514", "9515", "9516", "9517", "9518", "9519"],
            "South Cotabato": ["9500", "9501", "9502", "9503", "9504", "9505", "9506", "9507", "9508", "9509", "9510", "9511", "9512", "9513", "9514", "9515", "9516", "9517", "9518", "9519"],
            "Sultan Kudarat": ["9800", "9801", "9802", "9803", "9804", "9805", "9806", "9807", "9808", "9809", "9810", "9811", "9812", "9813", "9814", "9815", "9816", "9817", "9818", "9819"],
            "General Santos City": ["9500", "9501", "9502", "9503", "9504", "9505", "9506", "9507", "9508", "9509"]
        }
    },
    "Region XIII - Caraga": {
        provinces: {
            "Agusan del Norte": ["8600", "8601", "8602", "8603", "8604", "8605", "8606", "8607", "8608", "8609", "8610", "8611", "8612", "8613", "8614", "8615", "8616", "8617", "8618", "8619"],
            "Agusan del Sur": ["8500", "8501", "8502", "8503", "8504", "8505", "8506", "8507", "8508", "8509", "8510", "8511", "8512", "8513", "8514", "8515", "8516", "8517", "8518", "8519"],
            "Dinagat Islands": ["8410", "8411", "8412", "8413", "8414", "8415", "8416", "8417", "8418", "8419"],
            "Surigao del Norte": ["8400", "8401", "8402", "8403", "8404", "8405", "8406", "8407", "8408", "8409", "8410", "8411", "8412", "8413", "8414", "8415", "8416", "8417", "8418", "8419"],
            "Surigao del Sur": ["8300", "8301", "8302", "8303", "8304", "8305", "8306", "8307", "8308", "8309", "8310", "8311", "8312", "8313", "8314", "8315", "8316", "8317", "8318", "8319"]
        }
    },
    "Region IV-A - CALABARZON": {
    provinces: {
        "Cavite": [
            "4100", "4101", "4102", "4103", "4104", "4105", "4106", "4107", "4108", "4109", 
            "4110", "4111", "4112", "4113", "4114", "4115", "4116", "4117", "4118", "4119",
            "4120", "4121", "4122", "4123", "4124", "4125", "4126", "4127", "4128", "4129"
        ],
        "Laguna": [
            "4000", "4001", "4002", "4003", "4004", "4005", "4006", "4007", "4008", "4009",
            "4010", "4011", "4012", "4013", "4014", "4015", "4016", "4017", "4018", "4019",
            "4020", "4021", "4022", "4023", "4024", "4025", "4026", "4027", "4028", "4029"
        ],
        "Batangas": [
            "4200", "4201", "4202", "4203", "4204", "4205", "4206", "4207", "4208", "4209",
            "4210", "4211", "4212", "4213", "4214", "4215", "4216", "4217", "4218", "4219",
            "4220", "4221", "4222", "4223", "4224", "4225", "4226", "4227", "4228", "4229"
        ],
        "Rizal": [
            "1850", "1851", "1860", "1870", "1880", "1900", "1901", "1910", "1920", "1930",
            "1940", "1950", "1960", "1970", "1980", "1990"
        ],
        "Quezon": [
            "4300", "4301", "4302", "4303", "4304", "4305", "4306", "4307", "4308", "4309",
            "4310", "4311", "4312", "4313", "4314", "4315", "4316", "4317", "4318", "4319",
            "4320", "4321", "4322", "4323", "4324", "4325", "4326", "4327", "4328", "4329",
            "4330", "4331", "4332", "4333", "4334", "4335", "4336", "4337", "4338", "4339"
        ],
        "Lucena City": [
            "4300", "4301", "4302", "4303", "4304"
        ]
    }
},

"Region IV-B - MIMAROPA": {
    provinces: {
        "Marinduque": [
            "4900", "4901", "4902", "4903", "4904", "4905", "4906", "4907", "4908", "4909"
        ],
        "Occidental Mindoro": [
            "5100", "5101", "5102", "5103", "5104", "5105", "5106", "5107", "5108", "5109",
            "5110", "5111", "5112", "5113", "5114", "5115", "5116", "5117", "5118", "5119"
        ],
        "Oriental Mindoro": [
            "5200", "5201", "5202", "5203", "5204", "5205", "5206", "5207", "5208", "5209",
            "5210", "5211", "5212", "5213", "5214", "5215", "5216", "5217", "5218", "5219"
        ],
        "Palawan": [
            "5300", "5301", "5302", "5303", "5304", "5305", "5306", "5307", "5308", "5309",
            "5310", "5311", "5312", "5313", "5314", "5315", "5316", "5317", "5318", "5319",
            "5320", "5321", "5322", "5323", "5324", "5325", "5326", "5327", "5328", "5329"
        ],
        "Romblon": [
            "5500", "5501", "5502", "5503", "5504", "5505", "5506", "5507", "5508", "5509"
        ],
        "Puerto Princesa City": [
            "5300", "5301", "5302", "5303", "5304"
        ]
    }
}
    
    
};

        // Function to update provinces based on selected region
        function updateProvinces() {
            const regionSelect = document.getElementById('region');
            const provinceSelect = document.getElementById('province');
            const zipCodeSelect = document.getElementById('zip_code');
            
            // Clear existing options
            provinceSelect.innerHTML = '<option value="" disabled selected>Select Province</option>';
            zipCodeSelect.innerHTML = '<option value="" disabled selected>Select Zip Code</option>';
            
            // Get selected region
            const selectedRegion = regionSelect.value;
            
            if (selectedRegion && regionData[selectedRegion]) {
                // Add provinces for selected region
                const provinces = Object.keys(regionData[selectedRegion].provinces);
                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province;
                    option.textContent = province;
                    provinceSelect.appendChild(option);
                });
            }
        }

        // Function to update zip codes based on selected province
        function updateZipCodes() {
            const regionSelect = document.getElementById('region');
            const provinceSelect = document.getElementById('province');
            const zipCodeSelect = document.getElementById('zip_code');
            
            // Clear existing options
            zipCodeSelect.innerHTML = '<option value="" disabled selected>Select Zip Code</option>';
            
            // Get selected region and province
            const selectedRegion = regionSelect.value;
            const selectedProvince = provinceSelect.value;
            
            if (selectedRegion && selectedProvince && regionData[selectedRegion] && regionData[selectedRegion].provinces[selectedProvince]) {
                // Add zip codes for selected province
                const zipCodes = regionData[selectedRegion].provinces[selectedProvince];
                zipCodes.forEach(zipCode => {
                    const option = document.createElement('option');
                    option.value = zipCode;
                    option.textContent = zipCode;
                    zipCodeSelect.appendChild(option);
                });
            }
        }

        let carCount = 1;

        document.getElementById('add-car').addEventListener('click', function() {
            const container = document.getElementById('car-inputs');
            const id = `car-info-${carCount}`;
            const carInfoDiv = document.createElement('div');
            carInfoDiv.classList.add('car-info');
            carInfoDiv.setAttribute('id', id);

            carInfoDiv.innerHTML = `
                <div class="car-info-header">
                    <h5>Vehicle #${carCount + 1}</h5>
                    <button type="button" class="delete-car-btn" onclick="removeCar('${id}')">
                        <i class="fas fa-trash-alt"></i> Remove
                    </button>
                </div>
                
                <div class="car-info-grid">
                    <!-- Brand Input -->
                    <div class="input-group">
                        <label for="car_model_${carCount}"><i class="fas fa-tags"></i> Brand</label>
                        <div class="input-icon-wrapper">
                            <input id="car_model_${carCount}" name="car_model[]" list="carModels" required 
                                   pattern="[A-Za-z\s]+"
                                   title="Letters only (no numbers or symbols)"
                                   placeholder="e.g. Corolla, Civic"
                                   onkeydown="return /[a-zA-Z\s]/i.test(event.key)">
                        </div>
                    </div>

                    <!-- Model Type Input -->
                    <div class="input-group">
                        <label for="car_type_${carCount}"><i class="fas fa-car-side"></i> Model Type</label>
                        <div class="input-icon-wrapper">
                            <input id="car_type_${carCount}" name="car_type[]" list="carTypes" required 
                                   pattern="[A-Za-z\s]+"
                                   title="Letters only (no numbers or symbols)"
                                   placeholder="Type or select type"
                                   onkeydown="return /[a-zA-Z\s]/i.test(event.key)">
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(carInfoDiv);
            carCount++;
        });

        function removeCar(id) {
            const carInfoDiv = document.getElementById(id);
            if (carInfoDiv) {
                const container = document.getElementById('car-inputs');
                if (container.children.length === 1) {
                    alert('At least one vehicle information is required.');
                    return;
                }
                carInfoDiv.remove();
                // Update the numbering of remaining vehicles
                const vehicles = container.querySelectorAll('.car-info');
                vehicles.forEach((vehicle, index) => {
                    vehicle.querySelector('h5').textContent = index === 0 ? '' : `Vehicle #${index + 1}`;
                });
                carCount--;
            }
        }

        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const errorElement = document.getElementById('image-error');
            const preview = document.getElementById('image-preview');
            
            // Reset previous errors
            errorElement.style.display = 'none';
            errorElement.textContent = '';
            
            if (file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    errorElement.textContent = 'Only JPEG or PNG images are allowed.';
                    errorElement.style.display = 'block';
                    this.value = ''; // Clear the file input
                    return;
                }
                
                // Validate file size (5MB)
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                if (file.size > maxSize) {
                    errorElement.textContent = 'Image size must be less than 5MB.';
                    errorElement.style.display = 'block';
                    this.value = ''; // Clear the file input
                    return;
                }
                
                // Validate dimensions if needed
                const img = new Image();
                img.onload = function() {
                    if (this.width > 2000 || this.height > 2000) {
                        errorElement.textContent = 'Image dimensions must be less than 2000x2000 pixels.';
                        errorElement.style.display = 'block';
                        document.getElementById('image').value = ''; // Clear the file input
                    } else {
                        preview.src = URL.createObjectURL(file);
                        preview.style.display = 'block';
                    }
                };
                img.src = URL.createObjectURL(file);
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const registerForm = document.getElementById('registerForm');
            const registerBtn = document.getElementById('registerBtn');

            registerForm.addEventListener('submit', function () {
                registerBtn.disabled = true;
                registerBtn.innerHTML = `Registering...`;
            });

            document.querySelectorAll('.toggle-password').forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    const input = document.querySelector(this.getAttribute('toggle'));
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            });
        });
    </script>
</body>
</html>
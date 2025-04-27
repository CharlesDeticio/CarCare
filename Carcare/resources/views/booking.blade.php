<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nelson Automotive Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #222;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar a.active {
            background-color: #4CAF50;
            color: white;
        }
        .navbar .search {
            float: right;
            padding: 14px 20px;
        }
        .search input[type=text] {
            padding: 6px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
        }
        .container {
            position: relative;
            text-align: center;
            color: white;
        }
        .background-image {
            width: 100%;
            height: auto;
        }
        .content {
            position: absolute;
            top: 20%;
            left: 10%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
        .content h2 {
            color: red;
        }
        .content p {
            color: black;
        }
        .content a {
            display: inline-block;
            background-color: blue;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .content a:hover {
            background-color: darkblue;
        }
        .booking-details {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .booking-details .details {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .booking-details .details div {
            text-align: center;
        }
        .booking-details .details div p {
            margin: 5px 0;
        }
        .cancel-button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .cancel-button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>


    <div class="booking-details">
        <div class="details">
            <div>
                <p>Nelson's Automotive Shop</p>
            </div>
            <div>
                <p>Service:</p>
                <p>Belts Repair</p>
            </div>
            <div>
                <p><img src="calendar-icon.png" alt="Calendar" style="width: 20px;"> Fri, December 32</p>
            </div>
            <div>
                <button class="cancel-button">Cancel Booking</button>
            </div>
        </div>
    </div>

</body>
</html>


</x-app-layout>

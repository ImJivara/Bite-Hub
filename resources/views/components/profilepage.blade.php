<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include Tailwind CSS -->
    <script src="{{asset('jquery-3.7.1.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #FFFFFF;
            border-right: 1px solid #E5E7EB;
            padding-top: 4rem;
        }
        .sidebar-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .sidebar-item:hover {
            background-color: #F3F4F6;
        }
        /* Main Content Styles */
        .main-content {
            margin-left: 250px; /* Adjust according to sidebar width */
            padding: 2rem;
        }
    </style>
    <script>

    // Fetch account details using AJAX
    fetch('/Account/{{ $id }}')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('full_name_sidebar').innerHTML=data.account.full_name;
                $('#name').val(data.account.full_name);
                $('#email').val(data.account.email);
                $('#location').val(data.account.location);
                $('#password').val(data.account.password);
                document.getElementById('Name').innerHTML =data.account.full_name;
                document.getElementById('Email').innerHTML =data.account.email;
                document.getElementById('Location').innerHTML =data.account.location;
               
            } else {
                console.error('Failed to fetch account details:', data.message);
            }
        })
        .catch(error => console.error('Error fetching account details:', error));
</script>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar">
        <h1 class=""><a href="/Recipes"><--Back</h1></a>
        <!-- Profile Image -->
        <div class="p-4">
            <img class="w-16 h-16 rounded-full mx-auto" src="{{ asset('imgs/3.jpg') }}" alt="Profile Picture">
            <p class="text-center text-gray-800 mt-2" id="full_name_sidebar" >John Doe</p>
        </div>
        <!-- Sidebar Items -->
        <div class="mt-4">
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Edit Profile</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Change Password</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Account Settings</a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="text-gray-800 font-semibold">Logout</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Profile Information -->
        <div class="bg-white shadow-md rounded-lg p-8 mb-8">
            <h1 class="text-2xl font-semibold mb-4">Profile Information</h1>
            <div>
                <p class="text-gray-700"><span class="font-semibold">Name:</span> <span id="Name"></span></p>
                <p class="text-gray-700"><span class="font-semibold">Email:</span> <span id="Email"></span></p>
                <p class="text-gray-700"><span class="font-semibold">Location:</span> <span id="Location"></span></p>
            </div>
        </div>
<div id="accountDetails"></div>
        <!-- Edit Profile Form -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-semibold mb-4">Edit Profile</h1>
            <form action="#" method="POST">
                <!-- Form Inputs -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="text" id="password" name="password" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
                    <input type="text" id="location" name="location" class="border border-gray-300 rounded-md p-2 w-full">
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
   
</body>
</html>

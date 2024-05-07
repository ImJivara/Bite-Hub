<!DOCTYPE html>
<html>
<head>
    <style>
        /* Profile element styles */
        .profile-container {
            position: relative;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .profile-overlay:hover {
            background-color: rgba(0, 0, 0, 0.7); /* Darker overlay on hover */
        }

        .profile-text {
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Profile container -->
    <div class="profile-container">
        <!-- Profile image -->
        <img class="profile-image" src="profile.jpg" alt="Profile Picture">
        <!-- Profile overlay (clickable) -->
        <a href="profile.html" class="profile-overlay">
            <span class="profile-text">Profile</span>
        </a>
    </div>
</body>
</html>

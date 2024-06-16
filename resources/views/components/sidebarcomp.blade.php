
<head>
<script src="/resources/views/components/sidebar.blade.php" type="module"></script>
    <style>
        /* Sidebar toggle button styles */
        .sidebar-toggle {
            position: relative;
            width: 30px;
            height: 20px;
            cursor: pointer;
        }

        .sidebar-toggle-bar {
            position: absolute;
            width: 100%;
            height: 4px;
            background-color: #333; /* Bar color */
            transition: transform 0.3s ease;
        }

        .sidebar-toggle-bar:nth-child(1) {
            top: 0;
        }

        .sidebar-toggle-bar:nth-child(2) {
            top: 50%;
            transform: translateY(-50%);
        }

        .sidebar-toggle-bar:nth-child(3) {
            bottom: 0;
        }

        /* Sidebar toggle button animation when clicked */
        .sidebar-open .sidebar-toggle-bar:nth-child(1) {
            transform: translateY(50%) rotate(45deg);
        }

        .sidebar-open .sidebar-toggle-bar:nth-child(2) {
            opacity: 0;
        }

        .sidebar-open .sidebar-toggle-bar:nth-child(3) {
            transform: translateY(-50%) rotate(-45deg);
        }
    </style>
</head>

    <!-- Sidebar toggle button -->
    <div class="sidebar-toggle" id="sidebarToggleBtn" onclick="toggleSidebar()">
        <div class="sidebar-toggle-bar"></div>
        <div class="sidebar-toggle-bar"></div>
        <div class="sidebar-toggle-bar"></div>
    </div>



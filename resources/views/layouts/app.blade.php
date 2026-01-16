<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Maintain Admin Panel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #f4f7fe;
            color: #2d3436;
            margin: 0;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        /* Sidebar Glassmorphism */
        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: var(--primary-gradient);
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
            position: fixed;
            z-index: 1000;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 15px 25px;
            font-size: 1.1em;
            display: block;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: 0.3s;
            border-left: 4px solid transparent;
        }

        #sidebar ul li a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #fff;
        }

        #sidebar ul li.active > a {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #fff;
        }

        #sidebar ul li a i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        #content {
            width: calc(100% - var(--sidebar-width));
            margin-left: var(--sidebar-width);
            padding: 40px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            padding: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            padding: 25px;
            border-radius: 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .stat-card.bg-blue { background: linear-gradient(45deg, #2196F3, #21CBF3); }
        .stat-card.bg-purple { background: linear-gradient(45deg, #9b59b6, #e056fd); }
        .stat-card.bg-orange { background: linear-gradient(45deg, #f39c12, #f1c40f); }

        .stat-card i {
            position: absolute;
            right: -20px;
            top: -20px;
            font-size: 100px;
            opacity: 0.2;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(118, 75, 162, 0.4);
        }

        .table th {
            border-top: none;
            color: #7f8c8d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .badge-listed { background-color: #e1f7ec; color: #27ae60; }
        .badge-blacklisted { background-color: #fbeae9; color: #eb5757; }

        @media (max-width: 992px) {
            #sidebar {
                margin-left: -var(--sidebar-width);
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                width: 100%;
                margin-left: 0;
            }
            #content.active {
                margin-left: var(--sidebar-width);
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>RecordMaintain</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="{{ Request::routeIs('shop-owners.*') ? 'active' : '' }}">
                    <a href="{{ route('shop-owners.index') }}"><i class="fas fa-store"></i> Shop Owners</a>
                </li>
                <li class="{{ Request::routeIs('customers.*') ? 'active' : '' }}">
                    <a href="{{ route('customers.index') }}"><i class="fas fa-users"></i> Customers</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-4 mb-4 shadow-sm py-3 px-4">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary d-lg-none">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <div class="ms-auto d-flex align-items-center">
                        <span class="fw-bold"><i class="fas fa-user-circle me-2"></i> Admin</span>
                    </div>
                </div>
            </nav>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });
    </script>
</body>
</html>

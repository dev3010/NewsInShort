<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to News App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand {
            color: #fff;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .category-btn {
            transition: all 0.3s ease;
            border-radius: 25px;
            font-weight: 500;
        }

        .category-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            font-weight: 600;
            color: #333;
        }

        .card-text {
            color: #666;
        }

        .btn-primary {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #2575fc, #6a11cb);
        }

        .alert-warning {
            background: #fff3cd;
            border: none;
            border-radius: 10px;
            color: #856404;
        }

        .footer {
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            color: #fff;
            padding: 20px 0;
            margin-top: 50px;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Dark Mode Styles */
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .dark-mode .card {
            background-color: #1e1e1e;
            color: #ffffff;
        }

        .dark-mode .card-title {
            color: #ffffff;
        }

        .dark-mode .card-text {
            color: #b0b0b0;
        }

        .dark-mode .btn-outline-secondary {
            border-color: #ffffff;
            color: #ffffff;
        }

        .dark-mode .btn-outline-secondary:hover {
            background-color: #ffffff;
            color: #121212;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/">News App</a>
            <button id="dark-mode-toggle" class="btn btn-light ms-auto">🌙 Dark Mode</button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Loading Spinner -->
        <div id="loading-spinner" class="text-center my-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="text-center mt-5">
            <h4 class="mb-4">Explore News Categories</h4>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                @foreach($categories as $category)
                    <a href="#" class="btn btn-outline-secondary category-btn text-capitalize">{{ $category }}</a>
                @endforeach
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-5 mt-5">
            <input type="text" id="search-input" class="form-control" placeholder="Search articles...">
        </div>

        <!-- Latest News Section -->
        <h1 class="text-center mb-5">Latest News</h1>
        @if(count($articles) > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($articles as $article)
                    <div class="col">
                        <div class="card h-100 shadow">
                            @if($article['urlToImage'])
                                <img src="{{ $article['urlToImage'] }}" class="card-img-top" alt="{{ $article['title'] }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $article['title'] }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($article['description'], 100) }}</p>
                                <a href="{{ $article['url'] }}" target="_blank" class="btn btn-primary">Read More</a>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-secondary me-2">Share on Twitter</a>
                                    <a href="#" class="btn btn-sm btn-outline-secondary">Share on Facebook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        @else
            <div class="alert alert-warning text-center">No articles found.</div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">© 2023 News App. All rights reserved.</p>
            <p class="mb-0">
                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="btn btn-primary btn-lg rounded-circle shadow" style="position: fixed; bottom: 20px; right: 20px; display: none;">↑</button>

    <!-- JavaScript -->
    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const body = document.body;

        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            darkModeToggle.textContent = body.classList.contains('dark-mode') ? '☀️ Light Mode' : '🌙 Dark Mode';
        });

        // Hide Loading Spinner
        window.addEventListener('load', () => {
            document.getElementById('loading-spinner').style.display = 'none';
        });

        // Search Functionality
        document.getElementById('search-input').addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.card').forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const description = card.querySelector('.card-text').textContent.toLowerCase();
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Back to Top Button
        window.addEventListener('scroll', () => {
            const backToTopButton = document.getElementById('back-to-top');
            if (window.scrollY > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });

        document.getElementById('back-to-top').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $article->title }}</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .bg-primary-green {
      background-color: #198754;
    }
    .article-header {
      position: relative;
      margin-bottom: 2rem;
      margin-top: 5rem; 
    }
    .article-image {
      width: 100%;
      max-height: 400px; 
      object-fit: cover;
      border-radius: 8px;
    }
    .article-content {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #2d3436;
      text-align: justify;
      text-justify: inter-word;
      padding: 0 1rem;
    }
    .article-content p {
      margin-bottom: 1.5rem;
      text-indent: 2rem;
    }
    .meta-info {
      font-size: 0.9rem;
      color: #6c757d;
    }
    .back-button {
      color: #1a1a1a;
      transition: all 0.3s ease;
    }

    .article-title {
      font-size: 2rem;
      line-height: 1.4;
      color: #1a1a1a;
      margin-bottom: 1.5rem;
    }
    .navbar {
      background-color: #4CAF50 !important;
    }
  </style>
</head>
<body>
  <!-- Include Navbar Partial -->
  @include('partial.navbar')

  <!-- Content -->
  <div class="container">
    <!-- Back Button -->
    <a href="/articles" class="back-button text-decoration-none d-inline-flex align-items-center mt-4 mb-4">
      <i class="fas fa-arrow-left me-2"></i>Back to Articles
    </a>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <!-- Title -->
        <h1 class="article-title fw-bold">{{ $article->title }}</h1>

        <!-- Meta Info -->
        <div class="d-flex gap-4 meta-info mb-4">
          <div class="d-flex align-items-center">
            <i class="fas fa-user-circle me-2"></i>
            <span>{{ $article->user->name }}</span>
          </div>
          <div class="d-flex align-items-center">
            <i class="far fa-calendar-alt me-2"></i>
            <span>{{ $article->published_at->format('d M Y, H:i') }} WIB</span>
          </div>
        </div>

        <!-- Image -->
        @if($article->image)
          <div class="article-header mb-4">
            <img src="{{ asset('storage/' . $article->image) }}" 
                 alt="{{ $article->title }}"
                 class="article-image">
            <p class="text-muted mt-2 small fst-italic">Foto: {{ $article->title }}</p>
          </div>
        @endif

        <!-- Content -->
        <div class="article-content">
          {!! nl2br(e($article->content)) !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
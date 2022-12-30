<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Interview</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="/css/home.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-bg-dark">
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0">Interview</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <?php if (!isset($auth)) : ?>
            <a class="nav-link fw-bold py-1 px-0 <?=isset($isLoginPage)? 'active' : ''?>" <?=isset($isLoginPage)? 'aria-current="page"' : ''?> href="/">Login</a>
            <a class="nav-link fw-bold py-1 px-0 <?=isset($isRegPage)? 'active' : ''?>" <?=isset($isRegPage)? 'aria-current="page"' : ''?> href="/registration">Registration</a>
          <?php else : ?>
            <a class="nav-link fw-bold py-1 px-0" href="/logout">Logout</a>
          <?php endif; ?>
        </nav>
      </div>
    </header>
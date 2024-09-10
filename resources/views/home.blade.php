<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Versenykezelő</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="{{asset('app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light">

<x-user-login></x-user-login>

<div id="mainContent" class="container-fluid px-0" style="display: none;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item" id="adminControls" style="display: none;">
                        <button id="showModalButton" class="btn btn-primary">Új verseny</button>
                    </li>
                </ul>
                <button id="logoutButton" class="btn btn-outline-danger">Kijelentkezés</button>
            </div>
        </div>
    </nav>

    <!-- NEW COMPETITION MODAL -->
    <x-new-competition></x-new-competition>

    <!-- COMPETITIONS -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-center gap-3 flex-wrap custom-card-container" style="overflow: hidden"></div>
        </div>
    </div>
</div>

<div id="alertContainer" class="alert position-fixed top-0 end-0 m-3" role="alert" style="display: none; z-index: 1050;"></div>

</body>
</html>

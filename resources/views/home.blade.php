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
<body class="p-2">

<button type="button" id="myModal" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#newCompetition">Új verseny</button>
`
<!-- NEW COMPETITION MODAL -->
<x-new-competition></x-new-competition>

<!-- COMPETITIONS -->
<div class="d-flex justify-content-center gap-3 flex-wrap custom-card-container">
    @foreach(\App\Models\Competition::all() as $competition)
        <div class="col-md-4 custom-card">
            <x-competition-card :competition="$competition" />
        </div>
    @endforeach
</div>


<div id="alertContainer" class="alert" role="alert" style="display: none;"></div>
</body>
</html>

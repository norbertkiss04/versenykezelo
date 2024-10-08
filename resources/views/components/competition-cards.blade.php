@foreach($competitions as $competition)
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; width: 300px;">
        <div class="card-header bg-dark text-white py-4">
            <h5 class="mb-0 text-center">{{ $competition->name }}</h5>
        </div>
        <div class="card-body p-4">
            <div class="row align-items-center">
                <p class="card-text mb-2">
                    <strong>Év:</strong>
                    <span class="text-muted">{{ $competition->year }}</span>
                </p>
                <p class="card-text mb-2">
                    <strong>Nyermény:</strong>
                    <span class="text-success">${{ number_format($competition->prize_pool, 2) }}</span>
                </p>
                <p class="card-text mb-2">
                    <strong>Kezdődik:</strong>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($competition->start_date)->format('Y, M d') }}</span>
                </p>
                <p class="card-text mb-2">
                    <strong>Végződik:</strong>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($competition->end_date)->format('Y, M d') }}</span>
                </p>
            </div>

            <div class="mt-4">
                <h6>Fordulók:</h6>
                <ul class="list-group mb-3">
                    @foreach($competition->round as $round)
                        <li class="list-group-item cursor-pointer round" data-round-id="{{ $round->id }}">
                            {{ $round->round_number }}. Furduló
                        </li>
                    @endforeach
                </ul>
                <div data-admin-only="true" style="display: none;">
                    <button class="btn btn-outline-success add-round-btn mb-2" data-competition-id="{{ $competition->id }}">Forduló hozzáadása</button>
                    <button class="btn btn-outline-danger delete-competition-btn" data-competition-id="{{ $competition->id }}">Verseny törlése</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="card mb-4 border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
    <div class="card-header bg-dark text-white py-4">
        <h5 class="mb-0 text-center">{{ $competition->name }}</h5>
    </div>
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-8">
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
        </div>

        <div class="mt-4">
            <h6>Forduló:</h6>
            <ul class="list-group mb-3">
                @foreach($competition->round->sortBy('round_number') as $round)
                    <li class="list-group-item">{{ $round->round_number }}. Furduló</li>
                @endforeach
            </ul>
            <button class="btn btn-outline-success" onclick="addRound({{ $competition->id }})">Forduló hozzáadása</button>
        </div>
    </div>
</div>

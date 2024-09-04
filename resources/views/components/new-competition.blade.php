<div class="modal fade" id="newCompetition" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Új verseny hozzáadása</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="competitionForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Verseny neve</label>
                        <input type="text" class="form-control" id="name" />
                    </div>
                    <div class="d-flex justify-content-between gap-3">
                        <div class="mb-3 flex-grow-1">
                            <label for="year" class="form-label">Év</label>
                            <input type="text" class="form-control" id="year" />
                        </div>
                        <div class="mb-3 flex-grow-1">
                            <label for="prize" class="form-label">Nyeremény (HUF-ban)</label>
                            <input type="text" class="form-control" id="prize"/>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between gap-3">
                        <div class="mb-3 flex-grow-1">
                            <label for="start_date" class="form-label">Kezdődik</label>
                            <input type="date" class="form-control" id="start_date" />
                        </div>
                        <div class="mb-3 flex-grow-1">
                            <label for="end_date" class="form-label">Végződik</label>
                            <input type="date" class="form-control" id="end_date" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
                <button type="button" class="btn btn-primary" id="createButton">Hozzáadás</button>
            </div>
        </div>
    </div>
</div>

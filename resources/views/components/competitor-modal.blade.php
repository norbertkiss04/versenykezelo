<div class="modal fade" id="competitorsModal" tabindex="-1" aria-labelledby="competitorsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="competitorsModalLabel">Versenyzők</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="competitorsList" class="list-group mb-3">
                </ul>

                <select id="availableUsersDropdown" class="form-select mb-3" data-admin-only="true" style="display: none">
                    <option value="">Felhasználó</option>
                </select>
                <button id="addCompetitorButton" class="btn btn-primary" data-admin-only="true" style="display: none">Versenyző hozzáadása</button>
                <button id="deleteRoundButton" class="btn btn-danger mt-3" data-admin-only="true" style="display: none">
                    Forduló törlése
                </button>
            </div>
        </div>
    </div>
</div>

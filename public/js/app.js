function validateInput(competition) {
    const errors = [];
    if (typeof competition.name !== 'string' || competition.name.trim().length < 1 || competition.name.trim().length > 24) {
        errors.push('Hibás név');
    }
    if (isNaN(competition.year) || competition.year < 0 || competition.year > 2024) {
        errors.push('Hibás év');
    }
    if (isNaN(competition.prize_pool) || competition.prize_pool < 0 || competition.prize_pool > 100000000) {
        errors.push('Hibás nyeremény');
    }
    if (!isValidDate(competition.start_date)) {
        errors.push('Hibas kezdeti dátum');
    }
    if (!isValidDate(competition.end_date)) {
        errors.push('Hibas befejezési dátum');
    }
    if (isValidDate(competition.start_date) && isValidDate(competition.end_date) && new Date(competition.start_date) > new Date(competition.end_date)) {
        errors.push('A kezdési dátum nem lehet későbbi, mint a befejezési dátum');
    }
    //majd meg kell nezni hogy az adatbazisban nincs mar egy ilyen nev + ev kombinacio
    return errors;
}

function isValidDate(dateString) {
    const date = new Date(dateString);
    return !isNaN(date.getTime());
}

function showAlert(message, type) {
    const alertContainer = $('#alertContainer');
    alertContainer.removeClass();
    alertContainer.addClass(`alert alert-${type} alert-dismissible fade show`);
    alertContainer.text(message);
    alertContainer.show();

    setTimeout(() => {
        alertContainer.hide();
    }, 5000);
}

function addRound(competitionId) {
    $.post('/api/newRound', { competition_id: competitionId })
        .done(function(response) {
            showAlert('Sikeres hozzáadás', 'success');
            //render competition
        })
        .fail(function(error) {
            showAlert('A hozzáadás nem sikerült', 'danger');
        });
}

function addCompetition(data) {
    $.post('/api/newCompetition', data)
        .done(function(response) {
            showAlert('Sikeres hozzáadás', 'success');
            //render competition
        })
        .fail(function(error) {
            showAlert('A hozzáadás nem sikerült', 'danger');
        });
}

$(document).ready(function () {
    $('#newElement').on('show.bs.modal', () => $('#newForm')[0].reset());

    $('#createButton').on('click', () => {
        const name = $('#name').val().trim();
        const year = parseInt($('#year').val().trim());
        const prize_pool = parseFloat($('#prize').val().trim());
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();

        const data = { name, year, prize_pool, start_date, end_date };
        const errors = validateInput(data);

        if (errors.length === 0) {
            addCompetition(data);
        } else {
            showAlert('Hibák: ' + errors.join(', '), 'warning');
        }
    });
});

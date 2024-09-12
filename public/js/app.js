let userRole = null;
let currentRoundId = null;

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
        errors.push('Hibás kezdeti dátum');
    }
    if (!isValidDate(competition.end_date)) {
        errors.push('Hibás befejezési dátum');
    }
    if (isValidDate(competition.start_date) && isValidDate(competition.end_date) && new Date(competition.start_date) > new Date(competition.end_date)) {
        errors.push('A kezdési dátum nem lehet későbbi, mint a befejezési dátum');
    }
    return errors;
}

function isValidDate(dateString) {
    const date = new Date(dateString);
    return !isNaN(date.getTime());
}

function rerenderCards() {
    $.get('/competitions/render', function(data) {
        $('.custom-card-container').html(data);
        toggleAdminControls();
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX error: " + textStatus + ' : ' + errorThrown);
        showAlert('Failed to load competitions', 'danger');
    });
}

function showAlert(message, type) {
    const alertContainer = $('#alertContainer');
    alertContainer.removeClass().addClass(`alert alert-${type} alert-dismissible fade show`);
    alertContainer.text(message);
    alertContainer.show();

    setTimeout(() => {
        alertContainer.hide();
    }, 5000);
}

function toggleAdminControls() {
    if (userRole === 'admin') {
        $('#adminControls').show();
        $('[data-admin-only="true"]').show();
    } else {
        $('#adminControls').hide();
        $('[data-admin-only="true"]').hide();
    }
}

function addRound(competitionId) {
    if (userRole !== 'admin') {
        showAlert('Csak adminok adhatnak hozzá fordulókat', 'warning');
        return;
    }

    $.ajax({
        url: '/api/newRound',
        method: 'POST',
        data: {
            competition_id: competitionId
        },
        headers: {
            'X-User-Role': userRole
        },
        success: function(response) {
            showAlert('Sikeres hozzáadás', 'success');
            rerenderCards();
        },
        error: function(error) {
            showAlert('A hozzáadás nem sikerült', 'danger');
            console.log(error);
        }
    });
}

function addCompetition(data) {
    if (userRole !== 'admin') {
        showAlert('Csak adminok adhatnak hozzá versenyeket', 'warning');
        return;
    }

    $.ajax({
        url: '/api/newCompetition',
        method: 'POST',
        data: data,
        headers: {
            'X-User-Role': userRole
        },
        success: function(response) {
            showAlert('Sikeres hozzáadás', 'success');
            rerenderCards();
            $('#newCompetition').modal('hide');
            $('#competitionForm')[0].reset();
        },
        error: function(error) {
            showAlert('A hozzáadás nem sikerült', 'danger');
        }
    });
}

function login(username) {
    $.post('/api/login', {
        username: username
    })
        .done(function(response) {
            if (response.success) {
                userRole = response.role;
                localStorage.setItem('userRole', userRole);
                showMainContent();
            } else {
                showAlert(response.message, 'danger');
            }
        })
        .fail(function(error) {
            showAlert('Login failed', 'danger');
        });
}

function logout() {
    userRole = null;
    localStorage.removeItem('userRole');
    showLoginForm();
}

function showLoginForm() {
    $('#loginContainer').show();
    $('#mainContent').hide();
}

function showMainContent() {
    $('#loginContainer').hide();
    $('#mainContent').show();
    toggleAdminControls();
    rerenderCards();
}

function loadCompetitors(roundId) {
    $.get(`/api/competitors/${roundId}`, function(response) {
        $('#competitorsList').empty();
        response.forEach(function(competitor) {
            $('#competitorsList').append(`
                    <li class="list-group-item d-flex justify-content-between">
                        ${competitor.username}
                        <button id="adminControls" class="btn btn-danger btn-sm remove-competitor-btn" data-admin-only="true" data-user-id="${competitor.id}" style="display: none">
                            Törlés
                        </button>
                    </li>
                `);
        });

        $('#competitorsModal').modal('show');
        toggleAdminControls();
    });
}


function loadAvailableUsers(roundId) {
    $.get(`/api/availableUsers/${roundId}`, function(response) {
        $('#availableUsersDropdown').empty();
        $('#availableUsersDropdown').append('<option value="">Felhaszanáló</option>');
        response.forEach(function(user) {
            $('#availableUsersDropdown').append(`<option value="${user.id}">${user.username}</option>`);
        });
    });
}

function deleteRound(roundId) {
    if (userRole !== 'admin') {
        showAlert('Csak adminok törölhetnek fordulókat', 'warning');
        return;
    }

    if (confirm('Biztosan törölni szeretnéd ezt a fordulót?')) {
        $.ajax({
            url: '/api/rounds/' + roundId,
            method: 'DELETE',
            headers: {
                'X-User-Role': userRole
            },
            success: function(response) {
                showAlert('Forduló sikeresen törölve', 'success');
                $('#competitorsModal').modal('hide');
                rerenderCards();
            },
            error: function(error) {
                showAlert('A törlés sikertelen volt', 'danger');
            }
        });
    }
}

$(document).ready(function() {
    userRole = localStorage.getItem('userRole');
    if (userRole) {
        showMainContent();
    } else {
        showLoginForm();
    }

    $(document).on('click', '.add-round-btn', function() {
        let competitionId = $(this).data('competition-id');
        addRound(competitionId);
    });

    $('#loginButton').on('click', function() {
        const username = $('#username').val().trim();
        if (username.length === 0) {
            showAlert('Felhasználónév nem lehet üres', 'danger');
            return;
        }
        login(username);
    });

    $('#logoutButton').on('click', function() {
        logout();
    });

    $('#showModalButton').click(function() {
        $('#newCompetition').modal('show');
    });


    $('#deleteRoundButton').on('click', function() {
        deleteRound(currentRoundId);
    });

    $('#createButton').on('click', () => {
        if (userRole !== 'admin') {
            showAlert('Csak adminok adhatnak hozzá versenyeket', 'warning');
            return;
        }

        const name = $('#name').val().trim();
        const year = parseInt($('#year').val().trim());
        const prize_pool = parseFloat($('#prize').val().trim());
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();

        const data = {
            name,
            year,
            prize_pool,
            start_date,
            end_date
        };
        const errors = validateInput(data);

        if (errors.length === 0) {
            addCompetition(data);
        } else {
            showAlert('Hibák: ' + errors.join(', '), 'warning');
        }
    });

    $(document).on('click', '.round', function() {
        currentRoundId = $(this).data('round-id');
        loadCompetitors(currentRoundId);
        loadAvailableUsers(currentRoundId);
    });

    $('#addCompetitorButton').on('click', function() {
        const userId = $('#availableUsersDropdown').val();
        if (!userId) {
            showAlert('Válassz ki egy felhasználót', 'warning');
            return;
        }

        $.ajax({
            url: '/api/competitors',
            method: 'POST',
            data: { round_id: currentRoundId, user_id: userId },
            success: function(response) {
                showAlert("Hozzáadás sikeres.", 'success');
                loadCompetitors(currentRoundId);
                loadAvailableUsers(currentRoundId);
            },
            error: function(error) {
                showAlert('Hozzáadás sikertelen.', 'danger');
            }
        });
    });

    $(document).on('click', '.remove-competitor-btn', function() {
        const userId = $(this).data('user-id');
        if (confirm('Biztosan ki szeretnéd törölni ezt a versenyzőt erről a körről?')) {
            $.ajax({
                url: '/api/competitors',
                method: 'DELETE',
                data: { round_id: currentRoundId, user_id: userId },
                success: function(response) {
                    showAlert("Törlés sikeres", 'success');
                    loadCompetitors(currentRoundId);
                    loadAvailableUsers(currentRoundId);
                },
                error: function(error) {
                    showAlert('A törlés sikertelen volt', 'danger');
                }
            });
        }
    });

    $(document).on('click', '.delete-competition-btn', function() {
        const competitionId = $(this).data('competition-id');

        if (confirm('Biztosan törölni szeretnéd ezt a versenyt?')) {
            $.ajax({
                url: '/api/competitions/' + competitionId,
                method: 'DELETE',
                headers: {
                    'X-User-Role': userRole
                },
                success: function(response) {
                    showAlert('Verseny sikeresen törölve', 'success');
                    rerenderCards();
                },
                error: function(error) {
                    showAlert('A törlés sikertelen volt', 'danger');
                }
            });
        }
    });

});

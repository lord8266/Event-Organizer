M.Dropdown.init( $('.dropdown-trigger')[0]);

$('#logout').click(() => {
    $.post('server/api_layer.php', {
        kind: "logout"
    }, (data, status) => {
        window.location.href = "index.php"
    });
})

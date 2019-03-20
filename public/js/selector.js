$(document).ready(function () {
    $('#options').multiSelect();

    let ids = [];
    grupo.forEach(usuario => {
        ids.push(usuario.idUsuario+'')
    });
    $('#options').multiSelect('select', ids)   

    
});

$(document).ready(function () {
    document.getElementById("myChart").onclick = function (evt) {
        let activePoints = myChart.getElementsAtEventForMode(evt, 'point', myChart.options);
        let firstPoint = activePoints[0];
        try {
            let label = myChart.data.labels[firstPoint._index];
            modal(label)
        } catch (error) {}
    };

    function modal(id) {
        $('#exampleModalLong').modal('show');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "/modal/",
            data: {
                idQuestao: id,
                idProjeto: projeto
            },
            success: function (msg) {
                dataModal(msg, id)
            }
        });

    }

    function dataModal(data, id) {
        let corpo = '';
        let titulo;
        $.each(data, function (key, item) {
            titulo = "<b>Q" + item[0].prefixo + id + "</b> - " + key;
            item.forEach(obj => {
                corpo += '<tr><th scope="row">' + obj.name + '</th><td>' + obj.nota + '</td></tr>';
            });
        });

        $('#participantes').html(corpo);
        $('#modal-title').html(titulo);
    }
});

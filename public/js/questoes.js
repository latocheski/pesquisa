$(document).ready(function () {
    var slider = [],
        output = []

    questoes.forEach(quest => {
        slider.push(document.getElementById(quest.idq))
        output.push(document.getElementById(quest.idq + "s"))
        if (novo == 1) {
            $("#" + quest.idq).val(quest.nota)
        }


    });
    for (let index = 0; index < slider.length; index++) {

        output[index].innerHTML = slider[index].value;
        slider[index].oninput = function () {
            output[index].innerHTML = this.value;
        }
    }
});

$(document).ready(function () {

    var slider = [],
        output = []

    $.each(questoes, function (key, item) {
        slider.push(document.getElementById(item.id))
        output.push(document.getElementById(item.id + "s"))
    });

    for (let index = 0; index < slider.length; index++) {

        output[index].innerHTML = slider[index].value;

        slider[index].oninput = function () {
            output[index].innerHTML = this.value;
        }
    }
});
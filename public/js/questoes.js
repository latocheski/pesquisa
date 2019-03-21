var slider = document.getElementById("stema");

var output = document.getElementById("tema");

output.innerHTML = slider.value;

slider.oninput = function () {
    output.innerHTML = this.value;
}


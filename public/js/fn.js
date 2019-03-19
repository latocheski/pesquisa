var slider = document.getElementById("stema");
var slider1 = document.getElementById("srea");
var slider2 = document.getElementById("sensino");
var slider3 = document.getElementById("sconhecimento");
var slider4 = document.getElementById("spratica");
var slider5 = document.getElementById("sformacao");
var slider6 = document.getElementById("sprojeto");

var output = document.getElementById("tema");
var output1 = document.getElementById("rea");
var output2 = document.getElementById("ensino");
var output3 = document.getElementById("conhecimento");
var output4 = document.getElementById("pratica");
var output5 = document.getElementById("formacao");
var output6 = document.getElementById("projeto");

output.innerHTML = slider.value;
output1.innerHTML = slider1.value;
output2.innerHTML = slider2.value;
output3.innerHTML = slider3.value;
output4.innerHTML = slider4.value;
output5.innerHTML = slider5.value;
output6.innerHTML = slider6.value;

slider.oninput = function () {
    output.innerHTML = this.value;
}
slider1.oninput = function () {
    output1.innerHTML = this.value;
}
slider2.oninput = function () {
    output2.innerHTML = this.value;
}
slider3.oninput = function () {
    output3.innerHTML = this.value;
}
slider4.oninput = function () {
    output4.innerHTML = this.value;
}
slider5.oninput = function () {
    output5.innerHTML = this.value;
}
slider6.oninput = function () {
    output6.innerHTML = this.value;
}

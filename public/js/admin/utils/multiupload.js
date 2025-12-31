$(document).ready(function () {
    $("input.input-upload").change(function () {
        var id = $(this).attr("id").match(/[0-9]/);
        PreviewImage(id[0]);
    });
});

function PreviewImage(no) {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("file-" + no).files[0]);

    oFReader.onload = function (oFREvent) {
        var img = document.createElement("IMG");
        img.setAttribute("src", oFREvent.target.result);
        img.setAttribute("width", 119);
        img.setAttribute("height", 67);

        document.getElementById("upload-preview-" + no).textContent = "";
        document.getElementById("upload-preview-" + no).appendChild(img);
    };
}

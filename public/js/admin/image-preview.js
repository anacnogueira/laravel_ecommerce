document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("upload").addEventListener("change", function () {
        displayImagePreview(this);
    });

    function displayImagePreview(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("imagePreview").innerHTML =
                    '<img src="' +
                    e.target.result +
                    '" width="200" alt="Profile Image Preview">';
            };
            reader.readAsDataURL(file);
        }
    }
});

import '../styles/app.css';

// Show filename on inputs
const inputs = document.querySelectorAll("input[type='file']");

inputs.forEach(((input) => {
    input.setAttribute("lang", "es");

    input.addEventListener('change', (event) => {
        var inputFile = event.currentTarget;
        $(inputFile).parent()
            .find('.custom-file-label')
            .html(inputFile.files[0].name);
    });
}));
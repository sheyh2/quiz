$(document).ready(function () {
    let currentTestId = parseInt(localStorage.getItem('currentTestId'));

    if (isNaN(currentTestId)) {
        currentTestId = 1;

        localStorage.setItem('currentTestId', currentTestId.toString());
    }

    let testSelector = '#test' + currentTestId;
    let lastTestId = parseInt($('.border').first().attr('data-last'));
    $(testSelector).removeClass('d-none');

    $('#next').on('click', function () {
        currentTestId = parseInt(localStorage.getItem('currentTestId'));

        if (currentTestId < lastTestId) {
            currentTestId = addOrRemoveDNonClass(currentTestId,1);
        }

        if (currentTestId === lastTestId) {
            $(this).addClass('disabled');
        }

        if (currentTestId !== 1) {
            $('#prev').removeClass('disabled');
        }
    });

    $('#prev').on('click', function () {
        currentTestId = parseInt(localStorage.getItem('currentTestId'));

        if (currentTestId > 1) {
            currentTestId = addOrRemoveDNonClass(currentTestId,-1);
        }

        if (currentTestId === 1) {
            $(this).addClass('disabled');
        }

        if (currentTestId !== lastTestId) {
            $('#next').removeClass('disabled');
        }
    });

    $('input[type=radio]').on('change', function (e) {
        console.log($(this).val());
    });
});

function addOrRemoveDNonClass(currentTestId, number)
{
    let currentSelector = '#test' + currentTestId;
    let testSelector = '#test' + (currentTestId + number);

    $(currentSelector).addClass('d-none');
    $(testSelector).removeClass('d-none');

    currentTestId = currentTestId + number;
    localStorage.setItem('currentTestId', (currentTestId).toString());

    return currentTestId;
}
document.addEventListener('DOMContentLoaded', () => {
    $('.showEditBlock').click(function(){
        let id = $(this).data('id');
        $(`#editBlock${id}`).toggleClass('d-none');

        $(this).find('i').toggleClass('bi-pen').toggleClass('bi-x');
    });
});
import './bootstrap';

 $(document).ready(function(){
    $('.dropdown').on('click',function(){
        $(this).find('.dropdown-menu').toggle();
        // $(this).find('.dropdown-menu').toggle();
        $('body').on('click', function (e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').hide();
            }
        });
        });
    })
    $('#moonButton').on('click', function() {
        $('body').toggleClass('bg-dark text-white');
});



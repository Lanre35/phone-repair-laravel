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

    $('#moonButton').on('click', function() {
        $('body').toggleClass('bg-dark text-white');
    });

    //     e.preventDefault();
    //     const searchValue = $('#searchFilter').val();
        
    //     $.ajax({
    //         url: $('#searchForm').attr('action'),
    //         method: 'GET',
    //         data: { search: searchValue },
    //         success: function(response) {
    //             // Handle the successful response
    //             $('td').filter(function() {
    //                 return $(this).text().toLowerCase().startsWith(searchValue.toLowerCase());
    //             }).parent().hide();
    //             $('td').filter(function() {
    //                 return $(this).text().toLowerCase().startsWith(searchValue.toLowerCase());
    //             }).parent().show();
                
    //         },
    //         error: function(xhr) {
    //             // Handle errors
    //             console.error('Search error:', xhr);
    //         }
    //     });
    // });

    $('#searchFilter').on('input', function(e) {
        e.preventDefault();
        const searchValue = $(this).val();

        $.ajax({
            url: $('#searchForm').attr('action'),
            method: 'GET',
            data: { search: searchValue },
            success: function(response) {
                $('tbody').html(response.tableHtml);
                // Handle the successful response
                // Show rows that start with the search value
                $('td').filter(function() {
                    return !$(this).text().toLowerCase().endsWith(searchValue.toLowerCase());
                }).parent().hide();
                $('td').filter(function() {
                    return $(this).text().toLowerCase().endsWith(searchValue.toLowerCase());
                }).parent().show();
            },
            error: function(xhr) {
                console.error('Search error:', xhr);
            }
        });
    }).on('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            return false;
        }
    });

    // $('#statusFilter').on( function() {
    //     const status = $(this).val();

    //     $.ajax({
    //         url: 'search-by-status',
    //         method: 'GET',
    //         data: { status: status },
    //         success: function(response) {
    //             $('tbody').each(function() {
    //                 console.log($(this).html(response.tableHtml));
    //             });
    //             // Handle the successful response
    //             // Show rows that match the selected status
    //             $('td').filter(function() {
    //                 return !$(this).text().toLowerCase().includes(status.toLowerCase());
    //             }).parent().hide();
    //             $('td').filter(function() {
    //                 return $(this).text().toLowerCase().includes(status.toLowerCase());
    //             }).parent().show();
                
    //         },
    //         error: function(xhr) {
    //             console.error('Search error:', xhr);
    //         }
    //     });
        
    // });
});


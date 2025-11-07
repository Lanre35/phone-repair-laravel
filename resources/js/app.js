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



    $('#searchFilter').on('input', function(e) {
        e.preventDefault();
        const searchValue = $(this).val();
        const noSearch = $('#noSearch');

        $.ajax({
            url: $('#searchForm').attr('action'),
            method: 'GET',
            data: { search: searchValue },
            success: function(response) {

                $('tbody').html(response.tableHtml);

                // console.log($('tbody').html(response.tableHtml));

                // Handle the successful response
                // Show rows that start with the search value

                $('td').filter(function() {
                    if(!$(this).text().toLowerCase().endsWith(searchValue.toLowerCase())){
                        return noSearch.text('No repairs found.');
                    }
                    noSearch.text('');
                }).parent().hide();
                $('td').filter(function() {
                    if($(this).text().toLowerCase().endsWith(searchValue.toLowerCase())){
                        return noSearch.text(''); ;
                    }

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



    $('#date').on('click', function(e) {
        e.preventDefault();
        const dateValue = $('#dateFilter').val();

        $.ajax({
            url: '/search-by-date',
            method: 'GET',
            data: { date: dateValue },
            success: function(response) {

                $('tbody').html(response.tableHtml);
                // Handle the successful response
                // Show rows that match the date value
                $('td').filter(function() {
                    if(!$(this).text().toLowerCase().includes(dateValue.toLowerCase())){
                        return $('#noSearch').text('No repairs found for this date.');
                    }
                    $('#noSearch').text('');
                }).parent().hide();
                $('td').filter(function() {
                    if($(this).text().toLowerCase().includes(dateValue.toLowerCase())){
                        return $('#noSearch').text(''); ;
                    }

                }).parent().show();
            },
            error: function(xhr) {
                console.error('Date search error:', xhr);
            }
        });
    });
});




document.addEventListener('DOMContentLoaded', function() {
    var toastEl = document.getElementById('successToast');
    if (toastEl) {
        var toast = new bootstrap.Toast(toastEl, { delay: 1000 });
        toast.show();
    }
});

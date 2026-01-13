jQuery(document).ready(function($) {
    // Add CSS for loading state
    $('<style>.loading { position: relative; opacity: 0.6; }.loading:after { content: ""; position: absolute; top: 50%; left: 50%; width: 30px; height: 30px; margin: -15px 0 0 -15px; border: 3px solid rgba(0,0,0,0.1); border-top-color: #333; border-radius: 50%; animation: spin 0.6s linear infinite; } @keyframes spin { to { transform: rotate(360deg); } }</style>').appendTo('head');
    var currentPage = 1;
    var loading = false;
    var currentCount = $('#career-list tr').length || 0;
    var perPage = parseInt($('#career-list').data('per-page')) || 4;
    var taxonomy = $('#load-more-btn').data('taxonomy');
    var termId = $('#load-more-btn').data('term-id');
    
    // Year filter AJAX functionality
    $('#year-filter').on('change', function() {
        var selectedYear = $(this).val();
        var categoryId = $(this).data('category-id');
        
        if (loading) return;
        loading = true;
        
        $('.box-relationship .body').addClass('loading');
        
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_files_by_year',
                year: selectedYear,
                category_id: categoryId,
                nonce: ajax_object.nonce
            },
            success: function(response) {
                $('.box-relationship .body').html(response);
                loading = false;
                $('.box-relationship .body').removeClass('loading');
            },
            error: function() {
                loading = false;
                $('.box-relationship .body').removeClass('loading');
                console.log('Error filtering files by year');
            }
        });
    });
    
    $('#load-more-btn').on('click', function(e) {
        e.preventDefault();
        
        if (loading) return;
        loading = true;
        
        // Show loading indicator
        $('#career-list').addClass('loading');
        
        currentPage++;
        
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_careers',
                page: currentPage,
                count: currentCount,
                per_page: perPage,
                taxonomy: taxonomy,
                term_id: termId,
                nonce: ajax_object.nonce
            },
            success: function(response) {
                if (response.trim() === '') {
                    $('#load-more-container').hide();
                } else {
                    $('#career-list').append(response);
                    // Update the count for next load
                    currentCount = $('#career-list tr').length;
                }
                loading = false;
                // Remove loading indicator
                $('#career-list').removeClass('loading');
            },
            error: function() {
                loading = false;
                // Remove loading indicator on error too
                $('#career-list').removeClass('loading');
                console.log('Error loading more careers');
            }
        });
    });
});
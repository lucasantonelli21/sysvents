$(".index-pages", function() {
    var $page = $(this);
    var $pagination = $page.find('.paginator-selector');
    var $formPagination = $page.find('.form-pagination');
    var $formFilter = $page.find('.form-filter')
    var $inputs = $page.find('.form-control');

    $pagination.on('change', function() {
        $inputs.each(function() {
            var $input = $(this);
            var inputName = $input.attr('name');
            var inputValue = $input.val();
            // Adiciona um campo oculto ao formulário com o nome e valor do input
            $formPagination.append($('<input>').attr({
                type: 'hidden',
                name: inputName,
                value: inputValue
            }));
        });
        $formPagination.submit();
    });


    $formFilter.on('submit', function() {
        $formFilter.append($('<input>').attr({
            type: 'hidden',
            name: 'pagination',
            value: $pagination.val()
        }));
    });
});
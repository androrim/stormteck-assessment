(function ($) {

    $(document).ready(function () {

        $('.authors').find('.delete').click(function (e) {
            e.preventDefault();

            var link = $(this).attr('href');

            $.confirm({
                title: 'Excluir autor?',
                content: 'Para excluir este autor é preciso confirmar.',
                type: 'red',
                buttons: {
                    ok: {
                        text: "Excluir",
                        btnClass: 'btn btn-danger',
                        keys: ['enter'],
                        action: function (e) {
                            window.location.href = link;
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                        keys: ['esc']
                    }
                }
            });
        });

    });

})(jQuery);



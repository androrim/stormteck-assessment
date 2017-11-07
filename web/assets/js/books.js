(function ($) {

    $(document).ready(function () {

        $('.books').find('.delete').click(function (e) {
            e.preventDefault();

            var link = $(this).attr('href');

            $.confirm({
                title: 'Excluir livro?',
                content: 'Para excluir este livro é preciso confirmar.',
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
            })
        });

    });

})(jQuery);



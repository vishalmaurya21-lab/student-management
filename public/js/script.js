$(document).ready(function () {

    let timer;

    $('#search').on('keyup', function () {

        clearTimeout(timer);

        let search = $(this).val();

        // Fixed: URL now read from data-url attribute on #student-table (Blade syntax doesn't work in .js files)
        let url = $('#student-table').data('url');

        timer = setTimeout(function () {

            $.ajax({
                url: url,
                type: "GET",
                data: { search: search },

                success: function (response) {
                    console.log("AJAX success");

                    $('#student-table').html(
                        $(response).find('#student-table').html()
                    );
                },

                error: function () {
                    console.log("AJAX error");
                }

            });

        }, 300);

    });

});
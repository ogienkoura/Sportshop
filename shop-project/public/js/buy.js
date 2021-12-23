$.fn.Buy = function () {
    let container = $(this);
    let methods = {
        initEvents: function () {
            container.find('button.buy-button').on('click', methods.addToCart);
        },
        addToCart: function (e) {
            e.stopPropagation();
            e.preventDefault();


            $.ajax({
                url: '/cart',
                type: "GET",
                data: $(this).data(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });



            console.log($(this).data());
        }
    }
    methods.initEvents();
}

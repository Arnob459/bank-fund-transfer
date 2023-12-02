$(function () {



    $('.action-create').on('click', function () {
        $('.icp-auto').iconpicker();

        $('.icp-dd').iconpicker({
            //title: 'Dropdown with picker',
            //component:'.btn > i'
        });

    }).trigger('click');

});
$(document).ready(function () {

    if ($('.bxslider').length > 0) {
        $('.bxslider').bxSlider({
            auto: true,
            // controls: false,
            pager: false,
            speed: 800
        })
    }

    if ($('.countdown-timer').length > 0) {
        $('#clock').dsCountDown({
            endDate: new Date("December 09, 2018 23:59:59"),
            onFinish: function () {
                $('#clock').hide()
            }
        })
    }

    $('.no-enter input, .no-enter textarea').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault()
            return false
        }
    });

    if ($('.dt').length > 0) {
        $('.dt').DataTable({
            ordering: false, 
            aaSorting: []
        })
    }

    /* Password toggle */
    $('#password-toggle').change(function (e) {
        var target = document.getElementById('signup-pwd')
        target.type = target.type === 'password' ? 'text' : 'password'
    })

    /* Preserve tab state */
    if(window.location.hash) {
        $("a[href='" + window.location.hash + "']").trigger('click')

        $('.nav-tabs a[href="#' + window.location.hash + '"]').tab('show')
    }
})
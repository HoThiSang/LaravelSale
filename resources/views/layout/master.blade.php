<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetaDesign &mdash; Product</title>
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/source/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="/source/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" title="style" href="/source/assets/dest/css/style.css">
    <link rel="stylesheet" href="/source/assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="/source/assets/dest/css/huong-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">



    @yield('css')
</head>

<body>
    @include('components.header')
    @yield('banner')
    @yield('content')
    @include('components.footer')


    <!-- include js files -->
    <script src="/source/assets/dest/js/jquery.js"></script>
    <script src="/source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="/source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="/source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="/source/assets/dest/vendors/animo/Animo.js"></script>
    <script src="/source/assets/dest/vendors/dug/dug.js"></script>
    <script src="/source/assets/dest/js/scripts.min.js"></script>


    <!--customjs-->
    <script type="text/javascript">
        $(function() {
            var url = window.location.href;

            $(".main-menu a").each(function() {
         
                if (url == (this.href)) {
                    $(this).closest("li").addClass("active");
                    $(this).parents('li').addClass('parent-active');
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            'use strict';

            // color box

            //color
            jQuery('#style-selector').animate({
                left: '-213px'
            });

            jQuery('#style-selector a.close').click(function(e) {
                e.preventDefault();
                var div = jQuery('#style-selector');
                if (div.css('left') === '-213px') {
                    jQuery('#style-selector').animate({
                        left: '0'
                    });
                    jQuery(this).removeClass('icon-angle-left');
                    jQuery(this).addClass('icon-angle-right');
                } else {
                    jQuery('#style-selector').animate({
                        left: '-213px'
                    });
                    jQuery(this).removeClass('icon-angle-right');
                    jQuery(this).addClass('icon-angle-left');
                }
            });
        });
    </script>
    <script>

        var successMessage = "{{ session('success') }}";
        var errorMessage = "{{ session('error') }}";


        if (successMessage) {
       
            alert(successMessage);
        }


        if (errorMessage) {

            alert(errorMessage);
        }
    </script>
    @yield('js');
</body>

</html>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{ get_title() }}
        {{  stylesheet_link('css/custom.css') }}
        <!-- Awesome Fonts -->
        {{  stylesheet_link('font-awesome/css/font-awesome.min.css') }}


    </head>
    <body>
        {{ content() }}
        <!-- jQuery -->
        {{ javascript_include('js/jquery.js') }}
        <!-- Bootstrap Core JavaScript -->
        {{ javascript_include('js/bootstrap.min.js') }}
    </body>
</html>

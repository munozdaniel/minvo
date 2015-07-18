<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{ get_title() }}
        {% block head %}
        {{  stylesheet_link('css/custom.css') }}
        <!-- Awesome Fonts -->
        {{  stylesheet_link('font-awesome/css/font-awesome.min.css') }}
        {% endblock %}


    </head>
    <body>
        {{ content() }}

        {% block script %}
            <!-- jQuery -->
            {{ javascript_include('js/jquery.js') }}
            <!-- Bootstrap Core JavaScript -->
            {{ javascript_include('js/bootstrap.min.js') }}
        {% endblock %}
    </body>
</html>

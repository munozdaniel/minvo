<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{ get_title() }}
        {{  stylesheet_link('css/custom.css') }}
        {{ javascript_include('bower_components/jquery/jquery.min.js') }}
        {% block head %}
            <!-- Awesome Fonts -->
            {{  stylesheet_link('font-awesome/css/font-awesome.min.css') }}
        {% endblock %}


    </head>
    <body>
        {{ content() }}

        {% block script %}
            <!-- jQuery -->

            <!-- Bootstrap Core JavaScript -->
            {{ javascript_include('js/bootstrap.min.js') }}
        {% endblock %}
    </body>
</html>

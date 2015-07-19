{% block head %}

    {{ javascript_include('bower_components/moment/moment.js') }}
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>    {{ stylesheet_link('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}
    {{ javascript_include('bower_components/moment/locale/es.js') }}
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
{% endblock %}
<div class="col-sm-12">



    <ol class="breadcrumb">
        <li>{{ link_to("calendario", '<i class="fa fa-calendar"></i> Calendario')}}</li>
    </ol>
    <h1 class="text-center heading">Añadir un nuevo evento</h1><hr>
    {{ form('evento/guardar') }}
    <div class='col-md-6'>
        <div class="form-group">
            <div class='input-group date' id='from'>
                <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
        </div>
    </div>
    <div class='col-md-6'>
        <div class="form-group">
            <div class='input-group date' id='to'>
                <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="url" class="col-sm-12 control-label">Enlace al evento</label>
        <div class="col-sm-12">
            <input type="url" name="url" class="form-control" id="url" placeholder="Introduce una url o no :)">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-12 control-label">Tipo de evento</label>
        <div class="col-sm-12">
            <select class="form-control" name="class">
                <option value="event-info">Info</option>
                <option value="event-success">Success</option>
                <option value="event-inverse">Inverse</option>
                <option value="event-important">Important</option>
                <option value="event-warning">Warning</option>
                <option value="event-special">Special</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-12 control-label">Título</label>
        <div class="col-sm-12">
            <input type="text" name="title" class="form-control" id="title" placeholder="Introduce un título">
        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-sm-12 control-label">Evento</label>
        <div class="col-sm-12">
            <textarea id="body" name="event" class="form-control" rows="3"></textarea>
        </div>
    </div>

    <input style="margin-top: 10px" type="submit" class="pull-right btn btn-success" value="Guardar evento">
    {{ end_form() }}
</div>

{% block script %}
    <script type="text/javascript">
        $(function () {
            $('#from').datetimepicker({locale:'es',minDate: new Date()});
            $('#to').datetimepicker({locale:'es',minDate: new Date()});
        });

    </script>
{% endblock %}

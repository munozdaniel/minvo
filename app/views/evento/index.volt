{% block head %}
    {{ javascript_include('bower_components/jquery/jquery.min.js') }}
    {{ javascript_include('bower_components/moment/moment.js') }}
    {{ javascript_include('bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js') }}
    {{ javascript_include('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}
    {{ javascript_include('bower_components/eonasdan-bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.es.js') }}
{% endblock %}
<div class="col-12">

    <ol class="breadcrumb">
        <li>{{ link_to("calendario", '<i class="fa fa-calendar"></i> Calendario')}}</li>
    <div class="row">
        <h1 class="text-center heading">Añadir un nuevo evento</h1><hr>

        <?php echo form_open(base_url('events/save')) ?>
        <div class="col-sm-8 col-sm-offset-2" style="height:75px;">
            <div class='col-md-6'>
                <div class="form-group">
                    <div class='input-group date' id='from'>
                        <input type='text' name="from" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class="form-group">
                    <div class='input-group date' id='to'>
                        <input type='text' name="to" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
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

            <input style="margin-top: 10px" type="submit" class="pull-right btn btn-success" value="Gurdar evento">
        </div>
    </div>
    <?php echo form_close() ?>
</div>

{% block head %}
    <script type="text/javascript">
        $(function () {
            $('#from').datetimepicker({
                language: 'es',
                minDate: new Date()
            });
            $('#to').datetimepicker({
                language: 'es',
                minDate: new Date()
            });

        });
    </script>
{% endblock %}

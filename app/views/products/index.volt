

<div class="col-12">
    {{ content() }}
    <h1 class="page-header">
        FORMULARIO <small> index</small>
    </h1>
    <div class="alert alert-success text-center" role="alert">BUSCAR PRODUCTOS</div>

    <div class="col-md-offset-2" style="align-content: center;">


        {{ form("products/buscar") }}
        <fieldset>
            {% for unElemento in productoForm %}
                {# Muestro todos los campos #}
                <div class="control-group">
                    {{ unElemento.label(['class':'control-label']) }}
                    <div class="control">
                        {{ unElemento }}
                    </div>
                </div>
            {% endfor %}
            <br>
            <div class="control-group">
                {{ submit_button("Buscar", "class": "btn btn-primary") }}
            </div>
        </fieldset>
        {{ end_form() }}

    </div>


</div>

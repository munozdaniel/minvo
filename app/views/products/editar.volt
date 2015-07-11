

<div class="col-12">
    {{ content() }}
    <h1 class="page-header">
        FORMULARIO <small> editar </small>
    </h1>
    <div class="alert alert-success text-center" role="alert">EDITAR PRODUCTOS</div>

    <div class="col-md-offset-2" style="align-content: center;">

        <ul class="pager">
            <li class="previous pull-left">
                {{ link_to("products", "&larr; Go Back") }}
            </li>
            <li class="pull-right">
                {{ submit_button("Guardar", "class": "btn btn-success") }}
            </li>
        </ul>
        {{ form("products/guardar", 'role':'form') }}
        <fieldset>
            {% for unElemento in formulario %}
                {% if is_a(unElemento, 'Phalcon\Forms\Element\Hidden') %}
                    {{ unElemento }}
                {% else %}
                    {# Muestro todos los campos #}
                    <div class="control-group">
                        {{ unElemento.label(['class':'control-label']) }}
                        <div class="control">
                            {{ unElemento }}
                        </div>
                    </div>
                {% endif %}
            {% endfor %}
            <br>

        </fieldset>
        {{ end_form() }}

    </div>


</div>

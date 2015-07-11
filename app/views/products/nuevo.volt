<div class="col-12">
    {{ content() }}
    <h1 class="page-header">
        FORMULARIO <small> nuevo </small>
    </h1>
    <div class="alert alert-success text-center" role="alert">AGREGAR PRODUCTOS</div>

    <div class="col-md-offset-2" style="align-content: center;">


        {{ form("products/crear") }}
        <ul class="pager">
            <li class="previous pull-left">
                {{ link_to("products", "&larr; Go Back") }}
            </li>
            <li class="pull-right">
                {{ submit_button("Save", "class": "btn btn-success") }}
            </li>
        </ul>
        <fieldset>
            {% for element in formularioProducto %}
                {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
                    {{ element }}
                {% else %}
                    <div class="form-group">
                        {{ element.label() }}
                        {{ element.render(['class': 'form-control']) }}
                    </div>
                {% endif %}
            {% endfor %}
        </fieldset>
        {{ end_form() }}

    </div>


</div>
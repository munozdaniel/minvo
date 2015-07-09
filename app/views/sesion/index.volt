<div class="col-lg-12">
    <h1 class="page-header">
        INICIAR <small> SESIÓN </small>
    </h1>
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Ingreso Personal Unicamente
        </li>
    </ol>
    {{ form('sesion/validar') }}
        <fieldset>
            <div class="col-md-6">
                <label for="email">usuario/email</label>
                <div>
                    {{ text_field('email') }}
                </div>
                <label for="password">contraseña</label>
                <div>
                {{ password_field('password') }}
                </div>
                <br>
                    {{ submit_button('ingresar','class':'btn btn-success') }}
            </div>
        </fieldset>
    {{ end_form() }}
</div>

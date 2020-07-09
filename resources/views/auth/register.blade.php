<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Deblaa Admin | Inscription</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/deblaa.png') }}" type="image/x-icon">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box" style="margin-top: 40px;">
    <div class="register-logo">
        <img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo" class="circle" width="120"><br>
    </div>

    <div class="register-box-body" style="border-radius: 1rem;">

        <div style="margin-top: 0; margin-bottom: 20px; font-size: 24px; color: #000;">
            <b>Inscription</b> -
            <span style="font-size: 18px; color: red;">accès restreint</span>
        </div>

        <form method="post" action="{{ url('/register') }}">
            @csrf

            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Nom complet</label>
                <input type="text" style="border-radius: 3px;" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Nom complet">
                <i class="fa fa-user form-control-feedback"></i>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email</label>
                <input type="email" style="border-radius: 3px;" id="Email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <i class="fa fa-envelope form-control-feedback"></i>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>


            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Mot de passe</label>
                <input type="password" style="border-radius: 3px;" class="form-control" name="password" placeholder="Mot de passe">
                <i class="fa fa-lock form-control-feedback"></i>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="passwrd_confirmaion">Confimer mot de passe</label>
                <input type="password" style="border-radius: 3px;" name="password_confirmation" class="form-control" placeholder="Confirmer mot de passe">
                <i class="fa fa-lock form-control-feedback"></i>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4 pull-right">
                    <button type="submit" style="border-radius: 3px;" class="btn btn-primary btn-block btn-flat">Inscrire</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/login') }}" class="text-center">Je suis déjà administrateur</a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->
<div class="text-center">
    Copyright &copy; 2019 | Tous droits réservés.<br />
    Powered by <a href="https://ibtagroup.com">IBTAGroup</a>
</div><br /><br /><br />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>

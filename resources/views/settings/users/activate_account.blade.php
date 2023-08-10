@extends( 'layouts.auth' )

@section('content')
<div class="row flex-center min-vh-100 py-6">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        @if ($errors->any())
        <div class="card mb-3">
                <div class="card-body bg-warning">
                    <div class="alert alert-warning mb-0">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-warning"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-body p-4 p-sm-5">
                <h5 class="text-center">Seteaza parola</h5>

                {!! Form::model( $user, [ 'url' => route( $_controller_settings['route_base'].'activation.store', [ 'token' => $token ] ), 'method' => 'post' ] ) !!}
                <form class="mt-3">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input class="form-control" name="password" type="password" placeholder="Parola" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirma parola" required />
                    </div>
                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Activeaz contul</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
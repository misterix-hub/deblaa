@extends('layout.sideBar')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste messages</h3>
            </div>
            <div class="col-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <div class="card card-body border rounded">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Titre message</th>
                                <th width="100">Date</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Le titre du message devrait être ici à cet endroit</td>
                                <td>2019-05-02</td>
                                <td class="text-center">
                                    <a href="{{ route('uDetailsMessage', 1) }}" class="blue-text">
                                        <i class="icofont-plus"></i>
                                        Détails
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Titre message</th>
                                <th width="100">Date</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
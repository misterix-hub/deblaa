@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3>Bilan de messages</h3>
            </div>
            <div class="col-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <ul>
                    <li>
                        <b>Messages envoyé(s) au total: <strong>26 messages</strong></b>
                    </li>
                    <li>
                        <b>Nombre total de réceptions: <strong>260 réceptions</strong></b>
                    </li>
                </ul>

                <table width="100%" class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <b>Titre du message</b>
                            </th>
                            <th width="150">
                                <b>Date d'envoi</b>
                            </th>
                            <th width="120">
                                <b>Nombre reçu</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Le titre du message sera ici à cet endroit
                            </td>
                            <td>
                                2019-05-10 15:35
                            </td>
                            <td class="text-right">
                                256
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
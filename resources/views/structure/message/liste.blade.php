@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste des messages</h3>
            </div>
            <div class="col-12"><br />

		<?php $test = 0; $telephones = array(); ?>

                @if ($message = Session::get('nums'))
                    <div class="alert alert-success">
                        Message envoyé avec succès !
                    </div>
		    <?php $test += 1; $telephones = $nums; ?>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <div class="card card-body border rounded">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Titre message</th>
                                <th width="130">Date d'envoi</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{ $message->titre }}</td>
                                    <td>{{ $message->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('sDetailsMessage', $message->id) }}" class="blue-text">
                                            <i class="icofont-plus"></i>
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Titre message</th>
                                <th width="100">Date d'envoi</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
	$(document).ready(function () {

	    var test = "{{ $test }}";

	    if(test != 0) {
		var telephones = "{{ $telephones }}";
            	    telephones.forEach(telephone) {
                    console.log($telephone);
            	}
	    }

	});
    </script>

@endsection

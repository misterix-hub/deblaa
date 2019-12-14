@extends('layout.header')


@section('inboxs')
    <script>
        if ($(window).width() >= 760) {
            window.location = "{{ route('inboxEtudiant') }}";
        }
    </script>
    <div id="inboxS">

    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            setInterval(() => {
                $.ajax({
                    url : "{{ route('eMessageFectingS') }}",
                    type : 'GET',
                    success : function(statut){
                        $('#inboxS').html(statut);
                    }
                });
            }, 1000);
        });
    </script>
@endsection
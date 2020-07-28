@extends('layout.header')

@section('sideBar')

    <div class="side-bar white" style="border-right: 1px solid #CCC;" id="sideBarMembre">

    </div>
    <div class="asside-content font-size-14">
        <div class="top-bar pt-3 pb-3 pl-4 pr-4 border-bottom">
            <table width="100%">
                <tr>
                    <td>
                        <a href="{{ route('inboxMembre') }}" class="">
                            <b>Inbox</b>
                        </a>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('mLogout') }}" class="red-text">
                            <i class="icofont-ui-power"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        @yield('content')

    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            if ($(window).width() < 760) {
                $('body').html("<br /><br /><h2 class='text-center'>Redirection en cours ...</h2>");
                window.location = "{{ route('inboxsMembre') }}";
            } else {
                setInterval(() => {
                    $.ajax({
                        url : "{{ route('mMessageFecting') }}",
                        type : 'GET',
                        success : function(statut){
                            $('#sideBarMembre').html(statut);
                        }
                    });
                }, 1000);
            }
        });
    </script>
@endsection

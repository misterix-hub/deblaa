@extends('layout.header')

@section('sideBar')


    <div class="side-bar white" style="border-right: 1px solid #CCC;" id="sideBarEtudiant">

    </div>
    <div class="asside-content font-size-14">
        <div class="top-bar pt-3 pb-3 pl-4 pr-4 border-bottom">
            <table width="100%">
                <tr>
                    <td>
                        <a href="{{ route('inboxEtudiant') }}" class="">
                            <b>Inbox</b>
                        </a>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('logout') }}" class="red-text">
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
            setInterval(() => {
                $.ajax({
                    url : "{{ route('eMessageFecting') }}",
                    type : 'GET',
                    success : function(statut){
                        console.log(statut)
                        $('#sideBarEtudiant').html(statut);
                    }
                });
            }, 1000);
        });
    </script>
@endsection

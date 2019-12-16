<div class="indigo white-text text-center pt-2 pb-2">
    <small>
        <b>BOITE DE RÉCEPTION</b>
        @if ((count($cible_message_universites) - count($message_lus)) > 0)    
            <span class="badge badge-danger z-depth-0" style="pt-1 pb-1 border-radius: 2px;">
                {{ count($cible_message_universites) - count($message_lus) }}
            </span>
        @endif
    </small>
</div>
<div class="p-2 indigo lighten-5" style="border-bottom: 1px solid #CCC;">
    <table>
        <tr>
            <td>
                <div style="width: 40px; height: 40px;">
                    <a href="#!">
                        <img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo" width="100%">
                    </a>
                </div>
            </td>
            <td class="pl-2 pt-1" style="line-height: 15px;">
                <a href="#!">
                    <b class="font-weight-bold">{{ session()->get('nom_complet') }}</b>
                </a><br />
                <small>
                    <i class="icofont-graduate-alt"></i>
                    Étudiant
                </small>
            </td>
        </tr>
    </table>
</div>

@forelse ($cible_message_universites as $cible_message_universite)
    @if (in_array( $cible_message_universite->message_universite_id, $tab_id))
        <a href="#!{{ $cible_message_universite->id }}" class="message-select" data-value="{{ $cible_message_universite->id }}">
            <div class="p-2 border-bottom">
                <table width="100%">
                    <tr>
                        <td width="36">
                            <div style="width: 36px; height: 36px; border-radius: 100%; line-height: 38px;"
                            class="white-text text-center grey lighten-1">
                                <i class="icofont-envelope-open"></i>
                            </div>
                        </td>
                        <td style="line-height: 15px;" class="pl-1 pt-1 text-truncate">
                            <b class="font-weight-bold black-text">
                                {{ $cible_message_universite->titre }}
                            </b><br />
                            <small>{{ $cible_message_universite->created_at }}</small>
                        </td>
                    </tr>
                </table>
            </div>
        </a>
    @else    
        <a href="#!{{ $cible_message_universite->id }}" class="message-select" data-value="{{ $cible_message_universite->id }}">
            <div class="p-2 border-bottom">
                <table width="100%">
                    <tr>
                        <td width="36">
                            <div style="width: 36px; height: 36px; border-radius: 100%; line-height: 38px;"
                            class="white-text text-center green">
                                <i class="icofont-envelope"></i>
                            </div>
                        </td>
                        <td style="line-height: 15px;" class="pl-1 pt-1 text-truncate">
                            <b class="font-weight-bold black-text">
                                {{ $cible_message_universite->titre }}
                            </b><br />
                            <small>{{ $cible_message_universite->created_at }}</small>
                        </td>
                    </tr>
                </table>
            </div>
        </a>
    @endif
@empty

    <div class="text-center"><br />
        <b>Aucun message !</b>
    </div>

@endforelse

<script src="{{ URL::asset('mdb/js/jquery.min.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('.message-select').each(function() {
            $(this).on("click", function() {
                $.ajax({
                    url : "{{ route('eDetailsMessage') }}",
                    type : 'GET',
                    data : 'id=' + $(this).attr('data-value'),
                    success : function(statut){
                        $('#ajaxDetailsMessage').html("<br /><br /><b>Chargement ...</b>");
                        $('#ajaxDetailsMessage').html(statut);
                    }
                });
            });
        });
    });
</script>

@foreach ($messages as $message)    
    <div class="col-lg-8 col-md-12 col-sm-12">
        <h3>{{ $message->titre }}</h3>

        <div>
            {!! $message->contenu !!}
        </div><br />
        <small>
            <i class="icofont-history"></i>
            Date d'envoi : {{ $message->created_at }}
        </small>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12">
        @if ($message->fichier != "")    
            <i class="icofont-paper-clip"></i>
            <b class="font-weight-bold">
                Pièce jointe
            </b><br /><br />
            @switch($message->format)
                @case("Image")
                    <img src="{{ URL::asset('db/messages/fichier/' . $message->fichier) }}" alt="Image-jointe" width="100%">
                    @break

                @case("Video")
                    
                    @break
                @case("Audio")
                    
                    @break

                @case("Document PDF")
                    
                    @break


                @default
                    
            @endswitch

            <a download href="{{ URL::asset('db/messages/fichier/' . $message->fichier) }}" class="btn btn-md btn-orange btn-block">
                <i class="icofont-download"></i>
                Télécharger [{{ substr($message->taille, 0, 5) }} <span style="text-transform: capitalize;">Mo</span>]
            </a><br /><br />
            Type de fichier: <b>{{ $message->format }}</b><br />
            Taille : <b>{{ substr($message->taille, 0, 5) }} Mo</b><br />
        @endif
    </div>
@endforeach

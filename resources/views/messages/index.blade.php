@extends('layouts.app')
@section('content')
    <div class="container-fluid  col-md-8 col-12">
        <div class="card maincard">
            <div class="card-header h2">Messages</div>
            <div class="card-body message-list">
                @foreach ($messages as $message)
                    <div class="message-div mb-1" id="div-{{$message->id}}"><button class="msg-btn btn btn-primary" info="{{$message->info}}" id="btn-{{$message->id}}">from {{$message->from->name}}</button>
                        <input type="password" class="msg-input" id="input-{{$message->id}}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        reader = new FileReader();
        imgID = null;
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('img-'+imgID);
            imgID = null;
            output.src = dataURL;
        }

        $(document).ready(function () {
            $(".msg-btn").click(function (e) { 
                        const btnId = $(this).attr("id");
                        const id = btnId.replace("btn-","");
                        const inputId = btnId.replace("btn","input");
                        const key = $("#"+inputId).val();
                        const decrypted = decrypt($("#"+btnId).attr("info"),key)
                        const messageDiv = `<p>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#msg-${id}" role="button" aria-expanded="false" aria-controls="msg-${id}">
                                                ${decrypted.title}
                                            </a>
                                            <div class="collapse" id="msg-${id}">
                                            <div class="card card-body">
                                                <p>${decrypted.content}</p>
                                            <img id="img-${id}" />
                                            </div>
                                            <div class="card-footer">
                                                sent at: ${decrypted.created_at}
                                            </div
                                            </div>`;
                        $("#div-"+id).html(messageDiv);
                        if(decrypted.image){
                            imgID = id;
                            var url = decrypted.image;
                            fetch(url)
                            .then(res => res.blob())
                            .then(blob => reader.readAsDataURL(blob))
                        }
                    });
        });
    </script>
@endsection
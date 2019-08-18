@extends('layouts.app')
@section('content')
<div class="container-fluid col-md-8 col-12">
    <div class="card maincard">
        <div class="card-header h2">Create A New Message</div>
        <div class="card-body ">
            <form method="POST" action="{{route('messages.store')}}" class="form-group" id="message-create-form">
                @csrf
                <input type="hidden" name="info" id="info">
                <input type="text" class="form-control" placeholder="Title" id="title" autocomplete="off">
                <textarea id="content" cols="30" rows="10" class="form-control" placeholder="Content" autocomplete="off"></textarea>
                <div class="form-group"> to <br>
                    <label for="users-select">
                        <select id="to" name="to" class="form-control">
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </label>

                </div>
                <img id='output' style="max-height:100px; max-width:100px;">
                <input id="image-input" type='file' accept='image/*' onchange='openFile(event)' autocomplete="off"><br>
                <input type="password" placeholder="Key" id="key" autocomplete="off">
                <input type="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var submit = false;
    var openFile = function(file) {
        var input = file.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('output');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    };
    $(document).ready(function() {
        var title = $("input#title").val();
        var content = $("textarea#content").val();
        $("input#title").change(function(e) {
            title = $(this).val();
        })
        $("textarea#content").change(function(e) {
            content = $(this).val();
        })
        $("#message-create-form").submit(function(e) {
            if (submit == true) return true;
            //Todo: encrypt info object
            try {
                if ($('#image-input')[0].files[0]) {
                    console.log("has");

                    var img = null;
                    reader = new FileReader();

                    reader.onload = function() {
                        img = reader.result;
                        console.log({
                            img: img
                        });

                        var info = {
                            title: title,
                            content: content,
                            created_at: new Date(),
                            image: img
                        };

                        const key = $("#key").val();
                        var encrypted = encrypt(info, key.toString());

                        $("input#info").val(encrypted);
                        submit = true;
                        $("#message-create-form").submit();
                    }
                    reader.readAsDataURL($('#image-input')[0].files[0]);

                } else {

                    var info = {
                        title: title,
                        content: content,
                        created_at: new Date(),
                        image: img
                    };

                    const key = $("#key").val();
                    var encrypted = encrypt(info, key.toString());
                    console.log(encrypted);

                    $("input#info").val(encrypted);
                    console.log({
                        val: $("input#info").val()
                    });


                    return true;
                }

            } catch (ex) {
                console.error(ex);
                return false;
            }
        });
    });
</script>
@endsection
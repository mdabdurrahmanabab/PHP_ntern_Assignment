@extends('layouts.app')
@section('content')
<div class="row">
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    <form id="todo_submit_form" class="mt-2" method="post">
        @csrf
        <!-- <div class="d-flex">
            <input class="form-control me-2" type="text" name="text" placeholder="Enter Your Topic">
            <button id="add_todo" class="btn btn-outline-success" type="button">Add to topic</button>
        </div> -->

        <div class="input-group mb-3">
            <input class="form-control me-2" type="text" name="text" placeholder="Enter Your Topic">
            <button class="input-group-text btn btn-outline-success" id="add_todo">Add Todo</button>
        </div>
        <div class="error_message"></div>
    </form>
</div>

<div class="row">
    <div class="mt-3">
        <table class="table" >
            @foreach($model as $key => $val)
            <tr>
                <td>{{$val->text}}</td>
                <td class="me-0">
                    <span class="float-end">
                        <form method="POST" action="{{route('todo.destroy',$val->id)}}" accept-charset="UTF-8" style="display:inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete todo" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </span>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection
@section('script')
<script>
    $('#add_todo').click(function(e){
        e.preventDefault();
        var form = $('#todo_submit_form')[0];
        var formData = new FormData(form);
        $(this).html(`<div class="spinner-border spinner-border-sm" role="status"></div>`);
        $.ajax({
            type: 'POST',
            url: "{{route('todo.store')}}",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.status == 200 && data.redirect != '') {
                    $('#message').html(`
                        <div class="alert alert-success" role="alert">
                            ${data.success}
                        </div>
                    `);
                    window.location.href = data.redirect;
                } else if (data.status == 400) {
                    let err_list = data.error;
                    for (const property in err_list) {
                        $('.error_message').html(
                            `<p class="error-content mt-1">${err_list[property]}</p>`
                        );
                    }
                }
                // Reset button text after success/error handling
                $('#add_todo').html('Add Todo');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('#add_todo').html('Add Todo');
            }
        });
    });
</script>

@endsection

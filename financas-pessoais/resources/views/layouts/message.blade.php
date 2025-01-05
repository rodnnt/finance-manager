@if(session('msg'))
    <div class=message>
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    </div>
@endif
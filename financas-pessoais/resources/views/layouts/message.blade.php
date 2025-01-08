@if(session('msg'))
    <div class="message">
        <div class="alert alert-success" id="msg-alert">
            {{ session('msg') }}
        </div>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('msg-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>
@endif

@if ($errors->any())
    <div class="message">
        <div class="alert alert-danger" id="msg-alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('msg-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>
@endif
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
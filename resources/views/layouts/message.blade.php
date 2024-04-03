@if(count($errors))
    <div id="error-alert" class="alert alert-danger text-white alert-dismissible fade show" role="alert">
        <strong class="text-capitalize">Oops!</strong><br>
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@else 
    @if (session('success'))
        <div id="success-alert" class="alert alert-success text-white alert-dismissible fade show" role="alert">
            <strong class="text-capitalize">Success!</strong><br>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Automatically close alerts after 5 seconds
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.classList.add('hide');
                setTimeout(function() {
                    alert.remove();
                }, 500); // Delay the removal after hiding animation completes
            }, 2500);
        });
    });
</script>

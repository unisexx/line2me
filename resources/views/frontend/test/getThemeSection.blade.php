@extends('layouts.front2024')

@section('content')
    <div class="container mt-5">
        <button id="updateThemesButton" class="btn btn-primary">Update Themes</button>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#updateThemesButton').click(function() {
                $.ajax({
                    url: '/update-themes',
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#updateThemesButton').trigger('click');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endpush

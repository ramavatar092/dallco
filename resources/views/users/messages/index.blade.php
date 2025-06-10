@extends('layouts.app')

@section('content')
<section class="message-wrapper">
    <!-- Users Table -->
    <div class="message-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Message Lists</h5>
                </div>

                <div class="card-body">
                    <div class="table table-striped table-fixed table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        $(document).on('change click', '#deleteBtn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            Swal.fire({
                title: "{{ trans('global.areYouSure') }}",
                text: "Do you want to delete this record?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: `Delete`,
            })
            .then((result) => {
                $('#pageloader').css('display', 'flex');
                if (!result.isDismissed) {
                    $.ajax({
                        type: "delete",
                        url: url,
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            toastr.success(response.message, 'Success!');
                            $('table').DataTable().ajax.reload(null, false);
                        },
                        error: function(response) {
                            let errorMessages = '';
                            $.each(response.responseJSON.errors, function(key, value) {
                                $.each(value, function(i, message) {
                                errorMessages += '<li>' + message + '</li>';
                                });
                            });
                            toastr.error(errorMessages);
                        },
                        complete: function() {
                            $('table').DataTable().ajax.reload(null, false);
                        }
                    });
                } else {
                    $('table').DataTable().ajax.reload(null, false);
                    return false;
                }
            });
        });
    </script>
@endpush

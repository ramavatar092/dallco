@extends('layouts.app')

@section('content')
<section class="users-list-wrapper">
    <!-- Users Table -->
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Lists</h5>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        + New User
                    </a>
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

                $(document).on('change click', '.updateStatus', function(e) {
                    e.preventDefault();
                    var user_id = $(this).data("user-id");
                    var current_status = $(this).data("user-status");

                    console.log("Current status:", current_status); // Debugging

                    var confirmationText = current_status === "active"
                        ? "Do you want to suspend this user?"
                        : "Do you want to activate this user?";

                    Swal.fire({
                        title: "{{ trans('global.areYouSure') }}",
                        text: confirmationText,
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: `Update`,
                    }).then((result) => {
                        if (!result.isDismissed) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('users.updateStatus') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    user_id: user_id,
                                },
                                success: function(response) {
                                    toastr.success(response.message, 'Success!');
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
                                    return false;
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

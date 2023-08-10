<form action="#" method="post" name="deleteElementForm" id="deleteElementForm">
    @method('DELETE')
    @csrf
</form>

@push('footer-js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteItem(event, path, message) {
                event.preventDefault();
                Swal.fire({
                    title: '{{ __('Are you sure?') }}',
                    text: message ? message : "{!! __('You won\'t be able to revert this!') !!}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'rgb(239, 68, 68)',
                    cancelButtonColor: 'rgb(107, 114, 128)',
                    confirmButtonText: '{{ __('Yes, delete it!') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteElementForm').action = path;
                        document.getElementById('deleteElementForm').submit();
                    }
                })
            }
</script>
@endpush

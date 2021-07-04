<form action="{{ route('delete-account') }}"
    method="DELETE">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Are you sure you want to delete {{ Auth::user()->name }} Account ?</h5>
    </div>
    <div class="modal-footer">
        <a href="/setting">
            <button type="button"
                class="btn btn-outline-secondary">Cancel</button></a>
        <button type="submit"
            class="btn btn-danger">Yes, Delete Account</button>
    </div>
</form>

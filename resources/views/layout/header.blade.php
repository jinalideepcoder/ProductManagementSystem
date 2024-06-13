<div class="bg-light text-end ">
    <form action="{{ route('login.destroy') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary m-2 ">{{ __('Logout') }}</button>
    </form>
</div>

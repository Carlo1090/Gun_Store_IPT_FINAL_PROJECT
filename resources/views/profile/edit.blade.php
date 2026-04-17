@extends(auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.customer')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    👤 {{ auth()->user()->role === 'admin' ? 'Admin Profile' : 'My Profile' }}
</h2>

<div class="space-y-6 max-w-3xl">

    <div class="p-6 bg-white shadow rounded-lg">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="p-6 bg-white shadow rounded-lg">
        @include('profile.partials.update-password-form')
    </div>

    <div class="p-6 bg-white shadow rounded-lg">
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection

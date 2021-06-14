@extends('layouts.app')
@section('title', __('Profile'))
@section('content')
<form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table class="table mx-auto" style="max-width: 700px">
        <tbody>
            <tr>
                <td class="px-2">{{ __("Name") }}</td>
                <td>
                    <input
                        id="name"
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        value="@if(old('name')){{ old('name') }}@else{{ $Auth->name }}@endif"
                        autocomplete="name"
                    />
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="px-2">{{ __("Email") }}</td>
                <td>{{ $Auth->email }}</td>
            </tr>
            <tr>
                <td class="px-2">{{ __("Avatar") }}</td>
                <td>
                    <div class="avatar-lg mb-3">
                        <img
                            src="{{ $Auth->avatar }}"
                            alt="{{ $Auth->name }}"
                            data-old="{{ $Auth->avatar }}"
                            id="avatarImg"
                        />
                    </div>
                    <div>
                        <input id="avatarInput" class="bg-light pointer rounded mb-2" type="file" name="avatar">
                        <a name="" id="avatarReset" class="btn btn-light btn-sm" href="#" role="button">{{ __('Reset') }}</a>
                        @if ($errors->has('photo'))
                        <div class="text-danger">
                            {{ $errors->first('photo') }}
                        </div>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td class="px-2">{{ __("Birthday") }}</td>
                <td>
                    <input
                        id="birthday"
                        type="date"
                        class="
                            form-control
                            @error('birthday')
                            is-invalid
                            @enderror
                        "
                        name="birthday"
                        value="{{ $Auth->birthday }}"
                        autocomplete="birthday"
                    />
                    @error('birthday')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="px-2">{{ __("Job") }}</td>
                <td>
                    <input
                        id="job"
                        type="text"
                        class="form-control @error('job') is-invalid @enderror"
                        name="job"
                        value="@if(old('job')){{ old('job') }}@else{{ $Auth->job }}@endif"
                        autocomplete="job"
                    />
                    @error('job')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td class="px-2">{{ __("Introduce yourself") }}</td>
                <td>
                    <textarea
                        type="text"
                        class="form-control"
                        name="description"
                        aria-label="descr"
                        oninput="autoGrow(this)"
                        onfocus="autoGrow(this)"
                        maxlength="1000"
                        style="height: 60px"
                    >@if(old('description')){{ old('description') }}@else{{ $Auth->description }}@endif</textarea>
                </td>
            </tr>
            <tr>
                <td class="px-2">{{ __("Password") }} *</td>
                <td>
                    <a
                        class="collapsed btn btn-light mb-3"
                        data-toggle="collapse"
                        href="#collapseChangePw"
                        aria-expanded="false"
                        aria-controls="collapseChangePw"
                    >
                        {{ __("Change Password") }}
                    </a>

                    <!-- Collapsed content -->
                    <div class="collapse" id="collapseChangePw">
                        <input
                            type="password"
                            class="
                                form-control
                                mb-2
                                @error('password')
                                is-invalid
                                @enderror
                            "
                            name="password"
                            placeholder="{{ __('New Password') }}"
                            autocomplete="new-password"
                        />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            placeholder="{{ __('Confirm Password') }}"
                            autocomplete="new-password"
                        />
                        <div class="form-text text-muted">{{ __("Skip if you don't want to change your password") }}</div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <div class="alert d-none"></div>
        <button type="submit" id="formSettingBtn" class="btn btn-primary fs-6">
            {{ __("Save") }}
        </button>
    </div>
</form>

<script>
    var avatarReset = document.getElementById('avatarReset');
    var avatarInput = document.getElementById('avatarInput');
    var avatarImg = document.getElementById('avatarImg');
    avatarInput.addEventListener('change', function (e) {
        avatarImg.src = URL.createObjectURL(e.target.files[0]);
        console.log('changed');
    });
    avatarReset.addEventListener('click', function (e) {
        avatarInput.value = null;
        avatarImg.src = avatarImg.dataset.old;
    });

</script>

@endsection

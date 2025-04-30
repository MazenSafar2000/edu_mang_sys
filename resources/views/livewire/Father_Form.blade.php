<!-- This blade contains the Add & Edit Form for Father -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-xs-12">
    <div class="col-md-12">
        <br>

        <div class="form-row">
            <div class="col">
                <label for="email">{{ trans('Parent_trans.Email') }}</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror"
                    required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="password">{{ trans('Parent_trans.Password') }}</label>
                <input type="password" wire:model="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col">
                <label for="Name_Father">{{ trans('Parent_trans.Name_Father') }}</label>
                <input type="text" wire:model="Name_Father"
                    class="form-control @error('Name_Father') is-invalid @enderror" required>
                @error('Name_Father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="Name_Father_en">{{ trans('Parent_trans.Name_Father_en') }}</label>
                <input type="text" wire:model="Name_Father_en"
                    class="form-control @error('Name_Father_en') is-invalid @enderror" required>
                @error('Name_Father_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="col-md-3">
                <label for="Job_Father">{{ trans('Parent_trans.Job_Father') }}</label>
                <input type="text" wire:model="Job_Father"
                    class="form-control @error('Job_Father') is-invalid @enderror" required>
                @error('Job_Father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="Job_Father_en">{{ trans('Parent_trans.Job_Father_en') }}</label>
                <input type="text" wire:model="Job_Father_en"
                    class="form-control @error('Job_Father_en') is-invalid @enderror" required>
                @error('Job_Father_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="Phone_Father">{{ trans('Parent_trans.Phone_Father') }}</label>
                <input type="text" wire:model="Phone_Father"
                    class="form-control @error('Phone_Father') is-invalid @enderror" required>
                @error('Phone_Father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group mt-3">
            <label for="Address_Father">{{ trans('Parent_trans.Address_Father') }}</label>
            <textarea class="form-control @error('Address_Father') is-invalid @enderror" wire:model="Address_Father" rows="4"
                required></textarea>
            @error('Address_Father')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit Buttons --}}
        <div class="mt-4">
            @if ($updateMode)
                <button class="btn btn-primary" wire:click="submitForm_edit"
                    type="button">{{ trans('Parent_trans.Update') }}</button>
            @else
                <button class="btn btn-success" wire:click.prevent="submitForm"
                    type="button">{{ trans('Parent_trans.Save') }}</button>
            @endif

            <button class="btn btn-secondary" wire:click="showformadd"
                type="button">{{ trans('Parent_trans.Back') }}</button>
        </div>
    </div>
</div>

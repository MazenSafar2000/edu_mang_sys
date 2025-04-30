<div>
    {{-- Success Message --}}
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    {{-- Error Message --}}
    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Table of Parents --}}
    @if ($show_table)
        @include('livewire.Parent_Table')
    @else
        {{-- Father Input Form --}}
        <div class="row">
            <div class="col-md-12">
                <label>{{ trans('Parent_trans.Father_Info') }}</label>

                <div class="form-group">
                    <label>{{ trans('Parent_trans.Email') }}</label>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror"
                        required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ trans('Parent_trans.Password') }}</label>
                    <input type="password" wire:model="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ trans('Parent_trans.Name_Father') }} (Arabic)</label>
                    <input type="text" wire:model="Name_Father" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ trans('Parent_trans.Name_Father') }} (English)</label>
                    <input type="text" wire:model="Name_Father_en" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ trans('Parent_trans.Job_Father') }} (Arabic)</label>
                    <input type="text" wire:model="Job_Father" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ trans('Parent_trans.Job_Father') }} (English)</label>
                    <input type="text" wire:model="Job_Father_en" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ trans('Parent_trans.Phone_Father') }}</label>
                    <input type="text" wire:model="Phone_Father" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ trans('Parent_trans.Address_Father') }}</label>
                    <input type="text" wire:model="Address_Father" class="form-control" required>
                </div>

                <input type="hidden" wire:model="Parent_id">

                {{-- Submit Buttons --}}
                @if ($updateMode)
                    <button class="btn btn-primary" wire:click="submitForm_edit" type="button">
                        {{ trans('Parent_trans.Finish') }}
                    </button>
                @else
                    <button class="btn btn-success" wire:click="submitForm" type="button">
                        {{ trans('Parent_trans.Finish') }}
                    </button>
                @endif

                {{-- <button class="btn btn-secondary" wire:click="showformadd">
                    {{ trans('Parent_trans.Back') }}
                </button> --}}
            </div>
        </div>
    @endif
</div>

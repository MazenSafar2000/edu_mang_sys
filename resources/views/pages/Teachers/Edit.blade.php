@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Teacher_trans.Edit_Teacher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.Edit_Teacher') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('Teachers.update','test')}}" method="post">
                             {{method_field('patch')}}
                             @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="Email">{{trans('Teacher_trans.Email')}}</label>
                                    <input type="hidden" value="{{$Teachers->id}}" name="id">
                                    <input type="email" name="Email" class="form-control @error('Email') is-invalid @enderror" value="{{$Teachers->email}}" required>
                                    @error('Email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="Password">{{trans('Teacher_trans.Password')}}</label>
                                    <input type="password" name="Password" class="form-control @error('Password') is-invalid @enderror" value="{{$Teachers->Password}}" >
                                    @error('Password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="Name_ar">{{trans('Teacher_trans.Name_ar')}}</label>
                                    <input type="text" name="Name_ar" class="form-control @error('Name_ar') is-invalid @enderror" value="{{ $Teachers->getTranslation('Name', 'ar') }}" required>
                                    @error('Name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Teacher_trans.Name_en')}}</label>
                                    <input type="text" name="Name_en" class="form-control @error('Name_en') is-invalid @enderror"  value="{{ $Teachers->getTranslation('Name', 'en') }}" required>
                                    @error('Name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="Specialization_id">{{trans('Teacher_trans.specialization')}}</label>
                                    <select class="custom-select my-1 mr-sm-2 @error('Specialization_id') is-invalid @enderror" name="Specialization_id" required>
                                        <option value="{{$Teachers->Specialization_id}}">{{$Teachers->specializations->Name}}</option>
                                        @foreach($specializations as $specialization)
                                            <option value="{{$specialization->id}}">{{$specialization->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Specialization_id')
                                    <small class="alert alert-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="Gender_id">{{trans('Teacher_trans.Gender')}}</label>
                                    <select class="custom-select my-1 mr-sm-2 @error('Gender_id') is-invalid @enderror" name="Gender_id" required>
                                        <option value="{{$Teachers->Gender_id}}">{{$Teachers->genders->Name}}</option>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}">{{$gender->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Gender_id')
                                    <small class="alert alert-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="Joining_Date">{{trans('Teacher_trans.Joining_Date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action"  value="{{$Teachers->Joining_Date}}" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                    </div>
                                    @error('Joining_Date')
                                    <small class="alert alert-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="Address">{{trans('Teacher_trans.Address')}}</label>
                                <textarea class="form-control @error('Address') is-invalid @enderror" name="Address"
                                          id="Address" rows="4">{{$Teachers->Address}}</textarea>
                                @error('Address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Parent_trans.Next')}}</button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection

@extends('layouts.app')

@section('title', __('models/users.plural'))

@section('breadcrumbs', __('models/users.plural'))

@section('content')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/users.plural') }} - @lang('crud.edit')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'users','action_name' => 'edit'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body">
                    <div class="form-group col-sm-12">مجموعات الصلاحيات
                        <div class="select2-primary">
                            {!! Form::label('roles', 'Roles:') !!} 
                            {{ Form::select('roles[]', $roles_list, $userRoles->pluck('id'), ['id' => 'roles-acl','multiple' => 'multiple', 'class' => 'select2 form-select select2-hidden-accessible']) }}
                            {{-- <select id="roles-acl" name="roles[]" id="roles[]" class="form-control" multiple="multiple" style="width: 100%">
                                @foreach($roles_list as $role)
                                    <option value="{{ $role->id }}">{{ $role->label }}</option>
                                @endforeach 
                            </select> --}}
                        </div>
                    </div>
        
                   
                

                    {{-- <select class="select2 form-select select2-hidden-accessible" id="select2-multiple" multiple="" data-select2-id="select2-multiple" tabindex="-1" aria-hidden="true">
                        <optgroup label="Alaskan/Hawaiian Time Zone" data-select2-id="54">
                            <option value="AK" data-select2-id="55">Alaska</option>
                            <option value="HI" data-select2-id="56">Hawaii</option>
                        </optgroup>
                        <optgroup label="Pacific Time Zone" data-select2-id="57">
                            <option value="CA" data-select2-id="58">California</option>
                            <option value="NV" data-select2-id="59">Nevada</option>
                            <option value="OR" data-select2-id="60">Oregon</option>
                            <option value="WA" data-select2-id="61">Washington</option>
                        </optgroup>
                        <optgroup label="Mountain Time Zone" data-select2-id="62">
                            <option value="AZ" data-select2-id="63">Arizona</option>
                            <option value="CO" selected="" data-select2-id="6">Colorado</option>
                            <option value="ID" data-select2-id="64">Idaho</option>
                            <option value="MT" data-select2-id="65">Montana</option>
                            <option value="NE" data-select2-id="66">Nebraska</option>
                            <option value="NM" data-select2-id="67">New Mexico</option>
                            <option value="ND" data-select2-id="68">North Dakota</option>
                            <option value="UT" data-select2-id="69">Utah</option>
                            <option value="WY" data-select2-id="70">Wyoming</option>
                        </optgroup>
                        <optgroup label="Central Time Zone" data-select2-id="71">
                            <option value="AL" data-select2-id="72">Alabama</option>
                            <option value="AR" data-select2-id="73">Arkansas</option>
                            <option value="IL" data-select2-id="74">Illinois</option>
                            <option value="IA" data-select2-id="75">Iowa</option>
                            <option value="KS" data-select2-id="76">Kansas</option>
                            <option value="KY" data-select2-id="77">Kentucky</option>
                            <option value="LA" data-select2-id="78">Louisiana</option>
                            <option value="MN" data-select2-id="79">Minnesota</option>
                            <option value="MS" data-select2-id="80">Mississippi</option>
                            <option value="MO" data-select2-id="81">Missouri</option>
                            <option value="OK" data-select2-id="82">Oklahoma</option>
                            <option value="SD" data-select2-id="83">South Dakota</option>
                            <option value="TX" data-select2-id="84">Texas</option>
                            <option value="TN" data-select2-id="85">Tennessee</option>
                            <option value="WI" data-select2-id="86">Wisconsin</option>
                        </optgroup>
                        <optgroup label="Eastern Time Zone" data-select2-id="87">
                            <option value="CT" data-select2-id="88">Connecticut</option>
                            <option value="DE" data-select2-id="89">Delaware</option>
                            <option value="FL" selected="" data-select2-id="7">Florida</option>
                            <option value="GA" data-select2-id="90">Georgia</option>
                            <option value="IN" data-select2-id="91">Indiana</option>
                            <option value="ME" data-select2-id="92">Maine</option>
                            <option value="MD" data-select2-id="93">Maryland</option>
                            <option value="MA" data-select2-id="94">Massachusetts</option>
                            <option value="MI" data-select2-id="95">Michigan</option>
                            <option value="NH" data-select2-id="96">New Hampshire</option>
                            <option value="NJ" data-select2-id="97">New Jersey</option>
                            <option value="NY" data-select2-id="98">New York</option>
                            <option value="NC" data-select2-id="99">North Carolina</option>
                            <option value="OH" data-select2-id="100">Ohio</option>
                            <option value="PA" data-select2-id="101">Pennsylvania</option>
                            <option value="RI" data-select2-id="102">Rhode Island</option>
                            <option value="SC" data-select2-id="103">South Carolina</option>
                            <option value="VT" data-select2-id="104">Vermont</option>
                            <option value="VA" data-select2-id="105">Virginia</option>
                            <option value="WV" data-select2-id="106">West Virginia</option>
                        </optgroup>
                    </select> --}}



                   
                </div>
        
                {{-- <div class="form-group col-sm-12">
                    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('roles.index') }}" class="btn btn-default">إلغاء</a>
                </div>
        
                {!! Form::close() !!} --}}
            </div>
        



            <div class="card-footer">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('users.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
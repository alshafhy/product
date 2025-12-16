<div class="table-responsive">
    <table class="table table-bordered" id="cities-table">
        <thead>
        <tr>
            <th>@lang('models/cities.fields.name')</th>
            <th colspan="3" class="text-center" >@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
         @foreach($cities as $city)
            <tr>
                <td>{{ $city->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cities.destroy', $city->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cities.show', [$city->id]) }}"
                           class='btn btn-outline-primary btn-sm'>
                            <i data-feather="eye"></i>
                        </a>
                        <a href="{{ route('cities.edit', [$city->id]) }}"
                           class='btn btn-outline-warning btn-sm'>
                            <i data-feather="edit"></i>
                        </a>
                        {!! Form::button('<i data-feather="trash"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

{!! Form::open(['route'=>'admin.permissions.store', 'method'=>'POST']) !!}
<table class="table table-striped">
    <thead>
    <tr>
        <th>
            Permissions
        </th>
        @foreach($roles as $role)
            <th>{{$role->name}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td>{{$permission->name}}</td>
            @foreach($roles as $role)
                <td>
                    @if($role->hasPermission($permission->name))
                        {!! Form::checkbox($role->id.'[]', $permission->id,  'checked') !!}
                    @else
                        {!! Form::checkbox($role->id.'[]', $permission->id,  null) !!}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}
{!! Form::open(['route'=>'tasks.store','method'=>'POST',]) !!}
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-plus"></i></div>
        </div>

        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '有什么要说的吗？']) !!}
        {!! Form::hidden('project_id', $project->id) !!}
    </div>
    {!! $errors->create->first('name', '<div class="alert alert-danger my-2">:message</div>') !!}
    {!! $errors->create->first('project_id', '<div class="alert alert-danger my-2">:message</div>') !!}

{!! Form::close() !!}

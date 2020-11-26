<div class="modal fade" id="editModal--{{ $project->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" <div
    class="modal fade" id="editModal--{{ $project->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal--{{ $project->id }}">编辑项目</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::model($project, ['route' => ['projects.update',$project->id ], 'method' => 'PATCH', 'files' => 'true']) !!}
                <div class="modal-body">
                    <div class="form-group">

                        {!! Form::label('name', '项目名称') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        {!! $errors->getBag('update-'.$project->id)->first('name','<div class="alert alert-danger my-2">:message</div>') !!}

                    </div>
                    <div class="form-group">
                        {!! Form::label('thumbnail', '缩略图') !!}
                        {!! Form::file('thumbnail', ['class' => 'form-control-file']) !!}
                        {{ $errors->getBag('update-'.$project->id)->first('thumbnail')}}
                        {!! $errors->getBag('update-'.$project->id)->first('thumbnail','<div class="alert alert-danger my-2">:message</div>') !!}
                    </div>

                </div>
                <div class="modal-footer">

                    {!! Form::submit('编辑项目', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

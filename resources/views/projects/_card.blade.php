<div class="col-4 my-3">
    <div class="card projectCard">
        <ul class="icon-bar">
            <li>
                @include('projects._deleteForm')
            </li>

            <li>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#editModal--{{ $project->id }}">
                    <i class="fa fa-btn fa-cog"></i>
                </button>
            </li>

        </ul>
        <a href="{{ route('projects.show', $project->id) }}">
            <img src="{{ $project->thumbnail ?? config('app.url') . '/uploads/' . 'demo.jpg' }}" class="card-img-top" alt="...">
            <div class="card-body py-3">
                <h6 class="card-title text-center">{{ $project->name }}</h6>
            </div>
        </a>
    </div>
    @include('projects.editProject')
</div>

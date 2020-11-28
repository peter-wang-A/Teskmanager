<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
            aria-controls="nav-home" aria-selected="true">未完成<span class="badge badge-pill badge-primary ml-1">
                {{ count($todos) }}</span> </a>
        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
            aria-controls="nav-profile" aria-selected="false">已完成
            <span class="badge badge-pill badge-success ml-1">
                {{ count($dones) }}</span>
        </a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">

    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        @if (count($todos) > 0)
            <table class="table table-striped">
                <tr class="mt-2 mb-3">
                    <td colspan="4"> @include('tasks._create',$project)</td>
                </tr>
                @foreach ($todos as $todo)
                    <tr class="">
                        <td class="col-9 ">
                            <span class="badge badge-secondary mr-3">
                                {{ $todo->updated_at->diffForHumans() }}
                            </span>
                        <a href="{{route('tasks.show',$todo->id)}}">{{ $todo->name }}</a>

                        </td>
                        <td>
                            @include('tasks._checkForm',$todo)
                        </td>
                        <td>@include('tasks._edit',$todo)</td>
                        <td>@include('tasks._deleteTask',$todo)</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

        @if (count($dones) > 0)
            <table class="table table-striped">
                @foreach ($dones as $todo)
                    <tr>
                        <td>
                            {{ $todo->name }}
                        </td>
                        <td>
                            @include('tasks._checkForm',$todo)
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

</div>

@extends('layouts.app')


@section('content')
    <div class="container" id="app">
        <h3>{{ $task->name }}</h3>
        <div class="row justify-content-center">
            <div class="card col-4">
                <div class="card-header">
                    <span>待完成的步骤：</span>

                    <div class="card-body ">
                        <ul class="list-group ">
                            <li class="list-group-item " v-for="item in inProcess">
                                @{{ item . name }}
                                <i class="fa fa-check pull-right" v-on:click="toggle(item)"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="from-group">
                        <div class="card-header">
                            <label>添加什么内容呢？</label>
                            <input type="text" v-model="message" @keyup.enter="addStep" name="" id=""
                                class="form-control my-3">
                        </div>
                    </div>
                </div>

            </div>

            <div class="card col-4 ml-5">
                <div class="card-header">
                    <span>已完成的步骤：</span>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item " v-for="item in processed">
                            @{{ item . name }}
                            <i class="fa fa-check pull-right" v-on:click="toggle(item)"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>

@endsection


@section('customJS')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        new Vue({
            el: "#app",
            data: {
                steps: [{
                        'name': 'hello word',
                        'complection': false
                    },
                    {
                        'name': 'hello steve',
                        'complection': false
                    },
                    {
                        'name': 'hello pilishen',
                        'complection': true
                    },
                ],
                message: ''
            },
            computed: {
                inProcess() {
                    return this.steps.filter((step) => {
                        return !step.complection
                    })
                },
                processed() {
                    return this.steps.filter((step) => {
                        return step.complection
                    })
                },
            },
            methods: {
                addStep() {
                    this.steps.push({
                        'name': this.message,
                        'complection': false
                    })
                    this.message = ''
                },
                toggle(item) {
                    item.complection = !item.complection
                },
            },
        });

    </script>
@endsection

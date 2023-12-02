@extends('admin.layouts.master')

@section('content')
<div class="row">

    <div class="col-lg-12" id="app">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="">
                            <li class="text-info">@lang('Click Add Translatable Add Put Your Key For Translate')</li>
                            <li class="text-danger">@lang("Add Translatable Key please careful when you entering word or sentences, there shouldn't be any extra space or break.")</li>
                            <li class="text-success">@lang("If your keywords are perfect but translator doesn't work, don't worry. escape all dynamic keywords and add single word, it'll work.")</li>
                        </ul>
                    </div>
                    <div class="col-md-4">

                        <form class="form-inline" method="post" @submit.prevent="importKey">

                            <div class="input-group has_append">
                                <select  class="form-control" required v-model="importData.code">
                                    <option value="">@lang('Import Keywords')</option>
                                    @foreach($list_lang as $data)
                                    <option value="{{$data->id}}" @if($data->id == $la->id) style="display: none" @endif>{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">@lang('Import Now')</button>
                                </div>
                            </div>
                        </form>

                        <small class="text-danger">@lang('If you import keywords from another language, Your present') "{{$la->name}}" @lang('all keywords will remove').</small>

                    </div>
                </div>
                <hr>
                <div class="tile-body" style="overflow: hidden">
                    <form method="post" action="{{route('admin.language.key-update', $la->id)}}" id="langForm">
                        @csrf
                        {{method_field('put')}}
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-3" v-for="(value, key) in datas" :key="key">
                                    <label class="control-label">@{{ key }}</label>
                                    <div class="input-group has_append">
                                        <input type="text" :value="value" :name="'keys[' + key + ']'" class="form-control">
                                        <div class="input-group-append" >
                                            <span class="btn  input-group-text" style="background: #ff4f59; color: white" @click.prevent="deleteElement(key)"><i class="fa fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="py-5  text-right  ">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-warning"> <i class="fa fa-plus"></i> @lang('Add New Key')</button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-block btn-lg btn-success" data-toggle="tooltip" title="Save" @click.prevent="save">@lang('Update Language')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('Translate')</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newlangForm">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('English')</label>
                                <input type="text" class="form-control" v-model="newKey" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">{{$la->name}}</label>
                                <input type="text" class="form-control" v-model="newVal" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Add Field" @click.prevent="addfield()">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/admin/js/vue.js') }}"></script>
<script src="{{ asset('assets/admin/js/axios.js') }}"></script>
<script>
    window.Laravel = @php echo  json_encode(['csrfToken' => csrf_token()]) @endphp ;
</script>

<script>
    window.app = new Vue({
        el: '#app',
        data: {
            datas: @php echo  $json; @endphp,
            current: '{{ $la->code }}',
            newVal: null,
            newKey: null,


            importData : {
                code : ''
            }

        },
        methods: {
            save() {
                $('#langForm').submit();
            },

            deleteElement(key) {
                Vue.delete(this.datas, key);
            },
            addfield() {
                Vue.set(this.datas, this.newKey, this.newVal);
                app.newKey = '';
                app.newVal = '';
                $("#addModal").modal('hide');
            },
            importKey()
            {
                var code = this.importData;
                axios.post('{{route('admin.language.import_lang')}}', code).then(function (res) {
                    app.datas = res.data;
                })

            }
        }
    })
</script>
@endpush

{!! Form::open(['id'=>'frm']) !!}
<input type="hidden" id="id" name="id" class="input-role">
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-lg-offset-3">

            <div class="panel panel-default">
                <div class="page-title">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success btn-sm" id='btnNew' type="button">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"> New</span>
                            </button>
                            <button class="btn btn-success btn-sm" id='btnSave' type="button">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"> Save</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Description</label>
                                <input type="text" class="form-control input-device" id="description" name='description' placeholder="Description">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Caterogia</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="0">Seleccione</option>
                                    @foreach($category as $val)
                                    <option value="{{$val->id}}">{{$val->description}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Marca</label>
                                <select class="form-control" id="mark_id" name="mark_id">
                                    <option value="0">Seleccione</option>
                                    @foreach($mark as $val)
                                    <option value="{{$val->id}}">{{$val->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
{!!Form::close()!!}
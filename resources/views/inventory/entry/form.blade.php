{!! Form::open(['id'=>'frm']) !!}
<input type="hidden" id="id" name="id" class="input-role">
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">

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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email">Elemento</label>
                                <select class="form-control" id="element_id" name="element_id">
                                    <option value='0'>Seleccione</option>
                                    @foreach($devices as $val)
                                    <option value='{{$val->id}}'>{{$val->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email">Serial</label>
                                <input type="text" class="form-control input-device" id="serial" name='serial' placeholder="Serial">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
{!!Form::close()!!}
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
                                <select class="form-control" id="entry_id" name="entry_id">
                                    <option value='0'>Seleccione</option>
                                    @foreach($entry as $val)
                                    <option value='{{$val->id}}'>{{$val->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email">Razon</label>
                                <select class="form-control" id="reason_id" name="reason_id">
                                    <option value='0'>Seleccione</option>
                                    @foreach($reason as $val)
                                    <option value='{{$val->code}}'>{{$val->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email">Comentario</label>
                                <textarea class="form-control " id="comment" name="comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
{!!Form::close()!!}
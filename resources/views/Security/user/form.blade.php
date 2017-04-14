<div class="modal fade" tabindex="-1" role="dialog" id='modalNew'>
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Role</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['id'=>'frm']) !!}
                <input type="hidden" id="id" name="id" class="input-user">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Nombre</label>
                            <input type="text" class="form-control input-user" id="name" name='name'>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input type="text" class="form-control input-user" id="email" name='email'>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Role</label>
                            <select class="form-control input-user" id="role_id" name="role_id">
                                <option value="0">Seleccione</option>
                                @foreach($role as $val)
                                <option value="{{$val->id}}">{{$val->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Clave</label>
                            <input type="password" class="form-control input-user" id="password" name='password'>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id='btnSave'>Save</button>
            </div>
        </div>
    </div>
</div>
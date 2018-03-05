<div class="col-md-4">
    @if(Session :: has('update'))
            <p class="flash label label-warning"><h5>{{Session :: get('update')}}</p>
    @endif
    @if(Session :: has('create'))
            <p class="flash label label-success"><h5>{{Session :: get('create')}}</p>
    @endif
    @if(Session :: has('delete'))
            <p class="flash label label-danger"><h5>{{Session :: get('delete')}}</p>
    @endif
    @if(Session :: has('register'))
            <p class="flash alert alert-warning label label-info"><h5>{{Session :: get('register')}}</p>
    @endif
    @if(Session :: has('feedback'))
            <p class="flash alert alert-warning label label-info"><h5>{{Session :: get('feedback')}}</p>
    @endif
</div>
<div class="row">
    @if( $errors->any() )
        <div class="col-md-ofsset-4 col-md-4">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger col-md-12">
                    <ul>
                        <li>{{$error}}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>
<style>
.fa-trash{
    color: red;
}
.alert{
    margin: 1 !important;
}
.alert ul li{
    position: relative;
    --top:-10px;
}
.fa-pencil{
    color:orange;
}
.table-btn{
    margin-left:90%;
    background-color: #00C853 !important;
    border: 0;
}
.btn-danger{
    background-color: #E53935 !important;
}
.btn-warning{
    background-color: #EF6C00 !important;
}
textarea, input[type="text"], input[type="password"], input[type="email"],  select, input[type="date"]{
    border : 0px !important;
    border-radius: 3px !important;
}
.table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > thead > tr > th {
    border: none !important;
}
.banner{
    background-color: rgba(0,0,0,0.4);
    border-radius: 3px;
    margin: 10px;
    padding: 20px;
}
.button, .btn-info{
    position: relative;
    bottom: 10px;
    right: 10%;
}
.centered{
    text-align: center;
}
</style>
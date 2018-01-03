<div class="col-md-4">
    @if(Session :: has('update'))
            <p class="flash label label-warning"><h5>{{Session :: get('update')}}</p></div>
    @endif
    @if(Session :: has('create'))
            <p class="flash label label-success"><h5>{{Session :: get('create')}}</p></div>
    @endif
    @if(Session :: has('delete'))
            <p class="flash label label-danger"><h5>{{Session :: get('delete')}}</p></div>
    @endif
</div>
<style>
.fa-trash{
    color: red;
}
.fa-pencil{
    color:orange;
}
h5{
    color:black !important;
}
</style>
@extends('layout')

@section('breadcrumb')
<li><a href="#">Home</a></li><li class="active">Manage Users</li>
@stop

@section('content')


<div class="modal fade" id="role">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-key"></i> Permissions</h4>
            </div>
            <div class="modal-body">
                    <center><img id="loader" style="height: 30px; display: none" src="{{url('images/ld.gif')}}" /></center>
                    <div id="perms_editor"></div>
            </div>
            <hr/>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="widget">

            <div class="widget-content padding">
            	<!-- Content Form Goes here -->
            	<div class="row" style="border: 1px solid #ccc; padding:4px;margin:1px">
                            
                            <div class="col-md-12">
                                <h4><i class="fa fa-list"></i> Manage Users</h4>
                                <hr/>
                                <div class="widget">

                                    <div class="widget-content">
                                        <br>    
                                        <div id="districtFBk"></div>      
                                        <div id="districtsArea">      
                                            <div class="table-responsive" >
                                                <form class='form-horizontal' role='form'>
                                                    <table id="datatables-1" class="table table-striped table-bordered datatables-1" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Profile</th>
                                                                <th>Username</th>
                                                                <th>Firstname</th>
                                                                <th>Lastname</th>
                                                                <th>Email</th>
                                                                <th>Role</th>
                                                                <th>Company</th>
                                                                <th>Branch</th>
                                                                <th>Status</th>
                                                                <th>Created At</th>
                                                                <th>Login Time</th>
                                                                <th>Logout Time</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>



                                                        <tbody >

                                                           <?php

                                                           		$i = 1;
                                                           		$users = [];
                                                           		if(Auth::user()->role_id == 1){
                                                           			$users = User::where('added_by', '!=', 0)->orderBy('id', 'DESC')->get();
                                                           		}else{
																	$users = User::where('added_by', Auth::user()->id)->orderBy('id', 'DESC')->get();
                                                           		}
																
															?>

                                                            @foreach($users as $r)
                                                            <tr>
                                                                <td>{{$i}}</td>
                                                                <td><img src="{{HelperX::userPic($r->id)}}" style="width:50px" /></td>
                                                                <td><label uid="{{$r->id}}" style="cursor:pointer" class="label label-default loginAsUser">{{$r->username}}</label></td>
                                                                <td><b>{{$r->firstname}}</b></td>
                                                                <td><b>{{$r->lastname}}</b></td>
                                                                <td><b>{{$r->email}}</b></td>
                                                                <td><b><a data-toggle="modal" user="{{$r->id}}" class="user_role" href='#role'>{{Role::find($r->role_id)->name}}</a></b></td>
                                                                <td><b>{{Company::find($r->company_id)->name}}</b></td>
                                                                <td><b>{{Branch::find($r->branch_id)->name}}</b></td>
                                                                <td><b>{{HelperX::getStatus($r->status)}}</b></td>
                                                                <td> {{$r->created_at}}</td>
                                                                <td> {{HelperX::getLoginTime($r->id)}}</td>
                                                                <td> {{HelperX::getLogoutTime($r->id)}}</td>
                                                                <td>{{HelperX::generateActions($r->id, route('companies.delete'), route('companies.edit'),'users')}}
                                                                	&nbsp; <span style="cursor: pointer" class="label label-info" title="Change password" >
																	<i class="fa fa-key"></i>
																</span>
                                                                </td>
                                                            </tr>
                                                            <?php $i++;?>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>

        </div>

    </div>	
</div>


@stop



@section('specific_js_libs')

<script src="{{url('assets/js/pages/tabs-accordions.js')}}"></script>
<script src="{{url('assets/libs/jquery-datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/libs/jquery-datatables/js/dataTables.bootstrap.js')}}"></script>
<script src="{{url('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
<script src="{{url('assets/js/pages/datatables.js')}}"></script>



<script type="text/javascript">
$(function(){
    $('.user_role').on('click', function(){
            $('#loader').show();
            var uid = $(this).attr('user');
            $('#perms_editor').html('');
            $.get('{{route("users.getPerms")}}', {user:uid},function(res){
                $('#loader').hide();
                $('#perms_editor').html(res);
            });
    });

    $('.loginAsUser').on('click', function(){
        var uid = $(this).attr('uid');
        var config = confirm('You will login as another user, Continue ??? But it is not good idea');
        if(config){
            window.location = '{{url("superadmin/loginAsUser/")}}/' + uid;
        }
    });

});
</script>



@stop



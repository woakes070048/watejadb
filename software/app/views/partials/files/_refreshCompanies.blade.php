<div id="regionFBk"></div>

<div id="regionsArea">

<div class="table-responsive" >
                                                <form class='form-horizontal' role='form'>
                                                    <table id="datatables-1" class="table table-striped table-bordered datatables-1" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Logo</th>
                                                                <th>Name</th>
                                                                <th>TIN</th>
                                                                <th>Address</th>
                                                                <th>Region</th>
                                                                <th>District</th>
                                                                <th>Street</th>
                                                                <th>Telephone</th>
                                                                <th>Email</th>
                                                                <th>Mobile</th>
                                                                <th>Business Type</th>
                                                                <th>Website</th>
                                                                <th>Created At</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>



                                                        <tbody >

                                                           <?php $i = 1;
                                                            $regions = Company::orderBy('created_at', 'DESC')->get();
                                                            ?>

                                                            @foreach($regions as $r)
                                                            <tr>
                                                                <td>{{$i}}</td>
                                                                <td><img src="{{HelperX::getCompanyLogo($r->id)}}" style="width:72px" /></td>
                                                                <td>{{$r->name}}</td>
                                                                <td>{{$r->tin}}</td>
                                                                <td>{{$r->location}}</td>
                                                                <td>{{Region::find($r->region_id)->name}}</td>
                                                                <td>{{District::where('region_id', $r->region_id)->first()->name}}</td>
                                                                <td>{{$r->street}}</td>
                                                                <td>{{$r->phone}}</td>
                                                                <td>{{$r->email}}</td>
                                                                <td>{{$r->mobile}}</td>
                                                                <td>{{Business::find($r->business_id)->name}}</td>
                                                                <td>{{$r->website}}</td>
                                                                <td>{{$r->created_at}}</td>
                                                                <td>{{HelperX::generateActions($r->id, route('companies.delete'), route('companies.edit'),'companies')}}</td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>


</div>



@include('partials.scripts._onlyJquery')
@include('partials.scripts._datatable')


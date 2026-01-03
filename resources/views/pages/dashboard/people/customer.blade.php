@extends('layout.app')
@section('content')

<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4 class="fw-bold">Customers</h4>
								<h6>Manage your customers</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Pdf" data-bs-original-title="Pdf"><img src="{{asset("assets")}}/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Excel" data-bs-original-title="Excel"><img src="{{asset("assets")}}/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh"><i class="ti ti-refresh"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse" data-bs-original-title="Collapse"><i class="ti ti-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#add-customer"><i class="ti ti-circle-plus me-1"></i>Add Customer</a>
						</div>
					</div>
					<!-- /product list -->
					<div class="card">
						<div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
							<div class="search-set">
								<div class="search-input">
									<span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
								<div id="DataTables_Table_0_filter" class="dataTables_filter"><label> <input type="search" class="form-control form-control-sm" placeholder="Search" aria-controls="DataTables_Table_0"></label></div></div>
							</div>
							<div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">

								<div class="dropdown">
									<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
										Status
									</a>
									<ul class="dropdown-menu  dropdown-menu-end p-3">
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Active</a>
										</li>
										<li>
											<a href="javascript:void(0);" class="dropdown-item rounded-1">Inactive</a>
										</li>

									</ul>
								</div>
							</div>
						</div>
						<div class="card-body p-0">
							<div class="table-responsive">
								<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer table-responsive"><table class="table datatable dataTable no-footer" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
									<thead class="thead-light">
										<tr><th class="no-sort sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="




											: activate to sort column descending" style="width: 35.4062px;">
												<label class="checkboxs">
													<input type="checkbox" id="select-all">
													<span class="checkmarks"></span>
												</label>
											</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Code: activate to sort column ascending" style="width: 39.2656px;">Code</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Customer: activate to sort column ascending" style="width: 143.031px;">Customer</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 169.531px;">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 95.5312px;">Phone</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending" style="width: 51.6094px;">Address</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending" style="width: 51.6094px;">City</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 49.7656px;">Status</th>
                                            <th class="no-sort sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 106.859px;">Action</th></tr>
									</thead>
									<tbody>



									<tr class="odd">
                                        @foreach($customers as $customer )


											<td class="sorting_1">
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>
											<td>CU00{{$customer->id}}</td>
											<td>
												<div class="d-flex align-items-center">
													<a href="javascript:void(0);" class="avatar avatar-md me-2">
														<img src="{{asset("assets")}}/img/users/user-33.png" alt="product">
													</a>
													<a href="javascript:void(0);">{{$customer->customer_name}}</a>
												</div>
											</td>
											<td>{{$customer->email}}</td>
											<td>+{{$customer->phone}}</td>
                                            @foreach($customer->address as $customer )
											<td>{{$customer->address}}</td>
											<td>{{$customer->city}}</td>

                                            @endforeach
											<td><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></td>
											<td class="d-flex">
												<div class="edit-delete-action d-flex align-items-center">
													<a class="me-2 p-2 d-flex align-items-center border rounded" href="#">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
													</a>
													<a class="me-2 p-2 d-flex align-items-center border rounded" href="#" data-bs-toggle="modal" data-bs-target="#edit-customer">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
													</a>
													<a data-bs-toggle="modal" data-bs-target="#delete-modal" class="p-2 d-flex align-items-center border rounded" href="javascript:void(0);">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
													</a>
												</div>

											</td>
										</tr>


                                      @endforeach

                                </tbody>
								</table><div class="dataTables_length" id="DataTables_Table_0_length"><label>Row Per Page <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select form-select-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> Entries</label></div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link"><i class="fa fa-angle-left"></i> </a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="next" tabindex="-1" class="page-link"> <i class=" fa fa-angle-right"></i></a></li></ul></div><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">1 - 10 of 10 items</div></div>
							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>


@endsection

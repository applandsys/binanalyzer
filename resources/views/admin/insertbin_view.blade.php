@extends('masterlayout.main_view')

@section('content')

	<section class="content-header">
      <h1>
       Insert Bin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"> Insert Bin </li>
      </ol>
    </section>
	
	<div class="row">
		<div class="col-xs-8 col-md-8 col-md-offset-3 col-xs-offset-3">	
			<center>
			@if (session('success'))
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Alert!</h4>
				Bin Inserted Success
			 </div>
			@elseif(session('failed'))
			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-warning"></i> Alert!</h4>
				Bin Insert Fail
			</div>
			@endif
			</center>
		</div>	
	</div>
		
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					<h3 class="box-title">Insert Bin</h3>
					</div>
					<form action="{{ route('admin.insertBin') }}" role="form" method="POST">
					@csrf
						<div class="box-body ">
						
							<div class="form-group">
							  <label>Country</label>
							  <select name="country" class="form-control"  required>
								<option value=""> Select Country </option>
								<option value="United States"> United States </option>
								<option value="Australia">Australia</option>
								<option value="Brazil"> Brazil </option>
								<option value="Canada"> Canada </option>
								<option value="France"> France </option>
								<option value="New Zealand"> New Zealand </option>
								<option value="Singapore"> Singapore </option>
								<option value="South Africa"> South Africa </option>
								<option value="United Kingdom"> United Kingdom </option>
							  </select>
							</div>
						
							<div class="form-group">
							  <label>Textarea</label>
							  <textarea name="binprefix" class="form-control" rows="3" placeholder="Bin" required></textarea>
							</div>
						</div>
						<div class="box-footer">
							<input type="submit" class="btn btn-primary">
						 </div>
					</form>
				</div>
			</div>
		</div>
	</section>
 
@endsection

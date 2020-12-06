@extends('masterlayout.main_view')

@section('content')

 <section class="content-header">
      <h1>
        All Bin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					<h3 class="box-title">Bin List</h3>
					</div>
					<div class="box-body">
					
						<form action="{{ route('admin.allbin') }}" class="form-inline" method="POST">
						@csrf
						  <div class="form-group mb-2">
							<label for="binprefix" class="sr-only">Bin</label>
							<input name="binprefix" type="text"  class="form-control" id="binprefix" value="Bin">
						  </div>
						  <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
						</form>
					
							<center><a href="{{ route('admin.syncbin') }}" class="btn btn-sm btn-primary text-center"> Sync </a></center> <br/>
						<table id="example2" class="table table-bordered table-hover">
						<thead>
						<tr>
						  <th>Sl</th>
						  <th>Bin Prefix</th>
						  <th>Country</th>
						  <th>Bank</th>
						  <th>Brand</th>
						  <th>Type</th>
						  <th>Sub Brand</th>
						  <th>Prepaid</th>
						  <th>Comments</th>
						  <th>Date</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						@php
						 $i =1;
						@endphp
						@foreach($allbin as $binlist)
						<tr>
						  <td>{{$i}}</td>
						  <td><a href="https://www.bankbinlist.com/search.html?bin={{ substr($binlist->binprefix,0,6) }}" target="blank">{{ $binlist->binprefix }}</a>
						  </td>
						  <td>{{ $binlist->country }}</td>
						  <td>{{ $binlist->bank }}</td>
						  <td>{{ $binlist->brand }}</td>
						  <td>{{ $binlist->type }}</td>
						  <td>{{ $binlist->sub_brand }}</td>
						  <td>{{ $binlist->prepaid }}</td>
						  <td>{{ $binlist->comments }}</td>
						  <td>{{ $binlist->created_at }}</td>
						  <td><a class="btn ">   
								<i class="fa fa-heart-o"></i> 
								<span class="badge bg-red">6</span>
							  </a>
							</td>
						</tr>
						@php
						 $i++;
						@endphp
						@endforeach
						</tfoot>
					  </table>
					  {{ $allbin->links() }}
					</div>
				</div>
			</div>
		</div>	
            <!-- /.box-header -->
            <div class="box-body">
	</section>
 
 <script>
 
 
 
            $.ajax({
               type:'POST',
               url:'{{ route("ajax.makeScript") }}',
               data:postdata,
               dataType:'json',
               success:function(data) {
					var output_text =  data.scriptText;
					$('#output_script').val(data.scriptText); 
					var charecter_count = output_text.length;
					var division =  (charecter_count / 160);
					var sms_count =	Math.ceil(division);
					$('#charecter_count').html("Charecter Count : " + charecter_count);
					$('#sms_count').html("SMS Count : " + sms_count);
               }
            });
 </script>
 
@endsection

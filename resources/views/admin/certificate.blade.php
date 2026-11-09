@include('layouts.admin.header')

<div class="col-12">
	<div class="table-responsive shadow-sm mt-3 p-3">
        <table class="table mt-1" style="width:100%">
            <thead>
                <th>Certificate</th>
                <th>Issue Date</th>
                <th>Expiration Date</th>
                <th>Action</th>
            </thead>
            <tbody>
            	<tr>
            		<td>Mtech</td>
            		<td>04/01/2024</td>
            		<td>04/06/2024</td>
            		<td>
            			<div>
                            <i class="fa-solid fa-eye"></i>
                        </div>
            		</td>
            	</tr>
            	<tr>
            		<td>Mtech</td>
            		<td>04/01/2024</td>
            		<td>04/06/2024</td>
            		<td>
            			<div>
                            <i class="fa-solid fa-eye"></i>
                        </div>
            		</td>
            	</tr>
            	<tr>
            		<td>Mtech</td>
            		<td>04/01/2024</td>
            		<td>04/06/2024</td>
            		<td>
            			<div>
                            <i class="fa-solid fa-eye-slash"></i>
                        </div>
            		</td>
            	</tr>
            </tbody>
       </table>
    </div>
</div>

@include('layouts.admin.footer')
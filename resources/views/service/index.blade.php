@extends('admin::layout')

@section('title', '微服务')

@section('content')
<div class="container">
	<div id="srv-console" style="display:none;position: relative;">
		<h3>接口总数 @{{ total_apis }}</h3><hr />	
		<div class="srv" v-for="(item, service) in service_list">
			<div class="srv-header" onclick="$('.srv-body',$(this).parent()).slideToggle(180)">
				<span v-if="item && item.apis" class="p-online"></span>
				<span v-else class="p-offline"></span>
				<span>@{{ service }}</span>
				<span v-if="item.error" class="api-header-error">@{{ item.error }}</span>			
				<span v-if="item && item.apis" style="float:right">
					<span v-if="item.apis" class="badge" >@{{ item.apis.length }}</span>
				</span>
			</div>
			<div v-if="item && item.apis" class="srv-body" style="display: none">
				<div class="srv-api" v-for="(api, i) in item.apis">
					<div class="srv-api-header" onclick="$('.api-body',$(this).parent()).slideToggle(180)">
						<div class="api-title">@{{ api.title }}</div>
						<div>@{{ api.name }}</div>
					</div>
					<div class="api-body" style="display: none">
						<div class="api-summary" v-if="api.summary" v-html="api.summary"></div>
						<table class="table srv-api-params-list">
							<thead style="display: none">
								<tr><td class="c-key">key</td><td class="c-ipt">input</td><td class="c-type">type</td><td>desc</td></tr>
							</thead>
							<tbody>
							<tr v-for="(param, j) in api.parameters">
								<td class="param_key c-key">
									<span v-bind:class="{ required: param.required }">@{{ param.name }}</span>
								</td>
								<td class="c-ipt">
									<textarea v-model="param.value" class="form-control" v-if="param.allowMultiple"></textarea>					
									<input v-bind:id="'ipt-'+service+'-'+i+'-'+j" v-bind:type="param.type" v-model="param.value" v-else="param.allowMultiple" />
								</td>
								<td class="c-type">@{{ param.type }}</td>
								<td>@{{ param.description }}</td></td>
							</tr>
							</tbody>
							<tfoot>
								<tr><td></td><td>
									<button @click="sendRequest(service, i)" 
									v-bind:disabled="api.loading"
									class="btn btn-default">
									<i class="glyphicon glyphicon-send"></i>
									执行</button>
								</td><td colspan="2"></td></tr>
							</tfoot>
						</table>
						<div class="srv-api-response">
							<div v-if="api.loading">loading...</div>
							<div v-show="api.response">
								PHP:
	<div class="code">
		use Shopex\Luban\Facades\Luban;

		$result = Luban::s('@{{ service }}')->@{{ api.name }}(array(
			<span v-for="(param, j) in api.parameters">'@{{ param.name }}'=> '@{{param.value}}',</span>
		));
	</div>
	<hr />
							</div>
							<div v-show="api.response" class="code srv-api-response-body">@{{ api.response }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(function(){
	$.ajax({
		url: "{{ url('/service/json') }}",
		success: function(data){
			var total_apis = 0;
			for(d in data){
				if(data[d] && 'apis' in data[d]){
					for(a in data[d].apis){
						total_apis ++;
						data[d].apis[a].response = "";
						data[d].apis[a].loading = false;
					}
				}
			}
			window.app = new Vue({
				  el: '#srv-console',
				  data: {service_list: data, total_apis: total_apis},
				  methods:{
					  sendRequest: function(srv, i){
					  	var formData = new FormData();
					  	formData.set("service", srv);
					  	formData.set("func", data[srv].apis[i].name);
					  	$(data[srv].apis[i].parameters).each(function(j, v){
					  		if(v.type=="file"){
					  			if($('#ipt-'+srv+'-'+i+'-'+j)[0].files[0]){
									formData.set("input["+v.name+"]", $('#ipt-'+srv+'-'+i+'-'+j)[0].files[0]);
					  			}
					  		}else if(v.value){
									formData.set("input["+v.name+"]", v.value);
					  		}
					  	})

					  	data[srv].apis[i].loading = true;
					  	$.ajax({
					  		url: "{{ url('/service/invoke') }}",
					  		method:"POST",
					  		data: formData,
					  		contentType: false,
					  		processData: false,
					  		success: function(invokeResponse){
					  			data[srv].apis[i].response = invokeResponse;
					  		},
					  		complete: function(){
								data[srv].apis[i].loading = false;
					  		}
					  	})
					  }
				  }
				});
			$('#srv-console').show();
		}
	})
})
</script>
@endsection
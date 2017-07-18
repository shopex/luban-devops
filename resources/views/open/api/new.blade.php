@extends('layouts.app')

@section('title', '开放接口')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('open/') }}">开放接口</a></li>
  <li class="active">新建接口</li>
</ol>

<form method="POST" id="api-editor" style="display: none">
<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
<div class="row">
  <div class="col-md-6">
  <div class="panel panel-default">
      <div class="panel-heading">后端接口</div>
      <div class="panel-body">
          <div class="form-group">
            <label >后端服务</label>
            <select class="form-control" v-model="current_backend" name="backend">
              <option v-for="(item, backend) in backend_apis" v-bind:value="backend">@{{ backend }}</option>
            </select>
          </div>
          <div class="form-group">
            <label >后端服务方法</label>
            <select class="form-control" v-model="current_api_idx">
              <option v-for="(item, idx) in backend_apis[current_backend].apis" v-bind:value="idx">@{{ item.name }}</option>
            </select>
            <input type="hidden" name="backend_method" v-model="api_code" />
          </div>

          <div class="form-group">
            <label >后端服务名称</label>
            <p class="form-control-static">@{{api_title}}</p>
          </div>

      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">对外服务API</div>
    	<div class="panel-body">

          <div class="form-group">
            <label >对外接口包</label>
            <select class="form-control" v-model="current_pkg" name="package_id">
              <option v-for="(item, pkg) in pkgs" v-bind:value="item.id">@{{ item.code }} - @{{ item.name }}</option>
            </select>
          </div>

          <div class="form-group">
            <label >接口代码</label>
            <div class="input-group">
                <div class="input-group-addon">@{{ current_pkg_code }}</div>
                <input type="text" name="api_code" class="form-control" v-bind:placeholder="default_api_code">
                <input type="hidden" name="default_api_code" v-model="default_api_code" />
            </div>
          </div>

          <div class="form-group">
            <label >名称</label>
            <input type="text" name="api_title" class="form-control" v-bind:placeholder="api_title">
            <input type="hidden" name="default_api_title" v-model="api_title" />
          </div>

    	</div>
    </div>
  </div>
</div>

    <div class="panel panel-default">
      <div class="panel-heading">参数表</div>
      <div class="panel-body">

      <table class="table table-bordered">
      <thead>
        <tr>
          <td colspan="4">后端参数</td>
          <td colspan="3">对外暴露参数</td>
        </tr>      
        <tr>
          <td width="100px">参数名</td>
          <td>简介</td>
          <td width="100px">类型</td>
          <td width="100px">必填</td>

          <td width="200px">预设值</td>
          <td width="100px">是否隐藏</td>
          <td width="100px">必填</td>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, idx) in params">
          <td>
            @{{item.name}}
            <input type="hidden" name="param_key[]" v-bind:value="item.name" />
          </td>
          <td>
            @{{item.description}}
            <input type="hidden" name="param_desc[]" v-bind:value="item.description" />
            </td>
          <td>
            @{{item.type}}
            <input type="hidden" name="param_type[]" v-bind:value="item.type" />
          </td>
          <td>@{{item.required}}</td>
          <td><input name="param_value[]" v-model="param_values[idx]" type="text" /></td>
          <td>
            <input type="checkbox" 
              :name="'param_hidden['+idx+']'" 
              value="1" v-if="param_real_required[idx]" 
              disabled="disabled" v-model="params_hidden[idx]" />
            <input 
            :name="'param_hidden['+idx+']'" 
            type="checkbox" v-else />
          </td>
          <td>
            @{{param_real_required[idx]}}
            <input type="hidden" name="param_required[]" v-bind:value="param_real_required[idx]" />
          </td>
        </tr>
        </tbody>
      </table>

      </div>
  </div>

    <div class="panel panel-default">
      <div class="panel-heading">文档</div>
      <div class="panel-body">
      <textarea class="form-control" rows="15">
        
      </textarea>
      </div>
    </div>

<hr />
<button type="submit" class="btn btn-default">创建新接口</button>

</form>

<script>
$(function(){
  var pkgs = {!! json_encode($pkgs) !!};
  var code_map = {};
  for(i in pkgs){
    code_map[pkgs[i].id] = pkgs[i].code;
  }
  $.ajax({
    url: "{{ url('/service/json') }}",
    success: function(data){
      var current_pkg = pkgs[0].id;
      var current_backend = Object.keys(data)[0];
      var current_api_idx = 0;
      var param_values = [];
      var params_hidden = [];
      window.app = new Vue({
          el: '#api-editor',
          data: {
            pkgs: pkgs, 
            backend_apis: data, 
            current_backend: current_backend, 
            current_pkg: current_pkg,
            current_api_idx: current_api_idx,
            param_values: param_values,
            params_hidden: params_hidden
          },
          computed: {
            current_pkg_code: function(){
              return code_map[this.current_pkg]+'.';
            },
            api_code: function(){
              if(this.backend_apis[this.current_backend]){
                var api = this.backend_apis[this.current_backend].apis[this.current_api_idx];
                return api.name;
              }
              return '';
            },
            default_api_code: function(){
              if(this.backend_apis[this.current_backend]){
                var api = this.backend_apis[this.current_backend].apis[this.current_api_idx];
                return api.name.replace(/_/g, '.');
              }
              return '';
            },
            api_title: function(){
              if(this.backend_apis[this.current_backend]){
                var api = this.backend_apis[this.current_backend].apis[this.current_api_idx];
                return api.title;
              }
              return '';
            },
            params: function(){
              if(this.backend_apis[this.current_backend]){
                return this.backend_apis[this.current_backend].apis[this.current_api_idx].parameters
              }
              return [];
            },
            param_real_required: function(){
              var ret = [];
              for( i in this.params){
                ret[i] = this.params[i].required && (this.param_values[i]==undefined || this.param_values[i]=='');
              }
              return ret;
            }
          }
        });
      $('#api-editor').show();
    }
  })
});
</script>
@endsection
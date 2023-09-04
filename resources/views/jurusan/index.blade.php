<!DOCTYPE html>
<html>
<head>
    <title>kamppus.ac.id</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container" id="appVue">
        <div class="modal fade" id="modalTambahData" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Warning</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Jurusan</label>
                                    <input v-model ="jurusan" type="text" class="form-control" placeholder="Nama Jurusan">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button v-on:click.prevent="storeJurusan" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            <br>
            <br>
            <br>
            <button class="btn btn-lg btn-primary" v-on:click.prevent="tambahData">Tambah Data</button>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Jurusan</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="item in data_jurusan">
                            <tr>
                                <td>@{{item.jurusan}}</td>
                                <td>@{{item.created_at}}</td>
                                <td>@{{item.updated_at}}</td>
                                <td>
                                    <button v-on:click.prevent="editData(item.id)" class="btn btn-xs btn-warning">Edit Data</button>
                                    <button v-on:click.prevent="hapusData(item.id)"class="btn btn-xs btn-danger">Hapus Data</button>
                                </td>
                            </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var vue =new Vue ({
            el:"#appVue",
            data:{
                data_jurusan:[],
                jurusan: null,
                id_edit:null
            },
            mounted(){
                this.getData();

            },
            methods:{
                getData: function(){
                    var url ="{{ url('get-jurusan')}}";

                    axios.get(url)
                        .then(resp => {
                            console.log(resp);
                            this.data_jurusan =resp.data;
                        })
                        .catch(err=> {
                            console.log(err);
                        })
                        .finally(() =>{

                        })
                },
                tambahData: function(){
                    $('#modalTambahData').modal('show');

                },
                storeJurusan: function(){
                    var form_data = new FormData();
                    form_data.append("jurusan",this.jurusan);
                    form_data.append("id_edit",this.id_edit);

                    var url="{{url('store-jurusan')}}";
                    axios.post(url,form_data)
                        .then(resp => {
                            $('#modalTambahData').modal('hide');
                            alert('Success');
                            this.jurusan=null;
                            this.id_edit=null;

                            this.getData();
                        })
                        .catch(err=> {
                            alert('erorr');
                            console.log(err);
                        })                
                },
                editData: function(id){
                    this.id_edit = id;

                    var url="{{url('get-jurusan')}}" + '/'+id;

                    axios.get(url)
                        .then(res=> {
                            var jurusan = res.data;
                            this.jurusan = jurusan.jurusan;

                            this.tambahData();
                        })
                        .catch(err =>{
                            alert('erorr');
                            console.log(err);
                        })
                        .finally(()=>{

                        })
                },
                hapusData: function(id){
                    var url ="{{url('hapus-jurusan')}}" + '/'+id;
                    
                    axios.delete(url)
                        .then(res=> {
                            console.log(res);
                            this.getData();
                        })
                        .catch(err=> {
                            alert('erorr');
                            console.log(err);
                        })
                        .finally(() =>{

                        })
                }
            }
        })
    </script>
</body>
</html>
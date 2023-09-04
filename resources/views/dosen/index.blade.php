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
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input v-model="nama" type="text" class="form-control" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Email</label>
                                    <input v-model="email" type="text" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phone</label>
                                    <textarea v-model="phone" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button v-on:click.prevent="storeDosen" type="submit" class="btn btn-primary">Submit</button>
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="item in data_dosen">
                                <tr>
                                    <td>@{{item.nama}}</td>
                                    <td>@{{item.email}}</td>
                                    <td>@{{item.phone}}</td>
                                    <td>@{{item.created_at}}</td>
                                    <td>@{{item.updated_at}}</td>
                                    <td>
                                        <button v-on:click.prevent="editData(item.id)" class="btn btn-xs btn-warning">Edit Data</button>
                                        <button v-on:click.prevent="hapusData(item.id)" class="btn btn-xs btn-danger">Hapus Data</button>
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
        var vue =new Vue({
            el: "#appVue",
            data: {
                data_dosen: [],
                nama:null,
                email:null,
                phone:null,
                id_edit: null
            },
            mounted() {
                this.getData();

            },
            methods:{
                getData: function() {
                    var url ="{{url('get-dosen')}}";

                    axios.get(url)
                        .then(resp => {
                            console.log(resp);
                            this.data_dosen=resp.data;
                        })
                        .catch(err => {
                            console.log(err);
                        })
                        .finally(() => {

                        })
                },
                tambahData: function(){
                    $('#modalTambahData').modal('show');
                },
                storeDosen: function(){
                    var form_data=new FormData();
                    form_data.append("nama",this.nama);
                    form_data.append("email",this.email);
                    form_data.append("phone",this.phone);
                    form_data.append("id_edit",this.id_edit);

                    var url ="{{url('store-dosen')}}";

                    axios.post(url,form_data)
                        .then(resp=> {
                            $('#modalTambahData').modal('hide');
                            alert('success');
                            this.nama=null;
                            this.email=null;
                            this.phone=null;
                            this.id_edit=null;

                            this.getData();
                        })
                        .catch(err =>{
                            alert('erorr');
                            console.log(err);
                        })
                },
                editData: function(id){
                    this.id_edit=id;

                    var url="{{ url('get-dosen')}}" +'/'+ id;

                    axios.get(url)
                        .then(res =>{
                            var dosen = res.data;
                            this.nama = dosen.nama;
                            this.email = dosen.email;
                            this.phone = dosen.phone;

                            this.tambahData();
                        })
                        .catch(err=> {
                            alert('erorr');
                            console.log(err);
                        })
                        .finally(() => {

                        })
                },
                hapusData: function(id){
                    var url ="{{url('hapus-dosen')}}" + '/'+id;

                    axios.delete(url)
                        .then(res => {
                            console.log(res);
                            this.getData();
                        })
                        .catch(err=>{
                            alert('erorr');
                            console.log(err);
                        })
                        .finally(()=> {

                        })
                }

            }
        })
    </script>
</body>
</html>
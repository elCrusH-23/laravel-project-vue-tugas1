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
                                <input v-model="nama"type="text" class="form-control" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sku</label>
                                <input v-model="sku"type="text" class="form-control" placeholder="sku">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Type</label>
                                <input v-model="type"type="text" class="form-control" placeholder="type">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button v-on:click.prevent="storeProduct" type="submit" class="btn btn-primary">Submit</button>
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
                <button class="btn btn-lg btn-primary" v-on:click.prevent="tambahData">Tambah Data</button>
                <div class="table-responsive">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Search" v-model="search" v-on:keyup="getData()">
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th>Nama</th>
                            <th>Sku</th>
                            <th>Type</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="item in data_produk">
                                <tr>
                                    <td>@{{ item.nama }}</td>
                                    <td>@{{ item.sku }}</td>
                                    <td>@{{ item.type }}</td>
                                    <td>
                                        <button v-on:click.prevent="editData(item.id)" class="btn btn-xs btn-warning">Edit Data</button>
                                    </td>
                                    <td>
                                        <button v-on:click.prevent="hapusData(item.id)" class="btn btn-xs btn-danger">Hapus Data</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div>
                    <button @click.prevent="gantiHalaman(prev_page_url)" class="btn btn-primary">Prev</button>
                    <button @click.prevent="gantiHalaman(next_page_url)" class="btn btn-primary">Next</button>
                </div>
                    <div class="row">
                        <div class="col-md-1">
                            <select class="form-control" v-model="paging" v-on:change="getData()">
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    showing @{{from}} to @{{to}} of @{{total}} entries
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var vue = new Vue({
            el: "#appVue",
            data: {
            url: '',
            data_produk: [],
            nama:null,
            sku:null,
            type:null,
            id_edit:null,

            next_page_url: '',
            prev_page_url: '',

            paging:'',
            search:'',

            from: '',
            to: '',
            total:''
            },
            mounted() {
            this.paging=5;
            this.url = "{{ url('get-master-product-paging') }}"
            this.getData();
            },
            methods: {
            getData: function() {
                axios.get(this.url, {
                    params:{
                        paging: this.paging,
                        search: this.search
                    }
                    })
                    .then(resp => {
                        this.data_produk =resp.data.data;

                        this.next_page_url = resp.data.next_page_url;
                        this.prev_page_url = resp.data.prev_page_url;

                        this.from =resp.data.from;
                        this.to = resp.data.to;
                        this.total = resp.data.total;
                    })
                    .catch(err => {
                        alert('error');
                        console.log(err);
                    })
                },
                gantiHalaman: function(url) {
                this.url = url;
                this.getData();
                },
                tambahData: function(){
                    $('#modalTambahData').modal('show');
                },
                storeProduct: function(){
                    var form_data = new FormData();
                    form_data.append("id",null);
                    form_data.append("nama",this.nama);
                    form_data.append("sku",this.sku);
                    form_data.append("type",this.type);
                    form_data.append("id_edit",this.id_edit);

                    var url="{{url('store-product')}}";

                    axios.post(url,form_data)
                        .then(resp =>{
                            $('#modalTambahData').modal('hide');
                            alert('Success');
                            this.nama= null;
                            this.alamat=null;
                            this.id_edit = null;

                            this.getData();
                        })
                        .catch(err=> {
                            alert('erorr');
                            console.log(err);
                        })
                    // for (var pair of form_data.entries()){
                    //     console.log(pair[0] + ',' + pair[1]);
                    // }
                },
                editData: function(id) {
                    this.id_edit = id;

                    var url ="{{ url('get-product') }}" + '/' + id;

                    axios.get(url)
                        .then(res => {
                            var product =res.data;
                            this.nama = product.nama;
                            this.sku = product.sku;
                            this.type = product.type;

                            this.tambahData();
                        })
                        .catch (err => {
                            alert('erorr');
                            console.log(err);
                        })
                        .finally(() => {

                        })
                },
                hapusData: function(id){
                    var url ="{{ url('hapus-product')}}" +'/'+id;

                    axios.delete(url)
                        .then(res =>{
                            console.log(res);
                            this.getData();
                        })
                        .catch(err=> {
                            alert('erorr');
                            console.log(err);
                        })
                        .finally(()=>{

                        })
                }
            }
        })  
    </script>
</body>
</html>
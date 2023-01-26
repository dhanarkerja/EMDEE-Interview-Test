
# EMDEE POS Interview test

Di project ini akan membahas tentang fungsi dari semua web tes interview emdee


## Alur penggunaan website POS tes interview

Dalam project ini ada bagian login, dashboard, admin control, dan yang terakhir input barang


## Bagian Login

![App Screenshot](https://i.imgur.com/VJKqFEc.jpeg)
Bagian login ini merupakan awal halaman untuk mengakses web project user dibagi 3 tingkat yaitu **pembelian**, **administrasi**, dan yang terakhir **user**.

**user** hanya memiliki akses dashboard saja

**pembelian** memiliki akses dashboard dan input barang

**administrasi**  memiliki semua akses saja (email: admin@localhost.com password: password)

Apabila belum memiliki akun maka harus menuju register untuk membuat akun untuk web project ini
## Bagian Register

![App Screenshot](https://i.imgur.com/TDq76Se.jpeg)
Bagian register ini merupakan halaman untuk membuat akun dalam web project ini. Setiap akun baru pasti akan memiliki akses **user** dan untuk mengubah akun level akses hanya user dengan **administrasi** saja yang bisa melakukannya. 

Setelah membuat akun langsung kembali ke halaman *login* dan menuju ke halaman *dashboard*.
## Bagian Dashboard
![App Screenshot](https://i.imgur.com/LTT0ajY.jpeg)
Bagian dashboard  ini merupakan tampilan awal ketika sudah melakukan login. Ada 2 Carousel untuk menampilkan gambar beranda dan produk barang. Dan di bagian navigasi ada 3 navigasi tab yaitu :

1. #### Input barang
2. #### Data Admin
3. #### Nama profile ( kalau di klik akan muncul dropdown dengan isinya logout )


## Bagian Data Admin
![App Screenshot](https://i.imgur.com/LXbmsQz.jpeg)
Bagian data admin  ini merupakan tampilan mengubah akses level setiap user. Dan hanya diberika **user** dan **pembelian**. Ini hanya bisa dilakukan oleh user dengan level administrasi.

![App Screenshot](https://i.imgur.com/PNh5X0A.jpeg)
Jika di klik edit maka muncul gambar seperti yang diatas.
## Bagian Input Barang
![App Screenshot](https://i.imgur.com/cCruxhX.jpeg)
Bagian ini merupakan input barang yang mana pembelian dan administrasi melakukan input barang. Dan hasil input barang tersebut bisa di munculkan di bagian *Dashboard* ( Produk Terbaru ) dan halaman *Input Barang*. Di halaman ini ada beberapa fungsi, yaitu :
1. #### Input
2. #### Edit
3. #### Delete
4. #### Search



## Bagian Input Barang ( Input )
![App Screenshot](https://i.imgur.com/mCyMwYq.jpeg)
Bagian ini merupakan input data yang bisa dilakukan lebih dari 1 data dalam sekali submit atau input data dengan tombol **Add Input Area**, input field bisa bertambah sesuai keinginan.


![App Screenshot](https://i.imgur.com/E1x2ZtQ.jpeg)
Dan gambar diatas merupakan hasil dari inputan multiple field.

## Bagian Input barang ( Edit )
![App Screenshot](https://i.imgur.com/HHv8eFv.jpeg)
Bagian ini merupakan edit data spesifik dan hanya dilakukan satu per satu


![App Screenshot](https://i.imgur.com/0jUtvO8.jpeg)
Dan gambar diatas merupakan hasil edit data.
## Bagian Input Barang Delete ( Delete )
![App Screenshot](https://i.imgur.com/OgZbYiA.jpeg)
Bagian ini merupakan delete data yang dilakukan seperti edit data. Apabila ingin menghapus data, maka muncul notifikasi hapus data.


![App Screenshot](https://i.imgur.com/yIS7YZm.jpeg)
Dan gambar diatas merupakan hasil delete data.
## Bagian Input Barang (Search)
![App Screenshot](https://i.imgur.com/fzxRHYt.jpeg)
Bagian ini merupakan search data. Apabila input search field dihapus tanpa menggunakan cross maka data kembali semula

## Library, Framework, dan Dependencies
Semua dikerjakan menggunakan Laravel, Bootstrap, Ajax Jquery, dan owl carousel.
## Ajax Code
Dibagian input barang tidak diperlukan refresh website karena sudah menggunakan ajax. Dan bagian bawah ini merupakan ajax code dari project interview test.
```http
     $(document).ready(function() {
            read()
            $('.owl-carousel').owlCarousel({
                loop: true,
                dots: true,
            })
        });
        // search barang dan read
        function read() {
            var search = $("#search").val();
            if(search == null || search == '') {
                $.get("{{ route('getBarang') }}", {}, function(data, status) {
                    $("#read").html(data);
                });
            } else {
                $.get("{{ url('admin/search-barang') }}"+'/'+search, {}, function(data, status) {
                    $("#read").html(data);
                });
            }
        }
        function addinputfield(){
    
            var more_fields = 
                `<div class="form-group">
                    <input type="text" name="name[]" id="name" class="form-control" placeholder="name product">
                    <input type="number" name="quantity[]" id="quantity" class="form-control" placeholder="price">
                </div>`;
            $(".input-fields").append(more_fields);
        }
        // modal create barang
        function create() {
            $.get("{{  route('createBarang') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Create Product')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }
          // untuk proses create data
        function store() {
            var name = []
            $("input[name^='name']").each(function () {
                    name.push($(this).val())
            });
            var quantity = []
            $("input[name^='quantity']").each(function () {
                    quantity.push($(this).val())
            });
            for (i = 0; i < name.length; ++i) {
                $.ajax({
                type: "get",
                url: "{{ route('storeBarang') }}",
                data: { 'name': name[i], 'quantity':quantity[i]},
                    success: function(data) {
                        console.log(name[i])
                        console.log(quantity[i])
                    }
                });
            }
            $(".btn-close").click();
            read();
        }
        // menampilkan modal
        function show(id) {
            $.get("{{ url('admin/show-barang') }}"+'/'+id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Product')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }
        // untuk proses update data
        function update(id) {
            var name = $("#nameEditBarang").val();
            var quantity = $("#quantityEditBarang").val();
            $.ajax({
                type: "get",
                url: "{{ url('admin/update-barang') }}"+'/'+ id,
                data:{ 'name': name, 'quantity':quantity},
                success: function(data) {
                    $(".btn-close").click();
                    read()
                }
            });
        }
        // untuk delete atau destroy data
        function destroy(id) {
            if(confirm("Apakah anda ingin menghapus barang ?")== true) {
                alert("Barang telah terhapus")
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/destroy-barang') }}"+'/'+ id,
                    data: "name=" + name,
                    success: function(data) {
                        $(".btn-close").click();
                        read()
                    }
                });
                return true;
            } else {
                alert("Barang tidak jadi di hapus");
                return false;
            }
        }
```
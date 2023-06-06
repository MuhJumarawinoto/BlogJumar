@include('layouts.Header.Header')
<body>
@include('layouts.Body.Navbar')

<div class="contact_section layout_padding">
         <div class="container">
            <h1 class="contact_text">Buat Post</h1>
         </div>
</div>
<div class="contact_section_2 layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12 padding_0">
               <form action="{{route('post.store')}}" method="PUT" enctype="multipart/form-data">
                @csrf
                  <div class="mail_section">
                     <div class="">
                        <div class="form-group">
                           <input type="text" class="email-bt" placeholder="{{$post->judul}}" name="judul">
                        </div>
                        
                        <div class="form-group">
                           <textarea class="form-control "  rows="5" id="content" name="artikel">{!! $post->artikel !!}</textarea>
                            </div>
                                                
                        <div class="mb-3 justify-center">
                            <div class="mb-3"> <img src="{{asset('storage/gambar/'.$post->gambar)}}" alt="{{$post->gambar}}" id="image-preview"> </div>
                            <label for="image" class="text-light form-label">Pilih Gambar</label>
                            <input type="file" class="form-control" id="file-input" name="gambar" >
                        </div>

                        
                        <div class="send_btn">
                        
                        <button type="submit">SAVE</button>   
                        
                     </div>
                  </div>
                </form>
                </div>
            </div>
         </div>
      </div>
</body>
<div class="about_section layout_padding">
         <div class="container p-4">
            <div class="row justify-content-center">
            
            </div>   
         </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace( 'content' );
   
        // Ambil elemen input file
        const fileInput = document.getElementById('file-input');
        const imagePreview = document.getElementById('image-preview');

        // Tangani perubahan input file
        fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0]; // Ambil file yang dipilih

        // Validasi tipe file
        if (file && file.type.includes('image')) {
            const reader = new FileReader(); // Membuat objek FileReader

            reader.onload = (e) => {
            // Setelah file selesai dibaca
            imagePreview.src = e.target.result; // Tampilkan gambar pada elemen img dengan mengatur atribut src
            };

            reader.readAsDataURL(file); // Baca file sebagai URL data
        }
        });
    </script>
@include('layouts.Footer.Footer')
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
               <form action="{{route('post.store')}}" method="POST">
                @csrf
                  <div class="mail_section">
                     <div class="">
                        <div class="form-group">
                           <input type="text" class="email-bt" placeholder="Judul Artikel" name="judul">
                        </div>
                        
                        <div class="form-group">
                           <textarea class="form-control " placeholder="Massage" rows="5" id="comment" name="artikel"></textarea>
                            </div>
                                                
                        <div class="mb-3">
                            <label for="image" class="text-light form-label">Pilih Gambar</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
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
@include('layouts.Footer.Footer')
@include('layouts.Header.Header')
<body>
 
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
     @include('layouts.Body.Navbar')
     @include('layouts.Body.Banner')
    
    @forelse ($posts as $post)
    <div class="about_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="about_taital_main">
                     <div class="about_taital">{{$post->judul}}</div>
                     <p class="about_text">{!! $post->artikel !!}</p>             
                     <div class="read_bt"><a href="#">Read More</a></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="about_img"><img src="images/about-img.png"></div>
               </div>
            </div>
         </div>
    </div>
    @empty
  
    <div class="about_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="about_taital_main">
                  <div class="about_taital">Data masih belum ada!!</div>
                  </div>
               </div>
            </div>   
         </div>
    </div>
    @endforelse
    <div class="about_section layout_padding">
         <div class="container p-4">
            <div class="row justify-content-center">
            {{ $posts->links() }}
            </div>   
         </div>
    </div>
    
</body>


@include('layouts.Footer.Footer')
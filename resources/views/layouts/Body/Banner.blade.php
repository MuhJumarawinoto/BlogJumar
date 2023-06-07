<!-- banner section start -->
<div class="banner_section layout_padding">
         @foreach($banner as $item)
         <div class="container">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="banner_taital">
                              <h1 class="outstanding_text"></h1>
                              <h1 class="coffee_text">{{$item->judul}}</h1>
                              <p class="there_text">{{$item->artikel}}</p>
                              <div class="learnmore_bt"><a href="#">Learn More</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
             @endforeach
             <a class="carousel-control-prev" href="{{ $banner->nextPageUrl() }}" role="button" data-slide="prev">
               <i class="fa fa-angle-left"></i>
               </a>
               <a class="carousel-control-next" href="{{ $banner->nextPageUrl() }}" role="button" data-slide="next">
               <i class="fa fa-angle-right"></i>
               </a>
            </div>
         </div>
      </div>
<!-- banner section end -->
<div class="container">
    <br>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            @for($i = 1; $i < $slide->count(); $i++)
                <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
            @endfor
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($slide as $key => $item)
                <div class="item @if($key == 0) active @endif">
                    <a href='product-detail/{{$item->product->id}}'>
                    <img src="{{asset('front-end/slide/banner'.($key+1).'.jpg')}}">

                    <div class="carousel-caption">
                        <h3>{{$item->product->name}}</h3>
                        <p>{{$item->product->description}}</p>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<script>
    $(document).ready(function(){
        // Activate Carousel
        $("#myCarousel").carousel({
            interval: 3000,
            pause : 'hover'
        });

        // Enable Carousel Controls
        $(".left").click(function(){
            $("#myCarousel").carousel("prev");
        });
        $(".right").click(function(){
            $("#myCarousel").carousel("next");
        });
    });
</script>
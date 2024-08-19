    {!! adsense_testimonials_728x90() !!}
    <style>
        #testimonials {
            font-family: 'satoshi';
        }
        
        #testimonials header h2{
            color: white;
            font-family: 'satoshi';
        }
        #testimonials header{
            text-align: left;
            margin-left: 10rem;
            margin-right: 10rem;
            font-family: 'satoshi';

        }
        #testimonials .flickity-button{
            color: white;
            opacity: 50%;
        }
        #testimonials .banner-divider .fill-background{
            fill: hsl(0deg 0% 100%);
        }
        .test-card{
            background: #F5F1FF;
            border-radius: 40px;
            padding: 80px;
            box-shadow: 0px 0px 15px 0px;
        }

    
        .carousel {
          font-family: Arial, Helvetica, sans-serif;
          margin:auto;
          max-width: 945px;
          height: 450px;
          border-radius: 20%;
        }
        .flickity-viewport{
            height: 425px !important;
        }
        .flickity-page-dots{
            bottom: 0px !important;
        }
        .carousel-cell {
          margin-top: 35px;
          margin-right: 35px;
          float: right;
          max-width: 280px;
          width: 100%;
          padding: 10px;
          color: white;
          border-radius: 15px;
          counter-increment: carousel-cell;
          transition: all .3s ease;
          opacity: 0.3;
          /*background: #b9b9b9;*/
          filter: blur(1px);
          transform: none;
          
        }
          .carousel-cell.is-selected {
            filter: blur(0);
            opacity: 1;
            background: transparent;
            transform: scale(1.1);
            /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.6), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
          }
            
            /* name */
        .carousel-cell .n {
          font-size: 18px;
          text-align: left;
          color:white;
          counter-increment: carousel-cell;
        }
            
        .carousel-cell .name {
            font-size: 28px;
            text-align: left;
    color: white;
    font-weight: 700;
    counter-increment: carousel-cell;
                font-family: 'satoshi';

        }
            /* button */
        .carousel-cell .b {
          cursor: pointer;
          margin: auto;
          width: 180px;
          padding: 1px;
          background: green;
          border: 1px solid green;
          border-radius: 15px;
          font-size: 15px;
          color: white;
          text-align: center;
          counter-increment: carousel-cell;
          transition: all .3s ease;
        }
        
         /* picture */
        .carousel-cell .p {
          border-radius: 100px;
          width: 150px;
          height: 150px;
          counter-increment: carousel-cell;
                      

        }
            .carousel-cell {
                font-family: 'satoshi';
            }
        .carousel-cell .b:hover {
          background: #00e509;
          transform: scale(1.03);
          font-size: 16px;
        }
            
        .carousel-cell .b:active {
          background: white;
          color: green;
          transform: scale(0.9);
          font-size: 16px;
        }
            
        .carousel-cell .b-selected {
          cursor: pointer;
          margin: auto;
          width: 180px;
          padding: 1px;
          background: white;
          border: 1px solid green;
          border-radius: 15px;
          font-size: 15px;
          color: green;
          text-align: center;
          counter-increment: carousel-cell;
          transition: all .3s ease;
        }
        .tes .flickity-prev-next-button.next {
            right: 31%;
        }   
        .tes .flickity-prev-next-button.previous {
            left: 27%;
        }
        .tes .flickity-button {
    color: black !important;
    opacity: 50% !important;
    background: #fff !important;
}
    </style>
    <section
        style="height: 600px; background-image: url('{{ asset('public/images/bg/Frame 28.png') }}'); background-repeat: no-repeat; background-size: cover;"
        class="site-section relative py-10 transition-all duration-700 md:translate-y-8 md:opacity-0 [&.lqd-is-in-view]:translate-y-0 [&.lqd-is-in-view]:opacity-100"
        id="testimonials"
    >
        <div
            class="absolute inset-x-0 top-0 -z-1 h-[150vh]"
        ></div>
        <!--<div class="container">-->
            <div
                class="bg-contain bg-center bg-no-repeat p-11 pb-24 max-sm:px-5"
            >
            <div class="container">
                <x-section-header
                    width="w-1/2"
                    mb="10"
                    text="#FFFFFF"
                    title="{!! $fSectSettings->testimonials_title !!}"
                    subtitle=""
                >
                    <!-- <h6 class="mb-6 inline-block rounded-md px-3 py-1 text-[13px] font-medium" style="color: white; opacity: 50%;">
                        {!! __($fSectSettings->testimonials_subtitle_one) !!}
                        <span class="dot"></span>
                        <span class="opacity-50">{!! __($fSectSettings->testimonials_subtitle_two) !!}</span>
                    </h6> -->
                    <div style="display:flex"><img src="{{asset('public/images/bg/tt.png')}}" alt="Forest" style="width: 17px;
    height: 16px;margin-top:5px;margin-left:3px;margin-right:3px"><p>{!! __($fSectSettings->testimonials_subtitle_one) !!}  </p> <p>  {!! __($fSectSettings->testimonials_subtitle_two) !!} </p></div>
                </x-section-header>
    </div>    
                <div class="max-lg:11/12 mx-auto w-full max-md:w-full">
                    <div class="mb-20">
                        <div class="carousel tes" data-flickity>
                            @foreach ($testimonials as $item)
                                <div class="carousel-cell">
                                    <!--<div style="text-align: -webkit-center;">-->
                                    <!--    <img src="{{ url('') . isset($item->avatar) ? (str_starts_with($item->avatar, 'asset') ? custom_theme_url($item->avatar) : '/testimonialAvatar/' . $item->avatar) : custom_theme_url('assets/img/auth/default-avatar.png') }}" class="p">-->
                                    <!--</div>-->
                                    <div class="mt-2">
                                        <p class="name">{!! __($item->full_name) !!}</p>
                                    </div>
                                    <div class="mb-2">
                                        <p class="n">{!! __($item->job_title) !!}</p>
                                    </div>
                                    <div>
                                        <p class="content" style="color: rgb(141 134 134);">
                                            {!! __('“' . $item->words . '”') !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                        <!--<div class="testimonials-main-carousel text-center text-[26px] leading-[1.27em] text-heading-foreground max-sm:text-lg max-sm:[&_.flickity-button-icon]:!left-1/4 max-sm:[&_.flickity-button-icon]:!top-1/4 max-sm:[&_.flickity-button-icon]:!h-1/2 max-sm:[&_.flickity-button-icon]:!w-1/2 [&_.flickity-button.next]:-right-16 max-md:[&_.flickity-button.next]:-right-10 [&_.flickity-button.previous]:-left-16 max-md:[&_.flickity-button.previous]:-left-10 [&_.flickity-button]:opacity-40 [&_.flickity-button]:transition-all [&_.flickity-button]:hover:bg-transparent [&_.flickity-button]:hover:opacity-100 [&_.flickity-button]:focus:shadow-none max-sm:[&_.flickity-button]:relative max-sm:[&_.flickity-button]:!left-auto max-sm:[&_.flickity-button]:!right-auto max-sm:[&_.flickity-button]:top-auto max-sm:[&_.flickity-button]:!mx-4 max-sm:[&_.flickity-button]:translate-y-0"-->
                        <!--        data-flickity='{ "contain": true, "wrapAround": true, "pageDots": false, "adaptiveHeight": true }'-->
                        <!--    >-->
                        <!--    @foreach ($testimonials as $item)-->
                        <!--        @include('landing-page.testimonials.item-quote')-->
                        <!--    @endforeach-->
                        <!--</div>-->
                    </div>
                   
                </div>
            </div>
          
            <div class="banner-divider absolute inset-x-0 -bottom-[2px]">
                <svg
                    class="h-auto w-full fill-background"
                    width="1440"
                    height="105"
                    viewBox="0 0 1440 105"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none"
                >
                    <path d="M0 0C240 68.7147 480 103.072 720 103.072C960 103.072 1200 68.7147 1440 0V104.113H0V0Z" />
                </svg>
            </div>
        <!--</div>-->
    </section>
    <div style="    width: 400px;
    margin: 100px auto 0 auto;">
        <a href="https://www.trustpilot.com/review/healthly.live" target="blank_" style="text-align: -webkit-center;">
        <img src="https://healthly.live/upload/images/logo/trustpilot-widget-23123A123AA31958!123.png" style="margin-top: 60px" width="100%">
    </a>
    </div>
    <script>
        $(document).ready(function(){
$(".b").click(function(){
    $(this).toggleClass("b");
    $(this).toggleClass("b-selected");
 });
});

var elem = document.querySelector('.carousel');
var flkty = new Flickity( elem, {
  // options
  cellalign: 'right',
  pageDots: false,
  groupCells: '20%',
  selectedAttraction: 0.03,
  friction: 0.15
});
    </script>

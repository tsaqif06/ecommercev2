<!-- Start Footer Area -->
<footer class="footer" id="footer">
    <!-- Footer Top -->
    <div class="footer-top section">
        <div class="container">
            <div class="row footer-row">
                <div class="col-lg-5 col-md-6 offset-md-4 col-12 first-row-footer">
                    <!-- Single Widget -->
                    <div class="single-footer about">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('backend/img/logo2.png') }}" alt="#"></a>
                        </div>
                        @php
                            $settings = DB::table('settings')->get();
                        @endphp
                        {{--  <p class="text">@foreach ($settings as $data) {{$data->short_des}} @endforeach</p>  --}}
                        <p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">
                                    @foreach ($settings as $data)
                                        {{ $data->phone }}
                                    @endforeach
                                </a></span></p>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12 footer-info">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        {{--  <h4>Get In Tuch</h4>  --}}
                        {{--  <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li>
                                    @foreach ($settings as $data)
                                        {{ $data->address }}
                                    @endforeach
                                </li>
                                <li>
                                    @foreach ($settings as $data)
                                        {{ $data->email }}
                                    @endforeach
                                </li>
                                <li>
                                    @foreach ($settings as $data)
                                        {{ $data->phone }}
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->  --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4>Payment Methods</h4>
                                <div class="payment-icons d-flex gap-2">
                                    <img src="https://d2nvjoftj891ay.cloudfront.net/ec8939e/qris.Dwqv5AgA.svg"
                                        alt="QRIS" class="img-fluid" style="height: 30px;">
                                    <img src="data:image/svg+xml,%3csvg%20width='64'%20height='64'%20viewBox='0%200%2064%2064'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3crect%20width='64'%20height='64'%20rx='4'%20fill='%23542F9A'/%3e%3cpath%20fill-rule='evenodd'%20clip-rule='evenodd'%20d='M14.0111%2023.0559L14.0111%2023.0559C14.2592%2023.0954%2014.5073%2023.1348%2014.754%2023.1818C18.7549%2023.9442%2021.5952%2026.9306%2022.101%2030.9822C22.4766%2033.9916%2021.6331%2036.6333%2019.4844%2038.8037C18.0818%2040.2205%2016.3546%2041.0199%2014.3837%2041.2997C14.3435%2041.3054%2014.3051%2041.3247%2014.2668%2041.344C14.2489%2041.353%2014.231%2041.362%2014.2129%2041.3696H12.0195C12.0011%2041.3618%2011.9829%2041.3527%2011.9647%2041.3436C11.9256%2041.324%2011.8865%2041.3044%2011.8453%2041.298C7.81465%2040.6719%204.97263%2037.9351%204.18843%2033.921C4.14529%2033.7003%204.10318%2033.4794%204.06107%2033.2585L4.06106%2033.2585L4%2032.9388V31.4994C4.01359%2031.4343%204.02858%2031.3695%204.04357%2031.3046C4.07569%2031.1657%204.1078%2031.0268%204.12612%2030.886C4.63389%2026.9779%207.55446%2023.8944%2011.4154%2023.1962C11.6764%2023.1491%2011.938%2023.1054%2012.1996%2023.0618L12.1996%2023.0618C12.3224%2023.0413%2012.4452%2023.0208%2012.5679%2023H13.6646C13.78%2023.0191%2013.8956%2023.0375%2014.0111%2023.0559ZM13.0948%2038.3838C14.5573%2038.3846%2015.8658%2037.879%2016.8598%2036.9292C19.0955%2034.7929%2019.4658%2031.016%2017.6912%2028.4472C15.4947%2025.2677%2010.9186%2025.19%208.64533%2028.3089C7.46624%2029.9266%207.19584%2031.7518%207.57242%2033.6835C8.11288%2036.4562%2010.3907%2038.3825%2013.0948%2038.3838ZM49.787%2041.3696C49.6634%2041.3406%2049.5397%2041.3119%2049.4159%2041.2832C49.1478%2041.221%2048.8797%2041.1587%2048.6123%2041.0936C45.0044%2040.2156%2042.2543%2037.0185%2041.8968%2033.318C41.6184%2030.4344%2042.3769%2027.8905%2044.3802%2025.7753C45.9339%2024.1347%2047.8808%2023.2719%2050.1255%2023.0674C50.1897%2023.0616%2050.2527%2023.0431%2050.3157%2023.0246L50.3157%2023.0246C50.3451%2023.016%2050.3744%2023.0073%2050.4039%2023H51.5006C51.515%2023.0072%2051.5293%2023.0161%2051.5436%2023.0249C51.5743%2023.0439%2051.605%2023.0629%2051.6372%2023.0659C55.7314%2023.4446%2058.7615%2026.0503%2059.7431%2030.0463C59.8121%2030.3276%2059.8671%2030.6123%2059.922%2030.897C59.9475%2031.0293%2059.973%2031.1617%2060%2031.2938V33.213C59.9863%2033.2666%2059.9711%2033.3201%2059.9559%2033.3735L59.9559%2033.3736C59.9231%2033.4884%2059.8904%2033.6033%2059.8731%2033.7205C59.3411%2037.3207%2056.6862%2040.2447%2053.1582%2041.1067C52.8919%2041.1718%2052.6239%2041.2298%2052.3559%2041.2878C52.2307%2041.3148%2052.1055%2041.3419%2051.9805%2041.3697L49.787%2041.3696ZM56.6011%2032.657C56.6064%2031.2835%2056.4363%2030.3943%2056.0847%2029.5393C54.471%2025.6164%2049.3762%2024.7603%2046.6913%2028.0081C45.0282%2030.0199%2044.8042%2032.346%2045.6992%2034.7448C46.9363%2038.0607%2050.8424%2039.4257%2053.776%2037.5955C55.7535%2036.3617%2056.5462%2034.468%2056.6011%2032.657ZM40.6589%2024.0982C40.6613%2023.9195%2040.6636%2023.7398%2040.6721%2023.5586H34.9391V26.5026H36.6596C35.3113%2029.8071%2033.9823%2033.0663%2032.6299%2036.3831C32.1018%2035.1322%2031.578%2033.8915%2031.0558%2032.6545C30.1864%2030.5953%2029.3215%2028.5467%2028.4488%2026.4793H30.1946V23.5538H22.9735V26.4848C23.1213%2026.4848%2023.267%2026.4863%2023.4112%2026.4878C23.7464%2026.4914%2024.0733%2026.4949%2024.3992%2026.4786C24.659%2026.4656%2024.77%2026.5581%2024.8722%2026.7932C26.0487%2029.5165%2027.2304%2032.2373%2028.4121%2034.958C29.0685%2036.4693%2029.7248%2037.9805%2030.3803%2039.4922C30.418%2039.5793%2030.4585%2039.6636%2030.5016%2039.7445C30.5016%2039.7458%2030.5023%2039.7465%2030.5037%2039.7479C30.5047%2039.7502%2030.5056%2039.7523%2030.5067%2039.7544C30.508%2039.7567%2030.5094%2039.7591%2030.5112%2039.7616C30.516%2039.7705%2030.5222%2039.7829%2030.5304%2039.7973C30.684%2040.0687%2031.4612%2041.2655%2033.2886%2041.3696H33.8164C33.825%2041.3428%2033.833%2041.3156%2033.841%2041.2884C33.8585%2041.2288%2033.876%2041.1691%2033.9%2041.1126C34.4082%2039.9187%2034.9154%2038.7243%2035.4227%2037.5299C37.0619%2033.6701%2038.7012%2029.8102%2040.3705%2025.9638C40.6429%2025.3365%2040.6508%2024.7229%2040.6589%2024.0982Z'%20fill='white'/%3e%3c/svg%3e"
                                        alt="OVO" class="img-fluid" style="height: 30px;">
                                    <img src="path-to-icon/gopay.png" alt="GoPay" class="img-fluid"
                                        style="height: 30px;">
                                    <img src="path-to-icon/bca.png" alt="BCA" class="img-fluid"
                                        style="height: 30px;">
                                    <!-- Tambahkan ikon lain sesuai kebutuhan -->
                                </div>
                            </div>
                        </div>

                        <!-- Row for Shipment Methods -->
                        <div class="row">
                            <div class="col-12">
                                <h4>Shipment Methods</h4>
                                <div class="shipment-icons d-flex gap-2">
                                    <img src="path-to-icon/jne.png" alt="JNE" class="img-fluid"
                                        style="height: 30px;">
                                    <img src="path-to-icon/jnt.png" alt="J&T" class="img-fluid"
                                        style="height: 30px;">
                                    <img src="path-to-icon/gosend.png" alt="GoSend" class="img-fluid"
                                        style="height: 30px;">
                                    <!-- Tambahkan ikon lain sesuai kebutuhan -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    {{--  <div class="copyright">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="left">
                            <p>Copyright © {{ date('Y') }} <a href="https://github.com/Prajwal100"
                                    target="_blank">Prajwal Rai</a> - All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="right">
                            <img src="{{ asset('backend/img/payments.png') }}" alt="#">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
</footer>
<!-- /End Footer Area -->

<!-- Jquery -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
<!-- Popper JS -->
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<!-- Color JS -->
<script src="{{ asset('frontend/js/colors.js') }}"></script>
<!-- Slicknav JS -->
<script src="{{ asset('frontend/js/slicknav.min.js') }}"></script>
<!-- Owl Carousel JS -->
<script src="{{ asset('frontend/js/owl-carousel.js') }}"></script>
<!-- Magnific Popup JS -->
<script src="{{ asset('frontend/js/magnific-popup.js') }}"></script>
<!-- Waypoints JS -->
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<!-- Countdown JS -->
<script src="{{ asset('frontend/js/finalcountdown.min.js') }}"></script>
<!-- Nice Select JS -->
<script src="{{ asset('frontend/js/nicesellect.js') }}"></script>
<!-- Flex Slider JS -->
<script src="{{ asset('frontend/js/flex-slider.js') }}"></script>
<!-- ScrollUp JS -->
<script src="{{ asset('frontend/js/scrollup.js') }}"></script>
<!-- Onepage Nav JS -->
<script src="{{ asset('frontend/js/onepage-nav.min.js') }}"></script>
{{-- Isotope --}}
<script src="{{ asset('frontend/js/isotope/isotope.pkgd.min.js') }}"></script>
<!-- Easing JS -->
<script src="{{ asset('frontend/js/easing.js') }}"></script>

<!-- Active JS -->
<script src="{{ asset('frontend/js/active.js') }}"></script>


@stack('scripts')
<script>
    setTimeout(function() {
        $('.alert').slideUp();
    }, 5000);
    $(function() {
        // ------------------------------------------------------- //
        // Multi Level dropdowns
        // ------------------------------------------------------ //
        $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
            event.preventDefault();
            event.stopPropagation();

            $(this).siblings().toggleClass("show");


            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                $('.dropdown-submenu .show').removeClass("show");
            });

        });
    });
</script>

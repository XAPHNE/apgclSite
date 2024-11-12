<div class="footer pb-30  mt-20">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
               <div class="footer-links footer-contact">
                            <h3 class="border-start ps-3">@lang('footer.registered_office')</h3>
                            <ul>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <a href="https://maps.app.goo.gl/scoojw7NvP3saSkZ8" target="_blank">
                                      @lang('footer.office_address')
                                    </a>
                                </li>
                                 {{-- <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <a href="tel:0361-2739546" target="_blank">@lang('footer.office_phone')</a>
                                 </li> --}}
                                 <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:info@apgcl.org" target="_blank">@lang('footer.office_email')</a>
                                 </li>
                            </ul>
                        </div>   
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-links footer-contact">
                            <h3 class="border-start ps-3">@lang('footer.important_links')</h3>
                            <ul>
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="{{ url('/' . app()->getLocale()) }}" target="_blank">@lang('footer.home')</a>
                                </li>
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="{{ url('/' . app()->getLocale() . '/about-us/company-profile') }}" target="_blank">@lang('footer.company_profile')</a>
                                </li>
                                @php
                                    use App\Models\DailyGeneration;
                                    $dailyGeneration = DailyGeneration::whereNotNull('downloadLink')->latest()->first();
                                @endphp
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="{{ url($dailyGeneration->downloadLink ?? '#') }}" target="_blank">@lang('footer.daily_generation')</a>
                                </li>
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="{{ url('/' . app()->getLocale() . '/corporate-social-responsibility') }}">@lang('footer.csr')</a>
                                </li>
                                @php
                                    use App\Models\Calendar;
                                    $latestCalendar = Calendar::whereNotNull('downloadLink')->latest()->first();
                                @endphp
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="{{ url($latestCalendar->downloadLink ?? '#') }}" target="_blank">@lang('footer.calender_&_holiday')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="footer-links footer-contact">
                            <h3 class="border-start ps-3" >@lang('footer.quick_links')</h3>
                            <ul>
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="https://assamtenders.gov.in/nicgep/app" target="_blank">@lang('footer.tender_portal_assam')</a>
                                </li>
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="https://gem.gov.in/" target="_blank">@lang('footer.government_e_marketplace')</a>
                                </li>
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="https://www.aegcl.co.in/aseb-pensioner/" target="_blank">@lang('footer.pensioners_section')</a>
                                </li>
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="https://eodb.assam.gov.in/" target="_blank">@lang('footer.ease_of_doing_business')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="footer-links footer-contact">
                            <h3 class="border-start ps-3">@lang('footer.policies')</h3>
                            <ul>
                                <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="hyperlink_policies.php" target="_blank">@lang('footer.hyperlink_policies')</a>
                                </li>
                                 <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="copyright_policies.php" target="_blank">@lang('footer.copyright_policies')</a>
                                </li>
                                 <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="privacy_policies.php" target="_blank">@lang('footer.privacy_policies')</a>
                                </li>
                                 <li>
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                                    <a href="disclaimer.php" target="_blank">@lang('footer.disclaimer')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="footer-links footer-contact">
                             <a class="st-foot-f" href="https://www.facebook.com/share/XrVwNTcgCwCNjB73/?mibextid=qi2Omg" target="_blank">
                                 <i class="fab fa-facebook-f"></i>
                             </a>

                              <a  class="st-foot-f" href="https://x.com/info_apgcl?t=kDBZtfd8JJQTMweLgd_Q6w&s=08" target="_blank">
                                  <i class="fab fa-twitter"></i>
                              </a>

                              <p class="uptext">
                                 @lang('footer.updated_on'): <span id="sd_date">{{ date('d/m/Y') }}</span>
                              </p>

                              <img src="{{ asset('website-assets/images/home/ssl_certificate.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <div class="container">
        <p>@lang('footer.copyright') @<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script>document.write(new Date().getFullYear())</script>. &copy; @lang('footer.all_rights_reserved') @lang('footer.apgcl') | CIN: U40101AS2003SGC007239 | GST No.:18AAFCA4891F1ZJ
        </p>
    </div>
</div>
<div class="popup">
    <div class="popup-content">
        <button class="close-btn" id="popup-close"><i class="fas fa-times"></i></button>
        <form>
            <div class="input-group search-box">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="go-top">
    <i class="fa-solid fa-angles-up"></i>
</div>
<script src="{{ asset('website-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('website-assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('website-assets/js/meanmenu.js') }}"></script>
<script src="{{ asset('website-assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('website-assets/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('website-assets/js/nice-number.min.js') }}"></script>
<script src="{{ asset('website-assets/js/nice-select.min.js') }}"></script>
<script src="{{ asset('website-assets/js/appear.min.js') }}"></script>
<script src="{{ asset('website-assets/js/progress-bar.min.js') }}"></script>
<script src="{{ asset('website-assets/js/odometer.min.js') }}"></script>
<script src="{{ asset('website-assets/js/custom.js') }}"></script>
<!-- datatable -->
<script src="{{ asset('website-assets/js/datatables.js') }}"></script>
<script src="{{ asset('website-assets/js/datatables.min.js') }}"></script>
<!-- gallery -->
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<!-- ticker -->
{{-- <script type="text/javascript" src="{{ asset('website-assets/plugins/ticker/js/jquery.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('website-assets/plugins/ticker/js/acmeticker.js') }}"></script>
<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            columnDefs: [
                {
                    targets: 'nosort',
                    orderable: false,
                    searchable: false,
                }
            ],
        });
        $('.dataTable').DataTable({
            columnDefs: [
                {
                    targets: 'nosort',
                    orderable: false,
                    searchable: false,
                }
            ],
        });
        $('#contactustable').DataTable();
    });
</script>
<!-- js for gallery -->
<script type="">
    $(document).ready(function(){
    $(".fancybox").fancybox({
          openEffect: "none",
          closeEffect: "none"
      });
      
      $(".zoom").hover(function(){
          
          $(this).addClass('transition');
      }, function(){
          
          $(this).removeClass('transition');
      });
  });
      
</script>

<script type="">
   function setFontSize(size) {
    document.body.style.fontSize = size + 'px';
}

</script>


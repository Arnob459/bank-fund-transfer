  <!-- Footer
  ============================================= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg d-lg-flex align-items-center">
          <ul class="nav justify-content-center justify-content-lg-start text-3">
            <li class="nav-item"> <a class="nav-link active" href="{{ route('aboutus') }}">About Us</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('help') }}">Help</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('blog') }}">Blog</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('contact') }}">Contact us</a></li>
          </ul>
        </div>
        <div class="col-lg d-lg-flex justify-content-lg-end mt-3 mt-lg-0">
          <ul class="social-icons justify-content-center">
            @foreach ($socials as $social)
            <li class="social-icons-facebook"><a data-bs-toggle="tooltip" href="{{ $social->url }}" target="_blank" ><i class="{{ $social->icon }}"></i></a></li>

            @endforeach

          </ul>
        </div>
      </div>
      <div class="footer-copyright pt-3 pt-lg-2 mt-2">
        <div class="row">
          <div class="col-lg">
            <p class="text-center text-lg-start mb-2 mb-lg-0">{{ $gnl->copy_section}}</p>
          </div>
          <div class="col-lg d-lg-flex align-items-center justify-content-lg-end">
            <ul class="nav justify-content-center">
              <li class="nav-item"> <a class="nav-link" href="{{ route('terms') }}">Terms</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('privacy') }}">Privacy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer end -->

<footer class="footer-section">
    <div class="container">
        <div class="footer-top">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-4">
                    <a href="{{ route('home') }}">
                        <div class="footer-logo">
                            <img src="{{ static_asset('assets/img/logo/logo-light.png') }}" class="img-fluid" alt="">
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="contact-copyright">
                        <div class="footer-contact">
                            <p>〒104-0061</p>
                            <p>東京都中央区銀座一丁目22番11号　銀座大竹ビジデンス2階</p>
                            <p>電話番号:03-6680-8680</p>
                        </div>
                        <div class="footer-divider"></div>
                        <div class="footer-copyright">
                            <span>Copyright © 2021 Scope Inc. All Rights Reserved.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="footer-terms">
                        <span><a href="{{ route('policy') }}">個人情報の取扱いについて</a>  /  <a href="{{ route('terms') }}">利用規約</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

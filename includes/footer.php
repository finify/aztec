<!-- footer -->
<?php
//Selecting current user 
$query = "SELECT * FROM `fx_settings` WHERE ID='1' ";
$result = mysqli_query($con,$query) ;
$row = mysqli_fetch_array($result);
$phone_number =$row['phone_number'];
$address =$row['address'];
$location =$row['location'];
$email =$row['email'];

?><!-- footer begin -->
<footer
   class="footer-light"
   style="background-color: #03002e; border: 0px; color: #fff; border: 0px"
   >
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
            <div class="widget">
               <a href="index-2.php"><img alt="" class="logo" src="assets/images/ssl.png" width="80%;"/></a>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="widget">
               <h5 style="color: #fff">Useful Links</h5>
               <ul>
                  <li>
                     <a class="a-underline" href="about.php" style="color: #fff">About Us<span></span></a>
                  </li>
                  <li>
                     <a class="a-underline" href="account/register.php" style="color: #fff">Get Started<span></span></a>
                  </li>
                 <li>
                     <a class="a-underline" href="assets/sec_doc.pdf" style="color: #fff">SEC Regulation<span></span></a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="widget">
               <h5 style="color: #fff">More Links</h5>
               <ul>
                  <li>
                     <a class="a-underline" href="terms.php" style="color: #fff">Terms of Service<span></span></a>
                  </li>
                 <li>
                     <a class="a-underline" href="privacy-policy.php" style="color: #fff">Privacy policy<span></span></a>
                  </li>
                 <li>
                     <a class="a-underline" href="index.php#faqs" style="color: #fff">FAQs<span></span></a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="widget">
               <h5 style="color: #fff">Newsletter</h5>
               <form
                  action="#"
                  class="row"
                  id="form_subscribe"
                  method="post"
                  name="form_subscribe"
                  >
                  <div class="col text-center">
                     <input
                        class="form-control"
                        id="name_1"
                        name="name_1"
                        placeholder="enter your email"
                        type="text"
                        />
                     <a href="#" id="btn-submit"><i class="arrow_right"></i></a>
                     <div class="clearfix"></div>
                  </div>
               </form>
               <div class="spacer-10"></div>
               <small style="line-height: 5px"
                  >Signup for our newsletter to get the latest news, updates and
               special offers in your inbox.</small
                  >
            </div>
         </div>
      </div>
   </div>
   <div class="subfooter">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="de-flex">
                  <div class="de-flex-col">
                     &copy; Copyright 2022 - Aztecmining                           </div>
                  <div class="de-flex-col">
                     <div class="social-icons">
                        <a href="#"><img src="assets/images/btc.png" height="40px" /></a>
                      
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- footer close -->
</div>
<!-- Javascript Files
================================================== -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/jquery.isotope.min.js"></script>
<script src="assets/js/easing.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/validation.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/enquire.min.js"></script>
<script src="assets/js/jquery.stellar.min.js"></script>
<script src="assets/js/jquery.plugin.js"></script>
<script src="assets/js/typed.js"></script>
<script src="assets/js/jquery.countTo.js"></script>
<script src="assets/js/jquery.countdown.js"></script>
<script src="assets/js/typed.js"></script>
<script src="assets/js/designesia.js"></script>
<script>
$(function () {
   // jquery typed plugin
   $(".typed").typed({
      stringsElement: $(".typed-strings"),
      typeSpeed: 100,
      backDelay: 1500,
      loop: true,
      contentType: "html", // or text
      // defaults to false for infinite loop
      loopCount: false,
      callback: function () {
         null;
      },
      resetCallback: function () {
         newTyped();
      },
   });
});
</script>
</body>

</html>